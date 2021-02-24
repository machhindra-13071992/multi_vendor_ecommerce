<?php
  
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use Notifiable;
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','country_id','active'
    ];


    public function countries()
    {
        return $this->belongsTo(\App\Country::class, 'country_id');
    }
}