<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class CookPayments extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;
	
	
	protected $table = 'cook_payments';
	
	protected $fillable = array("cook_id","paid_amount","payment_mode","remarks");
	
}