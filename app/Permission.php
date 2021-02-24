<?php
  
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Permission extends Authenticatable
{
    use Notifiable;
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','description','created_at','updated_at','status','created_by','modified_by'];
  
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
   
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'full_view' => 'boolean', 'full_add' => 'boolean', 'full_edit' => 'boolean', 'full_delete' => 'boolean', 'super_config' => 'boolean', 'config' => 'boolean',
    ];


}