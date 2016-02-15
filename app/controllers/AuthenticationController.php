<?php
/*
 * Created on Sep 23, 2014
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */



class AuthenticationController extends BaseController{
	

    public function __construct()
    {

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkCredentials(){
		
		$validate=Validator::make(Input::all(),array(
			'email'    =>'required',
			'password' =>'required',
			));
			
		if($validate->fails()){
			return Response::json(array('status' => false, 'message' => 'Credentials not valid',"errors" => $validate->messages()));
		}
		else{
			//Auth::loginUsingId(3);
			$auth= Auth::attempt(array(
										 'email' =>	Input::get('email'),
										 'password' =>	Input::get('password')
										 //'type'  => Input::get('type')
									  )); 
			if ($auth) {
			  return Response::json(array('status' => true, 'message' => 'You are login',"data" => Auth::user()));
			}
			else{
			  return Response::json(array('status' => false,
			  							 'message' => 'Credentials are  incorrect',
										 "errors" => array("msg" => "Credentials are  incorrect" )));
			}
		}
	}
	
	public function logout(){
		Auth::logout();	
		return Response::json(array('status' => 'success', 'message' => 'logout successfully'));
	}
}
?>