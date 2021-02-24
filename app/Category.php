<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	use Notifiable;

    protected $gaurded = [];

    protected $fillable = [
        'name',  'status', 'created_at', 'updated_at', 'created_by', 'modified_by'
    ];
	
	public function categories_cultivations()
    {
        return $this->belongsToMany(Cultivation::class,'categories_cultivations');
    }
}
