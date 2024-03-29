<?php

class DishController extends BaseController {


	public function index(){
		 
		$data = Dish::with("user")->whereZipcode(Auth::user()->zip)->orderBy("created_at",'desc')->get();
		return Response::json(array('status' => true, 'message' => "", "data" => $data));
	
	}

	public function create(){}
	
	
	public function store(){
		$validate=Validator::make(Input::all(),array(
			'name'    =>'required',
			'quantity'    =>'required',
			'price' =>'required',
		));
		
		if($validate->fails()){
			return Response::json(array('status' => false, 'message' => "Validation Failed" , "errors" => $validate->messages()));
		}else{
			
			$data = array_merge(Input::all(),array('cook_id' => Auth::user()->id));
			
			$user = Dish::create($data);
			if($user){
				return Response::json(array('status' => true, 'message' => "Dish Create Successfully !!"));
			}else{
				return Response::json(array('status' => true, 'message' => "Dish Create Failed"));
			}
		}
	}
	
	

	public function show($id){
		
		$dish =  Dish::find($id);
		
		if($dish)
			return Response::json(array('status' => true, 'message' => "", "dish" => $dish));
		else
			return Response::json( array('status' => false, 'message' => "dish not found"));
		
	}
	

	public function edit($id){}
	

	//PUT/PATCH
	public function update($id){
		
		
		$rules = array();
		if(Input::has("name"))
		{
			$rules["name"] = "required";
		}
		if(Input::has("quantity"))
		{
			$rules["quantity"] = "required";
		}
		if(Input::has("price"))
		{
			$rules["price"] = "required";
		}
		
		$validate=Validator::make(Input::all(),$rules);
		
		if($validate->fails()){
			return Response::json(array('status' => false, 'message' => "Validation Failed" , "errors" => $validate->messages()));
		}else{
			
			$dish =  Dish::whereId($id)->whereCook_id(Auth::user()->id)->update(Input::all());
			if($dish){
				return Response::json(array('status' => true, 'message' => "Dish update Successfully !!"));
			}else{
				return Response::json(array('status' => true, 'message' => "Dish not found"));
			}
		}
		
		
	}
	
	public function destroy($id){
		
		$dish =  Dish::whereId($id)->whereUser_id(Auth::user()->id)->delete();
		if($dish)
			return Response::json(array('status' => true, 'message' => "Dish delete Successfully"));
		else
			return Response::json(array('status' => false,'message' => "Dish not found"));
	}
	
	
	public function search(){
		
		$data =array();
		$type = Input::get("type");
		$search = Input::get("s");
	
		
		if($type == "dish"){


			if(is_numeric($search)){
				$dishs = Dish::with('user')->where('zipcode',$search)->get();
			}else{
				$dishs = Dish::with('user')->where('name', 'like', '%'.$search.'%')->get();
			}

			
			if(Input::has("latitude") && Input::has("longitude")){

			$filter_dish = array();
			//distance filter
			foreach($dishs->toArray() as $dish){

				$type2 = "favorite";
				$dish_id = $dish["id"];

				$data21 = UserLike::whereUser_id(Auth::user()->id)
									->whereItem_id($dish_id)
									->Where("type",$type2)
									->first();
				
				if(empty($data21))
					$dish["isFavorite"] = false;
				else
					$dish["isFavorite"] = true;

				$type2 = "follow";

				$data21 = UserLike::whereUser_id(Auth::user()->id)
									->whereItem_id($dish_id)
									->Where("type",$type2)
									->first();
				
				if(empty($data21))
					$dish["isFollow"] = false;
				else
					$dish["isFollow"] = true;
					
				
				$l1= Input::get("latitude"); 
				$l2= Input::get("longitude");
				$max = 20; //miles
				if(Input::has("max"))
					$max = Input::get("max");

				$l3 = $dish["user"]["latitude"]; 
				$l4 = $dish["user"]["longitude"];
				// M Miles, K Kilometers, N Nautical Miles
				
				$distance = Helpers::distance($l1,$l2,$l3,$l4,"M");
				if($distance <= $max){
					$dish["distance"] = ((int)($distance * 100))/100 .' Miles Away';
					$filter_dish[] = $dish;
				}
			}
			
			$data = $filter_dish;
			/*$dishs = array_filter($dishs->toArray(),function($dish){
				
													$l1= Input::get("latitude"); 
													$l2= Input::get("longitude");
													$max = 20; //miles
													if(Input::has("max"))
														$max = Input::get("max");
				
													$l3 = $dish["user"]["latitude"]; 
													$l4 = $dish["user"]["longitude"];
													// M Miles, K Kilometers, N Nautical Miles
													
													$distance = Helpers::distance($l1,$l2,$l3,$l4,"M");
													return ($distance <= $max) ;
													//echo $val["user"]["latitude"];
												});*/
			}
		}
		else{
			$data = User::where('name', 'like', '%'.$search.'%')->get();
			
			
			$data = array_map(function($row){
				
				$type2 = "favoriteCook";
				$cook_id = $row["id"];
		
				$data21 = UserLike::whereUser_id(Auth::user()->id)
									->whereItem_id($cook_id)
									->Where("type",$type2)
									->first();
				
				if(empty($data21))
					$row["isfavoriteCook"] = false;
				else
					$row["isfavoriteCook"] = true;
					
				return $row;
				
			}, $data->toArray());

			
		}
		
		
		
		return Response::json(array('status' => true, 'message' => '', "data" => $data, "type" => $type));
		
	}
	
	public function cookDishs(){
		

		if(Input::has("type")){
			$take = 5;
			
			if(Input::get("type") == "solddish"){
				if(Input::has("take")){
					$take =  intval(Input::get("take"));  	
				}
				$where = [];
				$where["cook_id"] = Auth::user()->id;

				if(Input::has("status")){
					$where["status"] = Input::get("status");
				}
				
				$data = OrderItems::with("dish","user","order")->where($where)->orderBy("created_at",'desc')->take($take)->get();
				
				$data = array_map(function($row){
						
					$array = array();
					$array["name"] = $row["dish"]["name"];
					
					$date = new DateTime($row["order"]["created_at"]);
					$array["sold_date"] = $date->format('d-m-Y');	
					
					
					$array["username"] = $row["user"]["name"];
					
					if($row["order"]["order_address"] != null){
						$array["address"]  = $row["order"]["order_address"];
					}else{
						$array["address"] = $row["user"]["address"];
					}
					
					$array["quantity"] = $row["quantity"];
					
					$array["price"] = $row["dish"]["price"];
					
					$array["dish_id"] = $row["dish"]["id"];
						
					return $array;	
				},$data->toArray());
			}else{
				$data = Dish::with("user")->whereCook_id(Auth::user()->id)->get();
			}
			
		}else{
			$where = [];
			$where["cook_id"] = Auth::user()->id;

			if(Input::has("status")){
				$where["status"] = Input::get("status");
			}

			$data = Dish::with("user")->where($where)->get();

			$data = array_map(function($row){
					$date = new DateTime($row["created_at"]);
					$row["date"] = $date->format('d-m-Y');	
					return $row;
			},$data->toArray());
		}
		
		return Response::json(array('status' => true, 'message' => '', "data" => $data));
		
	}
	
	
	// dish show with user info
	public function showDish($id){
		
		$dishs = Dish::with("user")->find($id)->toArray();
		
		$type2 = "follow";
		
		$followers = UserLike::select(DB::raw('SUM(id) AS followers'))
										->where('item_id', $dishs["id"])
										->where("type",$type2)
										->groupBy('type')
										 ->get()->toArray();
		if(empty($followers)){
			$dishs["followers"] = 0;		
		}else{
			$dishs["followers"] = $followers["followers"];		
		}
								 
										 
		$dishs["time_ago"] = Helpers::time_ago($dishs["created_at"]);
		return Response::json(array('status' => true, 'message' => '', "dishs" => $dishs));
	}
	
	
	public function photos(){
	
		$photos = Dish::whereCook_id(Auth::user()->id)->select("id","name","dish_img")->get();
		return Response::json(array('status' => true, 'message' => '', "photos" => $photos));	
	}
	
	public function videos(){
	
		$videos = Dish::whereCook_id(Auth::user()->id)
						->whereNotNull('dish_video')
						->select("id","name","dish_video")->get();
		return Response::json(array('status' => true, 'message' => '', "videos" => $videos));	
	}



	public function getLastThirtyDayDishSold(){

		$data = array();

		$data = OrderItems::select('quantity','status',DB::raw('SUBSTRING_INDEX(created_at," ", 1) AS cdate'),DB::raw('sum(quantity) as totalDishSold'))
							->whereCook_id(Auth::user()->id)
				   			 ->whereBetween('created_at',array('DATE_SUB(NOW(), INTERVAL 50 DAY)','NOW()'))
							 ->groupBy('cdate')
							 ->get();


		$data = $data->toArray();

		$date = date("Y-m-d", strtotime("-30 day"));

		$list = array();

		$list["categories"] = array();
		$list["data"] = array();

		while (strtotime($date) <= strtotime('now')) {

			$isDataFound = false;
			foreach($data as $row){
				if($row['cdate'] == $date){
					$isDataFound=true;
					$list["categories"][] = $date;
					$list["data"][]  = $row["totalDishSold"];
					break;
				}
			}

			if(!$isDataFound){
				$list["categories"][] = $date;
				$list["data"][]  = 0;
			}

			$date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
		}

		return Response::json(array('status' => true, 'message' => '', "data" => $list));

	}

	public function getTopSoldDish(){

		$data = array();

		$data = OrderItems::with('dish')
							->select('quantity','status','dish_id',DB::raw('sum(quantity) as totalDishSold'))
							->groupBy('dish_id')
							->orderBy('totalDishSold','desc')
							->take(5)
							->get();


		return Response::json(array('status' => true, 'message' => '', "data" => $data));

	}

	public function getLastThirtyDayTopSoldDish(){

		$data = array();

		$data = OrderItems::with('dish')
			->select('quantity','status',DB::raw('sum(quantity) as totalDishSold','dish_id',DB::raw('SUBSTRING_INDEX(created_at," ", 1) AS cdate')))
			->groupBy('dish_id')
			->orderBy('totalDishSold','desc')
			->take(5)
			->get();


		return Response::json(array('status' => true, 'message' => '', "data" => $data));

	}
}

  