<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class OrderItems extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'order_items';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('remember_token');
	
	protected $fillable = array("order_id","user_id","dish_id","cook_id","quantity","status","rating");
	
	
	public function dish()
    {
        return $this->belongsTo("Dish","dish_id","id");
    }
	
	public function cook()
    {
        return $this->belongsTo("User","cook_id","id");
    }
	
	public function user(){
		return $this->belongsTo("User","user_id","id");
	}
	
	public function order(){
		return $this->belongsTo("Order","order_id","id");
	}
	
}