<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;

class Dish extends Eloquent implements UserInterface {

	use UserTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'dishs';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	
	
	protected $fillable = array("name",
								"cook_id",
								"dish_for_day_night",
								"delivery_method",
								"dish_type",
								"dish_img",
								"dish_video",
								"special_notes",
								"description",
								"address",
								"zipcode",
								"quantity",
								"unfulfilled",
								"price");
	
	 public function user()
    {
        return $this->belongsTo('User',"cook_id","id");
    }
	

	

	
}