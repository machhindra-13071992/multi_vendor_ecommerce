<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
	use Notifiable;

    protected $gaurded = [];

    protected $fillable = [
        'name','short_name','post_box','country_id','company_id','currency_id','address','account_number','swift_code','ifsc_code','status', 'created_at', 'updated_at', 'created_by', 'updated_by'
    ];
	
	public function countries()
    {
        return $this->belongsTo(\App\Country::class, 'country_id');
    }
    
    public function companies()
    {
        return $this->belongsTo(\App\Company::class,'company_id');
    }
	
	public function currencies()
    {
        return $this->belongsTo(\App\Currency::class, 'currency_id');
    }
}
