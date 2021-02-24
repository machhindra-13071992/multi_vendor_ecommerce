<?php
  
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class UserPermission extends Authenticatable
{
    use Notifiable;
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description','created_at', 'updated_at', 'created_by', 'modified_by',
        'create_new_user', 'edit_existing_user', 'change_status_of_user', 'customer_data_entry', 'stock_data_entry_screen',
		'add_customer','edit_customer','view_customer','change_status_of_customer',
        'stock_edit_change_status', 'mode_of_shipment', 'shipment_schedule', 'delivery', 'payment_terms', 'access_to_bank','port_of_destination',
		'access_to_company','performa_invoice','shipment_tracking'
    ];
  
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