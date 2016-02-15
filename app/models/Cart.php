<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;

class Cart extends Eloquent implements UserInterface {

	use UserTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'carts';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	
	
	protected $fillable = array(
								"user_id",
								"dish_id",
								"quantity",
								"status"
								);
	
	 public function dish()
    {
        return $this->belongsTo('Dish',"dish_id","id");
    }

	
}