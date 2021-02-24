<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;


class MenuLink extends Model
{
	use Notifiable;

	public $actsAs = array(
		'Tree'
	);
	
    protected $gaurded = [];

    protected $fillable = [
        'parent_id','lft','rght','menu_id','icon','title','link','attributes','active','created_at','updated_at','created_by','modified_by'
    ];


	public function parent_menu_links()
    {
        return $this->belongsTO(\App\MenuLink::class);
    }
    public function menus()
    {
        return $this->belongsTO(\App\Menu::class,'menu_id');
    }

    public function Child_menu_links()
    {
        return $this->hasMany(\App\MenuLink::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'menu_links_roles');
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'menu_links_users');
    }

    /**
     * Get the index name for the model.
     *
     * @return string
    */
    public function childs() {
        return $this->hasMany(\App\MenuLink::class,'parent_id','id');
    }

    public function parents() {
        return $this->hasOne(\App\MenuLink::class,'id','parent_id');
    }

}
