<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;

class Order extends Eloquent implements UserInterface {

	use UserTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'orders';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	
	
	protected $fillable = array(
								"user_id",
								"dish_id",
								"cook_id",
								'quantity',
								"status",
								'rating',
								);
	
	public function user()
    {
        return $this->belongsTo("User","user_id","id");
    }
	
	public function dish()
    {
        return $this->belongsTo("Dish","dish_id","id");
    }
	
	public function orderItems()
    {
        return $this->hasMany("OrderItems","order_id","id");
    }

	
}