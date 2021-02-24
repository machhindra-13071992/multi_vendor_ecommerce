<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
	use Notifiable;

    protected $gaurded = [];

    protected $fillable = [
        'full_name','short_name','post_box','country_id','address','document_data','company_logo_file','status','created_at', 'updated_at', 'created_by', 'updated_by'
    ];
	
	public function countries()
    {
        return $this->belongsTo(\App\Country::class, 'country_id');
    }
  
}
