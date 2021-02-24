<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class UnitMaster extends Model
{
	use Notifiable;

    protected $gaurded = [];

    protected $fillable = [
        'name',  'status', 'created_at', 'updated_at', 'created_by', 'modified_by'
    ];
}
