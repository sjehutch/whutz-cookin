<?php

class UserController extends BaseController {


	public function register(){
		//print_r(Input::all());
		$validate=Validator::make(Input::all(),array(
			'name'    =>'required',
			'email'    =>'required|unique:users',
			'password' =>'required',
			'type'     => 'required'
			));
		if($validate->fails()){
			return Response::json(array('status' => false, 'message' => "Validation Failed" , "errors" => $validate->messages()));
		}else{
			
			$email_verification_code = Str::random(60);
			
			$overwrite = array(
								'password' => Hash::make(Input::get("password")),
								'email_verification_code' => $email_verification_code
							);
			
			$data = array_merge(Input::all(),$overwrite);
			
			$user = User::create($data);
			if($user){
				// $to,$name,$verification_code
				Helpers::emailVerfication(Input::get("email"),Input::get("email"),$email_verification_code);
				return Response::json(array('status' =>true, 'message' => "Register Successfully !! Please check your Email for verification".$data['password'].$user));
			}else{
				return Response::json(array('status' =>true, 'message' => "Register Failed"));
			}
		}
	}
	
	public function getUserInfo(){
		 return Response::json(array('status' =>true,'message' => "", "user" => Auth::user()) );
	}

	public function userlicenseUpdate(){
		$validate=Validator::make(Input::all(),array(
				'is_complete'    =>'required',
			));
			
		if($validate->fails()){
			return Response::json(array('status' => false, 'message' => "Validation Failed" , "errors" => $validate->messages()));
		}
		else{
			$data = Input::all();
				
			$user = User::whereId(Auth::user()->id)->update($data);
			if($user)
				return Response::json(array("status" => true,'message' => "User License Info Updated Successfully!!" ));
			else
				return Response::json(array("status" => false, "message" => "User License Info Update Failed"));

		}
	}
	
	public function userUpdate(){
		//dd(Input::all());
		$validate=Validator::make(Input::all(),array(
				'name'    =>'required',
			));
			
		if($validate->fails()){
			return Response::json(array('status' => false, 'message' => "Validation Failed" , "errors" => $validate->messages()));
		}
		else{
			
			if(Input::has("password")){
				$data = array_merge(Input::all(),array('password' => Hash::make(Input::get("password"))));
				//print_r($data);
			}
			else
				$data = Input::all();

			
			$user = User::find(Auth::user()->id)->update($data);
			
			if($user)
				return Response::json(array("status" => true,'message' => "User Update successfully!!" ));
			else
				return Response::json(array("status" => false, "message" => "User Update Failed"));

		}
	}
	
	public function forgotPassword(){
		
		$validate=Validator::make(Input::all(),array(
			'email'    =>'required'
		));
		
		if($validate->fails()){
			return Response::json(array('status' => false, 'message' => "Validation Failed" , "errors" => $validate->messages()));
		}else{
			
			$email_code = Str::random(60);
			$user = User::whereEmail(Input::get("email"))->first();
			
			if($user){
				$user->reset_code = $email_code;
				$user->save();
				Helpers::forgotPassword(Input::get("email"),$email_code);
				
				return Response::json(array('status' => true, 'message' => "Password Reset Email Sent To Your Email Id."));
			}else{
				return Response::json(array('status' => true, 'message' => "User Email not found"));
			}
		}
		
	}
	
	
	public function resetPassword(){
		
		$resetcode = Input::get('reset');
		$password = Input::get('password');
		
		$validate=Validator::make(Input::all(),array(
			'reset'    =>'required',
			'password'    =>'required'
		));
		
		if($validate->fails()){
			return Response::json(array('status' => false, 'message' => "Validation Failed" , "errors" => $validate->messages()));
		}else{
			
			$user =  User::whereReset_code($resetcode)->first();
			
			if($user){
				$user->password =  Hash::make(Input::get("password"));
				$user->reset_code = null;
				$user->save();
				return Response::json(array('status' => true, 'message' => "Password Updated successfully!!"));
			}else{
				return Response::json(array('status' => false, 'message' => "Password Updated failed"));
			}
			
		
		}
		
	}
	
	public function payments(){
		
		$array = array();
		if(Input::has("type")){
			if(Input::get("type") == "recently"){
			 $take = 5;
			 if(Input::has("take")){
				 $take = intval(Input::get("take"));
			 }
				
			 $array = CookPayments::whereCook_id(Auth::user()->id)->orderBy('created_at','desc')->take($take)->get()->toArray();
			 
			 $array = array_map(function($row){
						$date = new DateTime($row["created_at"]);
						$row["date"] = $date->format('d-m-Y');
						return $row;
					},$array);
			}
			
		}
		else{
			$data = CookPayments::whereCook_id(Auth::user()->id)->get()->toArray();
			
			$paid = array();
			foreach($data as $row){
				array_push($paid,$row["paid_amount"]);
			}
			$paid = array_sum($paid);
			
			$data = array_map(function($row){
				$date = new DateTime($row["created_at"]);
				$row["date"] = $date->format('d-m-Y');
				return $row;
			},$data);
			
			
			$data2 = OrderItems::select('*', DB::raw('SUM(quantity) AS totalItemsOrdered'))
								->where('cook_id', Auth::user()->id)
								->groupBy('dish_id')
								->orderBy("totalItemsOrdered","desc")
								->get();
								
				
			
			$data3 = array();
					
			foreach($data2->toArray() as $row){	
			
				$dish = Dish::find($row["dish_id"]);
				
				if(!empty($dish))
					array_push($data3,($dish["price"] * $row["totalItemsOrdered"]));
				else
					array_push($data3,0);
					
			};
			
			$array = array($data);
	
			$array["total"] = array_sum($data3);
			$array["paid"] = $paid;
		
		}
		
		return Response::json(array('status' => true, 'message' => "", "data" => $array ));
	}
	
	public function userLikes(){
		
		$type = Input::get("type");
		$item_id = Input::get("id");
		

		$data = UserLike::whereUser_id(Auth::user()->id)
							->whereItem_id($item_id)
							->Where("type",$type)
							->first();
		
		if(empty($data)){
			
			$data = array();
			$data["user_id"] = Auth::user()->id;
			$data["item_id"] = $item_id;
			$data["type"]    = $type;
			 
			$data = UserLike::create($data);
			
			return Response::json(array('status' => true, 'message' => "add ".$type ));
		}else{
			
			UserLike::destroy($data->id);
			
			return Response::json(array('status' => true, 'message' => "remove ".$type ));
		}
	}
	
	public function send(){
		
		$array = array();
		
		$array["user_id"] = Auth::user()->id;
		$array["to_id"] = Input::get("cook_id");
		$array["text"] = Input::get("text");
		
		Message::create($array);
		
		return Response::json(array('status' => true, 'message' => "done" ));	
	}
	
	
	public function receiver($id){
		
		$data = Message::whereUser_id($id)->whereTo_id(Auth::user()->id)->get();
		
		return Response::json(array('status' => true, 'message' => "" , "data" => $data ));	
		
	}
}