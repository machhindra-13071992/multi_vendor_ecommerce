<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
	use Notifiable;

    protected $gaurded = [];

    protected $fillable = [
        'name','is_lock_system','created_at', 'updated_at'
    ];
}
