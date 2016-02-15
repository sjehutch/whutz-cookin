<?php

class CartController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$carts = Cart::with('dish')->whereUser_id(Auth::user()->id)->get();
		
		  
		return Response::json(array('status' => true, 'message' => "", "data" => $carts));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$names = array(
			'dish_id' => 'dish Id',
			'quantity' => 'Quantity'
		);
		$validate=Validator::make(Input::all(),array(
			'dish_id'    =>'required',
			"quantity"	=>"required"
		));
		$validate->setAttributeNames($names); 
		
		if($validate->fails()){
			return Response::json(array('status' => false, 'message' => "Validation Failed" , "errors" => $validate->messages()));
		}else{
			
			$data = array_merge(Input::all(),array('user_id' => Auth::user()->id));

			$user = Cart::create($data);
			if($user){
				return Response::json(array('status' => true, 'message' => "Cart item Successfully !!"));
			}else{
				return Response::json(array('status' => false, 'message' => "Cart item Create Failed"));
			}
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$affectedRows  = Cart::whereUser_id(Auth::user()->id)->whereId($id)->delete();
		 
		if($affectedRows > 0)
			return	Response::json(array('status' => true, 'message' => "Item remove successfully", ));
		else
			return	Response::json(array('status' => true, 'message' => "Item remove failed", ));	
	}


}

