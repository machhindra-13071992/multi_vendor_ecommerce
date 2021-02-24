<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
	use Notifiable;

    protected $gaurded = [];

    protected $fillable = [
        'name',  'iso_code', 'created_at', 'updated_at', 'created_by', 'modified_by','active'
    ];
}
