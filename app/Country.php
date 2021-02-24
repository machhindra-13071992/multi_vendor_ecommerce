<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
	use Notifiable;

    protected $gaurded = [];

    protected $fillable = [
        'name',  'link', 'created_at', 'updated_at', 'created_by', 'modified_by','is_domestic_country','active'
    ];
}
