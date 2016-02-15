<?php

class PlanController extends BaseController {
	
	
	public function plans(){
		
		
		$plans = Plan::all();
		
		if($plans)
			return Response::json(array("status" => true,'message' => "" ,"plans" => $plans ));
		else
			return Response::json(array("status" => false, "message" => "No Plan Found", "plans" => array() ));
	}
	
	
	public function active($id){
		
		$user = Auth::user();
		$user->plan_id = (int)$id;
		$user->save();
		
		
		$data = array("cook_id" => Auth::user()->id, "plan_id" => $id );
		
		$cook_plan = CookPlan::create($data);
		
		if($cook_plan)
			return Response::json(array("status" => true,'message' => "Plan Activated", "user" => Auth::user()  ));
		else
			return Response::json(array("status" => false, "message" => "Plan Acticated failed" ));
		
		
	}
	
	
}