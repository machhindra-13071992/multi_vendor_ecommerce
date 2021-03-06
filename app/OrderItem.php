<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
	use Notifiable;

    protected $gaurded = [];

    protected $fillable = [
        'status','created_at','updated_at', 'created_by', 'updated_by'
    ];
	
	public function users()
    {
        return $this->belongsTo(\App\User::class,'user_id');
    }
  
}
