<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Auth;
use App\User;
use App\SystemSetting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view)
        {
            $isLoggedIn = false;
			/*check system lock*/
            if (Auth::check()){
				$systemSetting = SystemSetting::first();
				if($systemSetting['is_lock_system'] == '1'){
					die;
				}
                $userid =  Auth::user()->id;
                $data = User::with('roles')->where('id',$userid)->orderBy('id','DESC')->first(); 

                /*Super User Roles*/
                $userRole['dashboard_user'] = $userRole['super_config'] = $userRole['full_add'] = $userRole['full_edit'] = $userRole['full_view'] = $userRole['full_delete'] = $userRole['dashboard_user'] =  false;
                $userRole['create_new_user'] = $userRole['edit_existing_user'] = $userRole['change_status_of_user'] = $userRole['customer_data_entry'] = $userRole['stock_data_entry_screen'] = false;
                $userRole['add_customer'] = $userRole['edit_customer'] = $userRole['view_customer'] = $userRole['change_status_of_customer'] = false;
				$userRole['stock_edit_change_status'] = $userRole['mode_of_shipment'] = $userRole['shipment_schedule'] = $userRole['delivery'] = $userRole['payment_terms'] =  false;
                $userRole['access_to_bank'] = $userRole['port_of_destination'] = $userRole['access_to_company'] = $userRole['performa_invoice'] = $userRole['shipment_tracking'] = false;
                $userRole['is_admin'] = false;
				if($data->role_id == '1'){
					$userRole['is_admin'] = true;
				}
                if($data->roles){
                    foreach($data->roles as $key=>$multiple_roles){
                        if($multiple_roles['full_view'] == true){$userRole['full_view'] = true;}
                        if($multiple_roles['super_config'] == true){$userRole['super_config'] = true;}
                        if($multiple_roles['dashboard_user'] == true){$userRole['dashboard_user'] = true;}
                        if($multiple_roles['full_add'] == true){$userRole['full_add'] = true;}
                        if($multiple_roles['full_edit'] == true){$userRole['full_edit'] = true;}
                        if($multiple_roles['full_delete'] == true){$userRole['full_delete'] = true;}
                    }
                }
                $isLoggedIn = true;
                $view->with(compact('userRole', 'isLoggedIn'));
            }else{
                return redirect('/login');
            }
        });
    }
}
