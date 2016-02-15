<?php

class VerificationController extends BaseController {
	
	
	public function emailVerification($code){
		
		$user = User::whereEmail_verification_code($code)->first();
		if($user){
			$user->verification = 1;
			$user->email_verification_code = null;
			if($user->type == "user"){
				$user->is_complete = 1;
			}
			$user->save();
			
			return  Response::json(array('status' => true, 'message' => "Email verification Successfully!!"));
		}else{
			return  Response::json(array('status' => false, 'message' => "Email verification failed"));
		}
	}
	
	
	
}