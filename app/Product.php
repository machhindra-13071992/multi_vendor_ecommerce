<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	use Notifiable;

    protected $gaurded = [];

    protected $fillable = [
        'product_code','product_name','product_description','quantity_id','user_id','price','discount','image_file','category_id','sub_category_id','image_file','status','created_at', 'updated_at', 'created_by', 'updated_by'
    ];
	
	public function users()
    {
        return $this->belongsTo(\App\User::class,'user_id');
    }
	
	public function categories()
    {
        return $this->belongsTo(\App\Category::class,'category_id');
    }
    
}
