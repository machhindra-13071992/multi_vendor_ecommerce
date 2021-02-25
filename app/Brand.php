<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
      'id','uuid','name','image_file','active','created_at','updated_at','created_by','modified_by' 
   ];
}
