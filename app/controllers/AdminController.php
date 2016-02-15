<?php

class AdminController extends BaseController {
	


	public function login(){
	
		$validate=Validator::make(Input::all(),array(
			'name'    =>'required',
			'password' =>'required',
			));
			
		if($validate->fails()){
			return Response::json(array('status' => false, 'message' => 'Credentials not valid',"errors" => $validate->messages()));
		}
		else{
			//Auth::loginUsingId(3);
			
			$auth = Admin::where("user_name",Input::get("name"))->where("password",Input::get("password"))->first(); 
	
			if (!empty($auth)) {
				 Session::put('admin', true);
			 	 return Response::json(array('status' => true, 'message' => 'You are login'));
			}
			else{
			  return Response::json(array('status' => false,
			  							 'message' => 'Credentials are  incorrect',
										 "errors" => array("msg" => "Credentials are  incorrect" )));
			}
		}
	}
	
	public function logout(){
		
		Session::forget("admin");
		return Response::json(array('status' => true, 'message' => 'logout successfully'));
	}
	
	
	public function grandTotalInfo(){
		
		$total = array();
		
		$total["users"] = User::count();
		$total["cooks"] = User::whereType("cook")->count();
		$total["delivery_persons"] = User::whereType("delivery")->count();
		$total["soldout"] = OrderItems::count();
		$total["dishes"] = Dish::count();
		$total["payments_done"] = Order::count();
		
		
		return Response::json(array('status' => true, 'message' => '', "data" => $total));
	}
	
	
	public function users(){
		
			if(Input::has("type")){
				$type = Input::get("type");
				if($type=="cook")
					$data = User::whereType("cook")->get();	
				elseif($type == "delivery")
					$data = User::whereType("delivery")->get();
				else
					$data = User::all();
			}else{
				$data = User::all();	
			}
			
			return Response::json(array('status' => true, 'message' => '', "data" => $data));
	}
	
	public function userUpdate(){
		$data = array();
		
		
		$id = Input::get("id");
		$user = User::find($id);
		
		if(!empty($data)){
			$user->name = Input::get("name");
			$user->profile_photo = Input::get("profile_photo");
			$user->phone= Input::get("phone");
			$user->email = Input::get("email");
			$user->zip = Input::get("zip");
			$user->verification = Input::get("verification");
			$user->save();
			
			return Response::json(array('status' => true, 'message' => 'User Update Successfully!!'));
		}else{
			return Response::json(array('status' => false, 'message' => 'User Update failed'));
		}
		
		
		
	}
	public function userDelete($id){
		
		if(User::destroy($id)){
			return Response::json(array('status' => true, 'message' => 'Dish delete Successfully!!'));
		}
	}
	
	
	
	public function dishs(){
			$data = Dish::all();
			
			$data = array_map(function($row){
					$row["cookname"] = User::find($row["cook_id"])->name;
					return $row;
			},$data->toArray());
		
			return Response::json(array('status' => true, 'message' => '', "data" => $data));
	}
	
	public function updateDish(){
		
		$id = Input::get("id");
		$data = Dish::find($id);
		
		if(!empty($data)){
			$data->dish_img = Input::get("dish_img");
			$data->description = Input::get("description");
			$data->save();
			
			return Response::json(array('status' => true, 'message' => 'Dish Update Successfully!!'));
			
		}else{
			return Response::json(array('status' => false, 'message' => 'Dish Update failed!!'));
		}
		
	}
	public function dishDelete($id){
		
		if(Dish::destroy($id)){
			return Response::json(array('status' => true, 'message' => 'User delete Successfully!!'));
		}
	}
	
	
	public function survey(){
		
		$data = Survey::all();
		
		$data = array_map(function($row){
			$date = new DateTime($row["created_at"]);
	        $row["date"] = $date->format('d-m-Y');
			return $row;
		},$data->toArray());
		
		return Response::json(array('status' => true, 'message' => '', "data" => $data));
	}
	
	
	public function paymentDone(){
		
		$data = CookPayments::all();
		$data = array_map(function($row){
			$date = new DateTime($row["created_at"]);
	        $row["date"] = $date->format('d-m-Y');
			
			$user = User::find($row["cook_id"]);
			$row["cookname"] = $user->name;
			$row["cookemail"] = $user->email;
			
			return $row;
		},$data->toArray());
		
		return Response::json(array('status' => true, 'message' => '', "data" => $data));
	}
	
	public function deletePayments($id){
		
		$data = CookPayments::destroy($id);
		
		return Response::json(array('status' => true, 'message' => 'Delete cook payments'));
	}
	
	
	
	public function topsalesRecord(){
		
		/*$data = DB::table('order_items')
				->select('*','SUM(quantity) AS TotalItemsOrdered')
                ->groupBy('dish_id')
                ->orderBy("TotalItemsOrdered","desc")
                ->get();*/
				
		$data  = OrderItems::with('dish','cook','user','order')->get();
		
	
		$data = array_map(function($row){
			
			$array = array();
			
			$array["id"] = $row["id"];
			$array["name"] = $row["dish"]["name"];
			$array["cookname"] = $row["cook"]["name"];
			$array["username"] = $row["user"]["name"];
			$array["quantity"] =  $row["quantity"];
			$array["total"]	= ($row["quantity"] * $row["dish"]["price"]);
			$date = new DateTime($row["created_at"]);
	        $array["date"] = $date->format('d-m-Y');
			
			$date = new DateTime($row["updated_at"]);
			$array["deliverytime"] = $date->format('d-m-Y');
			
			$array["status"] = $row["order"]["status"];
			$array["rating"] = $row["order"]["rating"];
			
			if($row["order"]["order_address"] == null){
				$array["address"] = $row["user"]["address"];
			}else{
				$array["address"] = $row["order"]["order_address"];
			}
			
			return $array;
			
		},$data->toArray());
		
		return Response::json(array('status' => true, 'message' => '', "data"=> $data));
		
	}
	
	
	
	function cookPayments(){
		
		
		$user = User::whereType("cook")->get();
		
		$data = array_map(function($row){
			
			$array = array();
			
			$array["cook_id"] = $row["id"];
			
			$array["photo"] = $row["profile_photo"];
			
			$array["name"] = $row["name"];
			$array["email"] = $row["email"];
			
			
			$data2 = OrderItems::select('*', DB::raw('SUM(quantity) AS totalItemsOrdered'))
							->where('cook_id', $row["id"])
							->groupBy('dish_id')
							->orderBy("totalItemsOrdered","desc")
							->get();
							
			
			$data3 = array();	
				
			foreach($data2->toArray() as $row2){	
				$dish = Dish::find($row2["dish_id"]);
				
				if(!empty($dish))
					array_push($data3,($dish["price"] * $row2["totalItemsOrdered"]));
				else
					array_push($data3,0);
					
			};
			
			$array["dishs"] = array_sum($data3);

			$array["booking"] = 0;
			
			
			$cookpaid = CookPayments::select(DB::raw('SUM(paid_amount) AS paid'))
										->where('cook_id', $row["id"])
										->groupBy('cook_id')
										 ->get();
			$cookpaid = $cookpaid->toArray();
			
			//print_r($cookpaid);
			if(empty($cookpaid))
				$array["paid_amount"] = 0;
			else{
				try{
					$array["paid_amount"] = $cookpaid[0]["paid"];
				}
				catch(Exception $ex){
					$array["paid_amount"] = 0;
				}
			}

			
//			$cData = DB::table('order_items')
//				->select('*', DB::raw('SUM(quantity) AS TotalItemsOrdered'))
//				->where('cook_id', $row["id"])
//                ->groupBy('dish_id')
//                ->orderBy("TotalItemsOrdered","desc")
//                ->get();
			
			
			
			
			
			return $array;
			
		},$user->toArray());
		

		
		
		
		return Response::json(array('status' => true, 'message' => '', "data"=> $data));
		//$data  = OrderItems::with('dish','cook','order')->get();
	}
	
	
	function cookPayNow(){
		
		CookPayments::create(Input::all());
		
		return Response::json(array('status' => true, 'message' => 'payments successfully done'));
	}
}