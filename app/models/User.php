<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('remember_token');
	
	protected $fillable = array("name","email","password","phone","mobile",'dob','address','city','state','zip','website','specialty','work_history','profile_photo','type',"latitude","longitude","verification","email_verification_code","certification","ssn_ein","business_name","amount_time","write_book","travel","fav_food","least_fav","facebook","youtube","twitter","instagram","payment","cooking_type","licence_no","licence_img","is_complete");

	
}
