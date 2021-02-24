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
                $data = User::with('roles','user_permissions')->where('id', $userid)->orderBy('id', 'DESC')->first(); 
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
				
				if($data->user_permissions){
                    foreach($data->user_permissions as $key=>$multiple_roles){
                        if($multiple_roles['create_new_user'] == true){$userRole['create_new_user'] = true;}
                        if($multiple_roles['edit_existing_user'] == true){$userRole['edit_existing_user'] = true;}
                        if($multiple_roles['change_status_of_user'] == true){$userRole['change_status_of_user'] = true;}
                        if($multiple_roles['customer_data_entry'] == true){$userRole['customer_data_entry'] = true;}
                        if($multiple_roles['stock_data_entry_screen'] == true){$userRole['stock_data_entry_screen'] = true;}
						
						if($multiple_roles['add_customer'] == true){$userRole['add_customer'] = true;}
						if($multiple_roles['edit_customer'] == true){$userRole['edit_customer'] = true;}
						if($multiple_roles['view_customer'] == true){$userRole['view_customer'] = true;}
						if($multiple_roles['change_status_of_customer'] == true){$userRole['change_status_of_customer'] = true;}

                        if($multiple_roles['stock_edit_change_status'] == true){$userRole['stock_edit_change_status'] = true;}
                        if($multiple_roles['mode_of_shipment'] == true){$userRole['mode_of_shipment'] = true;}
                        if($multiple_roles['shipment_schedule'] == true){$userRole['shipment_schedule'] = true;}
                        if($multiple_roles['delivery'] == true){$userRole['delivery'] = true;}
                        if($multiple_roles['payment_terms'] == true){$userRole['payment_terms'] = true;}

                        if($multiple_roles['access_to_bank'] == true){$userRole['access_to_bank'] = true;}
                        if($multiple_roles['port_of_destination'] == true){$userRole['port_of_destination'] = true;}
                        if($multiple_roles['access_to_company'] == true){$userRole['access_to_company'] = true;}
                        if($multiple_roles['performa_invoice'] == true){$userRole['performa_invoice'] = true;}
                        if($multiple_roles['shipment_tracking'] == true){$userRole['shipment_tracking'] = true;}
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
