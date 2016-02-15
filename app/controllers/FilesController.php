<?php

class FilesController extends BaseController {
	
	
	function index(){
		
		$validate=Validator::make(Input::all(),array(
			'file'    =>'required',
		));
		
		if($validate->fails()){
			return Response::json(array('status' => false, 'message' => 'file required'));
		}
		
		$file = Input::file('file');
		
		$fileName =  Str::random(40);
		$extension = $file->getClientOriginalExtension();
		
		$fileName = date('Y-m-d-H-i-s-').$fileName.'.'.$extension;
		
		$path = public_path().'/uploads/';
		
		
		$file->move($path, $fileName);
		
		return Response::json(array(
									'status' => true,
									'message' => 'file uploaded',
									"fileName" => $fileName
									));
	}
	
	function destroy(){
		
		$validate=Validator::make(Input::all(),array(
			'file'    =>'required',
		));
		
		if($validate->fails()){
			return Response::json(array('status' => false, 'message' => 'file required'));
		}
		
		$file = Input::get('file');
		$path = public_path().'/uploads/'.$file;
		
		
		if(file_exists($path)){
			if(unlink($path)){
				return Response::json(array('status' => true, 'message' => 'file delete Successfully'));	
			}else{
				return Response::json(array('status' => false, 'message' => 'file delete failed'));
			}
		}
		else{
			return Response::json(array('status' => false, 'message' => 'file not exists'));
		}
		
		
	}
	
}