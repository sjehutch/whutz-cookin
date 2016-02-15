<?php

class SurveyController extends BaseController {
	
	
	public function insert(){
		
		$servey = Survey::create(Input::all());
		if($servey){
			return  Response::json(array('status' => true, 'message' => "Survey info create Successfully!!"));
		}else{
			return  Response::json(array('status' => false, 'message' => "Survey info not create failed, try after som e time"));
		}
	}
	
	
	
}