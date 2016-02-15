<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('index');
});

Route::get('/admin', function()
{
	return View::make('admin');
});

Route::get('/order/status', function()
{
	return View::make('order_status');
});

Route::get('/order/status/{id}', array("uses" => "OrderController@getOrderDetails"));


Route::get('/cook', function()
{
	return Request::server("HTTP_HOST");
});

Route::get("/user/photo/{id}",function($id){
		
		$data = User::find($id);
		if(!empty($data)){
			$photo = $data->profile_photo;
			
			return Response::json(array('status' => true, 'message' => "", "data"  => $photo ));
		}
		
		return Response::json(array('status' => true, 'message' => "", "data"  => '' ));
});

Route::get('verification/email/{code}',array("uses" => "VerificationController@emailVerification"));

Route::post('forgotpassword',array("uses" => "UserController@forgotPassword"));
Route::post('resetpassword',array("uses" => "UserController@resetPassword"));
//login
Route::post('login', array('uses' => 'AuthenticationController@checkCredentials', 'as' => "login"));
Route::get('logout', array('uses' => 'AuthenticationController@logout' , 'as' => "logout"));


Route::post('register', array('uses' => 'UserController@register' ,"as" => "register"));
Route::get('user',array("before"=>"auth" ,'uses' =>  'UserController@getUserInfo'));
Route::post("user",array("before" => "auth" ,  "uses" => "UserController@UserUpdate"));

Route::post("licenseUpdate",array("before" => "auth" ,  "uses" => "UserController@userlicenseUpdate"));

Route::post("contact",array("uses" => "ContactController@contact"));

Route::post('reservation', array('uses' => 'ReservationController@reserve' ,"as" => "reserve"));

//file handling
Route::post("files/upload",array("before"=>"auth","uses" => "FilesController@index"));
Route::post("files/destroy",array("before"=>"auth","uses" => "FilesController@destroy"));


Route::post("search", array("uses" => "DishController@search"));

Route::get("dishs", array("uses" => "DishController@index"));

Route::get("cook/dishs", array("before" => "auth" ,"uses" => "DishController@cookDishs"));
Route::get("cook/dish/{dish}", array("before" => "auth" ,"uses" => "DishController@showDish"));

Route::get("cook/my-photos", array("before" => "auth" ,"uses" => "DishController@photos"));
Route::get("cook/my-videos", array("before" => "auth" ,"uses" => "DishController@videos"));


Route::get("cook/my-orders", array("before" => "auth" ,"uses" => "OrderController@cookOrders"));
Route::get("my-orders", array("before" => "auth" ,"uses" => "OrderController@userOrders"));
Route::post("order/place", array("before" => "auth" ,"uses" => "OrderController@orderPlace"));

Route::get("cook/booking", array("before" => "auth" ,"uses" => "BookingController@index"));
	
Route::post("survey", array("uses" => "SurveyController@insert" ))	;
	
Route::group(['before' => 'auth'], function() {
	
	Route::post("/send", array("before" => "auth" ,"uses" => "UserController@send"));
	
	Route::get("/receiver/{id}",array("uses" => "UserController@receiver"));
	
    Route::resource('mycart', 'CartController');
	Route::resource('dish', 'DishController',array('except' => array("edit",'create')));
	
	Route::get("cook/plans", array("uses" => "PlanController@plans"));
	
	Route::get("cook/plan/{id}", array("uses" => "PlanController@active"));
	
	Route::post("update/dish/status", array("uses" => "OrderController@updateDishStatus"));
	
	Route::get("/payments",array("uses" => "UserController@payments"));
	
	Route::post("/likes",array("uses" => "UserController@userLikes"));
});





Route::post("admin/login",array("uses" => "AdminController@login" ));


Route::group(['before' => 'auth.admin'], function() {
	Route::post("admin/logout",array("uses" => "AdminController@logout" ));
	Route::post("admin/grandInfo",array("uses" => "AdminController@grandTotalInfo" ));
	
	Route::get("admin/users",array("uses" => "AdminController@users" ));
	Route::post("admin/user",array("uses" => "AdminController@userUpdate" ));
	Route::delete("admin/user/{id}",array("uses" => "AdminController@userDelete" ));
	
	Route::get("admin/dishs",array("uses" => "AdminController@dishs" ));
	Route::post("admin/dish",array("uses" => "AdminController@updateDish" ));
	Route::delete("admin/dish/{id}",array("uses" => "AdminController@dishDelete" ));
	
	
	Route::get("admin/payments",array("uses" => "AdminController@paymentDone" ));
	Route::delete("admin/payment/{id}",array("uses" => "AdminController@deletePayments" ));
	
	
	Route::get("admin/sales",array("uses" => "AdminController@topsalesRecord" ));
	
	Route::get("admin/cookPayments", array("uses" => "AdminController@cookPayments" ));
	
	Route::post("admin/cookPayNow", array("uses" => "AdminController@cookPayNow" ));
	
	
	//Route::post("admin/dishs",array("before" => "auth.admin" ,"uses" => "AdminController@users" ));

});

Route::get("/123",function(){
	

	
	echo User::count();
});


