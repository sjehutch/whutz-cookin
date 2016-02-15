<?php

class ContactController extends BaseController {
	
	
	public function contact(){		
		
		$validate=Validator::make(Input::all(),array(
			'first_name'    =>'required',
			'last_name'    =>'required',
			'email' =>'required'
			));
		if($validate->fails()){
			return Response::json(array('status' => false, 'message' => "Validation Failed" , "errors" => $validate->messages()));
		}else{	
			$data = Input::all();
			
			$reserve = Contact::create($data);
			if($reserve){
				Helpers::emailContact(Input::get("email"),Input::get("phone"),Input::get("first_name"),Input::get("last_name"),Input::get("message"));
				return Response::json(array('status' =>true, 'message' => "Contact Request Submitted!!".$reserve));
			}else{
				return Response::json(array('status' =>true, 'message' => "Contact Request Failed"));
			}
		}
	}
	
}