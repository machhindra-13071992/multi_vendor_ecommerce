<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class ItemType extends Model
{
	use Notifiable;

    protected $gaurded = [];

    protected $fillable = [
        'name','created_at', 'updated_at', 'created_by', 'modified_by','status'
    ];
}
