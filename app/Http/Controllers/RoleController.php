<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

use DB;
use App\Role;

class RoleController extends Controller {
	
/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */

    public function index(Request $request) {
       $roles = Role::orderBy('id','asc')->paginate(20);
        return view('roles.index',compact('roles'))->with('i', ($request->input('page', 1) - 1) * 5);
    }
   
/**
 * Show the form for creating a new resource.
 *
 * @return \Illuminate\Http\Response
 */
    public function create() {
        return view('roles.create');
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
        $rolesData = Role::create($request->all());
        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }
   
/**
 * Display the specified resource.
 *
 * @param  \App\Menu  $roles
 * @return \Illuminate\Http\Response
 */
    public function show(Role $role) {
        $roles = Role::where('id', $role->id)->first();
        return view('roles.show', compact('roles'));
    }
   
/**
 * Show the form for editing the specified resource.
 *
 * @param  \App\VideoSubCategory  $roles
 * @return \Illuminate\Http\Response
 */
    public function edit($id) {
         $roles = Role::find($id);
        return view('roles.edit',compact('roles'));
    }
  
/**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  \App\VideoSubCategory  $roles
 * @return \Illuminate\Http\Response
 */
    public function update(Request $request, Role $Role) {
        $request->validate([
            'name' => 'required'
        ]);
        $request->request->add(['full_view' => $request->request->get('full_view') == true ? true : 0]);
        $request->request->add(['full_add' => $request->request->get('full_add') == true ? true : 0]);
        $request->request->add(['full_edit' => $request->request->get('full_edit') == true ? true : 0]);
        $request->request->add(['full_delete' => $request->request->get('full_delete') == true ? true : 0]);
        $request->request->add(['super_config' => $request->request->get('super_config') == true ? true : 0]);
        $request->request->add(['dashboard_user' => $request->request->get('dashboard_user') == true ? true : 0]);

        $request->request->add(['create_new_user' => $request->request->get('create_new_user') == true ? true : 0]);
        $request->request->add(['edit_existing_user' => $request->request->get('edit_existing_user') == true ? true : 0]);
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
		
        $Role->update($request->all());
        return redirect()->route('roles.index')->with('success', 'Role updated successfully');
    }
  
/**
 * Remove the specified resource from storage.
 *
 * @param  \App\VideoSubCategory  $roles
 * @return \Illuminate\Http\Response
 */

    public function destroy($id=null) {
        Role::where('id',$id)->delete();
        return redirect()->route('roles.index')
                        ->with('success','Role deleted successfully');
    }

}

