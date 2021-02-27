<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
	use Notifiable;

    protected $gaurded = [];

    protected $fillable = [
        'name','category_id','status', 'created_at', 'updated_at', 'created_by', 'modified_by'
    ];
	
	public function categories()
    {
        return $this->belongsTo(\App\Category::class,'category_id');
    }
}
