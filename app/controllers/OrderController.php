<?php

class OrderController extends BaseController {


	function orders(){
		$where = array();

		$userType = Auth::user()->type;

		if($userType == "user"){
			$where["cook_id"] = Auth::user()->id;
		}else if($userType == "cook"){
			$where["user_id"] = Auth::user()->id;
		}else if($userType == "delivery"){}

		$orders  = OrderItems::with('dish')->where($where)->get();

		if($userType == "user"){
			$orders = $orders->load("dish");
		}else if($userType == "cook"){
			$orders = $orders->load("orderItems");
		}else if($userType == "delivery"){}


		$orders->toArray();

		$orders = array_map(function($order) {
			$order["time_ago"] = Helpers::time_ago($order["created_at"]);
			return $order;
		},$orders->toArray());

		return Response::json(array('status' => true, 'message' => "", "orders" => $orders));
	}

	function cookOrders(){
								//'user','dish','orderItems'
		//$orders = Order::with('orderItems')->whereCook_id(Auth::user()->id)->get();
		$orders  = OrderItems::with('dish')->whereCook_id(Auth::user()->id)->get();
		$orders->toArray();
		
		//foreach($orders as $key =>$order){
//			foreach($order["order_items"] as $ckey =>$item){
//				$orders[$key]["order_items"][$ckey]["dish"] = Dish::find($item["dish_id"]);
//			}
//		}
		
		$orders = array_map(function($order) { 
								$order["time_ago"] = Helpers::time_ago($order["created_at"]); 
								return $order;
		 					},$orders->toArray());
		
		return Response::json(array('status' => true, 'message' => "", "orders" => $orders));
		
	}
	function userOrders(){
							//'user','dish',"orderItems"
		$orders = Order::with("orderItems")->whereUser_id(Auth::user()->id)->get();


		try{
			$postmate = new PostmatesController();
			foreach($orders as $key=>$order) {

				foreach ($orders->orderItems as $key2 => $order2) {

					if ($order->state == 2) {
						$data = $postmate->getDelivery($order2->item_id);
						$data = $data->getData();

						$data12 = OrderItems::find($order2->id);
						$data12->status = ($data["status"] == "pickup") ? 4 : 3;
						$order->save();
					}
				}
			}
		}
		catch(Exception $ex){}

		$orders = Order::with("orderItems")->whereUser_id(Auth::user()->id)->get();
		$orders->toArray();

		foreach($orders as $key =>  $order){

			foreach($order["order_items"] as $ckey =>$item){
				$orders[$key]["order_items"][$ckey]["dish"] = Dish::find($item["dish_id"]);
			}

			if(count($order["order_items"]) == 0){
				unset($orders[$key]);
			}
		}

		$orders = array_map(function($order) { 
								$order["time_ago"] = Helpers::time_ago($order["created_at"]); 
								return $order;
		 					},$orders->toArray());
		
		return Response::json(array('status' => true, 'message' => "3", "orders" => $orders));
		
	}
	
	function orderPlace(){
		
		$carts = Cart::with('dish')->whereUser_id(Auth::user()->id)->get();
		$carts = $carts->toArray();

		$data = array(
						"user_id" => Auth::user()->id,
						);
						
		if(Input::has("order_address")){
			$data["order_address"] = Input::get("order_address");
		}
		
		$order = Order::create($data);

		foreach($carts as $cart){
			//$d = $cart->dish;
			$data = array(
							"order_id" => $order->id,
							"user_id" => Auth::user()->id,
							"dish_id" => $cart["dish_id"],
							"quantity" => $cart["quantity"],
							"cook_id" => $cart["dish"]["cook_id"]
						);

			$dishData = Dish::find($cart["dish_id"]);
		//	echo $cart["dish"]["name"];
			$cookData = User::find($cart["dish"]["cook_id"]);


			OrderItems::create($data);
			
			$cook = User::find($cart["dish"]["cook_id"]);
			
			Helpers::sendMailForDishPrepare($cook,$cart,Auth::user());
			
			Helpers::sendMailDishInfoForUser($cook,$cart,Auth::user(),$order->id);
			
		}
		// remove all cart Items
		$affectedRows  = Cart::whereUser_id(Auth::user()->id)->delete();

		return Response::json(array('status' => true, 'message' => "Place order successfully!!"));
	}
	
	
	
	function updateDishStatus(){
		
		$id = Input::get('order_id'); //order_items id
		$status = Input::get('status');

		$orderItems = OrderItems::find($id);
		if($status == 2){
			$postmates = new PostmatesController;

			$cookData = User::find($orderItems->cook_id);
			$dishData = Dish::find($orderItems->dish_id);

			$post = array();
			$post["manifest"] = "A box of kittens";
			$post["pickup_name"] = $cookData->name;
			$post["pickup_address"] = $dishData->address;
			$post["pickup_phone_number"] = $cookData->phone;

			$post["dropoff_name"] = Auth::user()->name;
			$post["dropoff_address"]  =  Input::has("order_address")? Input::get("order_address") : Auth::user()->address;
			$post["dropoff_phone_number"] = Auth::user()->mobile;

			$data = $postmates->post('/v1/customers/'.$postmates::CUSTOMER_ID.'/deliveries',array('Content-Type: application/x-www-form-urlencoded'),$post);
			$data = $data->getData();

			$postmate = array();

			$postmate["order_id"]= $orderItems->order_id;
			$postmate["item_id"]= $orderItems->id;
			$postmate["delivery_id"] = $data["id"];
			$postmate["data"] = json_encode($data);

			Postmates::create($postmate);
		}
		$orderItems->status= $status;
		//$order_update = OrderItems::whereId($id)->whereCook_id(Auth::user()->id)->update(array('status' => $status));
		
		if($orderItems->save()){
			return Response::json(array('status' => true, 'message' => "Status Update successfully!!"));
		}else{
			return Response::json(array('status' => false, 'message' => "Status Update failed!!"));
		}
	}
	
	function aasort (&$array, $key) {
			$sorter=array();
			$ret=array();
			reset($array);
			foreach ($array as $ii => $va) {
				$sorter[$ii]=$va[$key];
			}
			asort($sorter);
			foreach ($sorter as $ii => $va) {
				$ret[$ii]=$array[$ii];
			}
			$array=$ret;
		}
		
	function getOrderDetails($id){

		$where = array();
		$where["order_id"] = $id;
		//$where["user_id"] = Auth::user()->id;

		$orders = OrderItems::with("dish")->where($where)->orderBy("cook_id")->get();

		$postmate = new PostmatesController();
		foreach($orders as $key=>$order) {
			if($order->state == 2){
				$data = $postmate->getDelivery($order->item_id);
				$data = $data->getData();

				if ($data["status"])
					$order->status = ($data["status"] == "pickup") ? 4 : 3;

				$order->save();
			}
		}

		$orders = OrderItems::with("dish")->where($where)->orderBy("cook_id")->get();

		$orderDetails = order::find($id);
		
		$new = array();
		$same_cook_order = array();
		$cook = 0;

		foreach($orders as $key=>$order){



			if($order->cook_id == $cook || $cook ==0 ){
				$same_cook_order[] = $order;
				$cook = $order->cook_id ;
			}else{
				$new[] = $same_cook_order;
				$cook = 0;
				$same_cook_order = array($order);
			}
			
		}
		if(!empty($same_cook_order)){
			$new[] = $same_cook_order;
		}
		
		//$this->aasort($your_array,"order");
		
		if($orders){
			return Response::json(array('status' => true, 'message' => "", "orders" => $new));
		}else{
			return Response::json(array('status' => false, 'message' => ""));
		}
		
	}

	function  delivery(){

		$where = ["user_id" => Auth::user()->id];

		if(Input::has("action")){
			$where["action"] = Input::get("action");
		}
		$data = OrderDelivery::with("dish")->where($where)->get();
		$data = $data->toArray();
		if(!empty($data)){
			return Response::json(array('status' => true, 'message' => "", "data" => $data));
		}else{
			return Response::json(array('status' => false, 'message' => "Delivery not available"));
		}
	}

}
	
