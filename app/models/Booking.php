<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;

class Booking extends Eloquent implements UserInterface {

	use UserTrait;
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'booking';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	
	
	protected $fillable = array(
								"user_id",
								"cook_id",
								"dish_id",
								"booking_date",
								"venue",
								'quantity',
								"details",
								'status',
								);
								
	
	public function user()
    {
        return $this->belongsTo("User","user_id","id");
    }
	
	public function dish()
    {
        return $this->belongsTo("Dish","dish_id","id");
    }						
	
	
}