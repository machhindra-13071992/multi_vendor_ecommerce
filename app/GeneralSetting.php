<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
	use Notifiable;

    protected $gaurded = [];

    protected $fillable = [
        'site_name','uuid','user_id','site_description','meta_title','meta_key','meta_desc','active','created_at', 'updated_at', 'created_by', 'updated_by'
    ];
	
	public function users()
    {
        return $this->belongsTo(\App\User::class,'user_id');
    }
	
}
