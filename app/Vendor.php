<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = [
      'id','uuid','gst_number','account_number','active','created_at','updated_at','created_by','modified_by' 
   ];

   public function users()
    {
        return $this->belongsTo(\App\User::class,'user_id');
    }
}
