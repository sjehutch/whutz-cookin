<?php

class ReservationController extends BaseController {
	
	
	public function reserve(){		
		
		$validate=Validator::make(Input::all(),array(
			'f_name'    =>'required',
			'l_name'    =>'required',
			'email' =>'required',
			'book_date'     => 'required',
			'party_size'     => 'required'
			));
		if($validate->fails()){
			return Response::json(array('status' => false, 'message' => "Validation Failed" , "errors" => $validate->messages()));
		}else{	
			$data = Input::all();
			
			$reserve = Reservation::create($data);
			if($reserve){
				Helpers::emailReservation(Input::get("email"),Input::get("phone"),Input::get("f_name"),Input::get("l_name"),Input::get("book_date"),Input::get("party_size"));
				return Response::json(array('status' =>true, 'message' => "Reservation Submitted!!".$reserve));
			}else{
				return Response::json(array('status' =>true, 'message' => "Reservation Failed"));
			}
		}
	}
	
}