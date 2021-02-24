<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class UserMoneyTransaction extends Model
{
	use Notifiable;

    protected $gaurded = [];

    protected $fillable = ['user_id','is_deposite','amount','created_at','updated_at'];
}
