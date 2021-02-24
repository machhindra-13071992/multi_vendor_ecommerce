<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

use DB;
use Input;
use App\Permission;
use App\UserPermission;

class PermissionController extends Controller {
	
/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */

    public function index(Request $request) {
       $permissions = Permission::orderBy('id','asc')->paginate(20);
        return view('permissions.index',compact('permissions'))->with('i', ($request->input('page', 1) - 1) * 5);
    }
   
/**
 * Show the form for creating a new resource.
 *
 * @return \Illuminate\Http\Response
 */
    public function create() {
        return view('permissions.create');
    }

/**
 * Store a newly created resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
    public function store(Request $request) {
        $request->validate([
            'name' => 'required'
        ]);
        $PermissionsData = Permission::create($request->all());
        return redirect()->route('permissions.index')->with('success', 'Permission created successfully.');
    }
   
/**
 * Display the specified resource.
 *
 * @param  \App\Menu  $Permissions
 * @return \Illuminate\Http\Response
 */
    public function show(Permission $Permission) {
        $permissions = Permission::where('id', $Permission->id)->first();
        return view('permissions.show', compact('Permissions'));
    }
   
/**
 * Show the form for editing the specified resource.
 *
 * @param  \App\VideoSubCategory  $Permissions
 * @return \Illuminate\Http\Response
 */
    public function edit($id) {
         $permissions = Permission::find($id);
        return view('permissions.edit',compact('permissions'));
    }
  
/**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  \App\VideoSubCategory  $Permissions
 * @return \Illuminate\Http\Response
 */
    public function update(Request $request, Permission $Permission) {
        $request->validate([
            'name' => 'required'
        ]);
        $request->request->add(['status' => $request->request->get('status') == true ? true : 0]);
        $Permission->update($request->all());
        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully');
    }
	
	
	public function user_permissions()
    {
		$userPermissions = UserPermission::where('active', true)->orderBy('name')->first();
        return view('permissions.user_permissions',compact('userPermissions'));
    }
	
	public function post_user_permission_data(Request $request){
		if(Input::get('id')){
			$request->request->add(['create_new_user' => $request->request->get('create_new_user') == true ? 1 : 0]);
			$request->request->add(['edit_existing_user' => $request->request->get('edit_existing_user') == true ? 1 : 0]);
			$request->request->add(['change_status_of_user' => $request->request->get('change_status_of_user') == true ? true : 0]);
			$request->request->add(['customer_data_entry' => $request->request->get('customer_data_entry') == true ? true : 0]);
			$request->request->add(['stock_data_entry_screen' => $request->request->get('stock_data_entry_screen') == true ? true : 0]);
			$request->request->add(['stock_edit_change_status' => $request->request->get('stock_edit_change_status') == true ? true : 0]);
			$request->request->add(['mode_of_shipment' => $request->request->get('mode_of_shipment') == true ? true : 0]);
			$request->request->add(['shipment_schedule' => $request->request->get('shipment_schedule') == true ? true : 0]);
			$request->request->add(['delivery' => $request->request->get('delivery') == true ? true : 0]);
			$request->request->add(['payment_terms' => $request->request->get('payment_terms') == true ? true : 0]);
			$request->request->add(['access_to_bank' => $request->request->get('access_to_bank') == true ? true : 0]);
			$request->request->add(['port_of_destination' => $request->request->get('port_of_destination') == true ? true : 0]);
			$request->request->add(['access_to_company' => $request->request->get('access_to_company') == true ? true : 0]);
			$request->request->add(['performa_invoice' => $request->request->get('performa_invoice') == true ? true : 0]);
			$request->request->add(['shipment_tracking' => $request->request->get('shipment_tracking') == true ? true : 0]);
			$dataArr = array(
				'create_new_user' => $request->create_new_user,
				'edit_existing_user' => $request->edit_existing_user,
				'change_status_of_user' => $request->change_status_of_user,
				'customer_data_entry' => $request->customer_data_entry,
				'stock_data_entry_screen' => $request->stock_data_entry_screen,
				'stock_edit_change_status' => $request->stock_edit_change_status,
				'mode_of_shipment' => $request->mode_of_shipment,
				'shipment_schedule' => $request->shipment_schedule,
				'delivery' => $request->delivery,
				'access_to_bank' => $request->access_to_bank,
				'payment_terms' => $request->payment_terms,
				'port_of_destination' => $request->port_of_destination,
				'access_to_company' => $request->access_to_company,
				'performa_invoice' => $request->performa_invoice,
				'shipment_tracking' => $request->shipment_tracking
			);
			UserPermission::where('id', '=', Input::get('id'))->update($dataArr);
		}else{
			$PermissionsData = UserPermission::create($request->all());
		}
		return redirect()->back()->with('success','User Permissions Added successfully');
	}
  
/**
 * Remove the specified resource from storage.
 *
 * @param  \App\VideoSubCategory  $Permissions
 * @return \Illuminate\Http\Response
 */

    public function destroy($id=null) {
        Permission::where('id',$id)->delete();
        return redirect()->route('Permissions.index')
                        ->with('success','Permission deleted successfully');
    }

}

