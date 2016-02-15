<?php

class OrderController extends BaseController {

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
		$orders->toArray();
		
		foreach($orders as $key =>$order){
			foreach($order["order_items"] as $ckey =>$item){
				$orders[$key]["order_items"][$ckey]["dish"] = Dish::find($item["dish_id"]);
			}
		}
		
		
		$orders = array_map(function($order) { 
								$order["time_ago"] = Helpers::time_ago($order["created_at"]); 
								return $order;
		 					},$orders->toArray());
		
		return Response::json(array('status' => true, 'message' => "", "orders" => $orders));
		
	}
	
	function orderPlace(){
		
		$carts = Cart::with('dish')->whereUser_id(Auth::user()->id)->get();
		$carts = $carts->toArray();
		
		$data = array(
						"user_id" => Auth::user()->id,
						);
						
		if(Input::has("order_address")){
			$datap["order_address"] = Input::get("order_address");
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
		$order_update = OrderItems::whereId($id)->whereCook_id(Auth::user()->id)->update(array('status' => $status));
		
		if($order_update){
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
		
		$orders = OrderItems::with("dish")->whereOrder_id($id)->orderBy("cook_id")->get();
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
}
	
