<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
	use Notifiable;

    protected $gaurded = [];

    protected $fillable = [
        'name',  'active', 'created_at', 'updated_at', 'created_by', 'modified_by'
    ];
}
