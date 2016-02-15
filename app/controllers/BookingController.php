<?php

class BookingController extends BaseController {
	
	
	function index(){
	
		if(Input::has("type")){
			
			$bookings = Booking::where("cook_id",Auth::user()->id)->get();
			
			$bookings = array_map(function($row){
				
				$array = array();
				
				$array["title"] =  $row["details"];
				
				$date = new DateTime($row["booking_date"]);
	       		$row["start"] = $date->format('Y-d-m');
				
				return $array;
				
			},$bookings->toArray());
			
		}else{
			$bookings = Booking::with('user','dish')->where("cook_id",Auth::user()->id)->get();
		}
	
		
			
		return Response::json(array('status' =>true, 'message' => "","bookings" => $bookings));
	}
	
	
}