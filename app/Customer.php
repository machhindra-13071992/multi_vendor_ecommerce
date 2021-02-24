<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
	use Notifiable;

    protected $gaurded = [];

    protected $fillable = [
        'f_name','short_name','po_box','country_id','address','shipping_address','notify_party','payment_terms_id','bank_details','note','status', 'created_at', 'updated_at', 'created_by', 'updated_by'
    ];
	
	public function countries()
    {
        return $this->belongsTo(\App\Country::class, 'country_id');
    }
    
    public function payment_terms()
    {
        return $this->belongsTo(\App\PaymentTerm::class, 'payment_terms_id');
    }
	
	public function customer_remark_details()
    {
        return $this->hasMany(\App\CustomerRemarkDetail::class) ;
    }
}
