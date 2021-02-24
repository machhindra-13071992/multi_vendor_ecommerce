<?php
  
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;


class City extends Model
{
    use Notifiable;
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','country_id','state_id','active'
    ];

    public function countries()
    {
        return $this->belongsTo(\App\Country::class, 'country_id');
    }

    public function states()
    {
        return $this->belongsTo(\App\State::class, 'state_id');
    }
}