<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use DB;
use App\Vendor;
use Input;

class VendorController extends Controller
{

/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */

    public function index() {
        $vendors = Vendor::with('users')->paginate(20);
        return view('vendors.index', compact('vendors'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
   
/**
 * Show the form for creating a new resource.
 *
 * @return \Illuminate\Http\Response
 */
    public function create() {
        $uuid = Str::uuid();
        return view('vendors.create',compact('uuid'));
    }

/**
 * Store a newly created resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
    public function store(Request $request) {
        $request->validate([
            'f_name' => 'required'
        ]);
        $this->saveUpdateVendorDetails($request);
        return redirect()->route('vendors.index')->with('success', 'Vendor created successfully.');
    }
   
/**
 * Display the specified resource.
 *
 * @param  \App\Vendor  $Vendor
 * @return \Illuminate\Http\Response
 */
    public function show(Vendor $Vendor) {
        $isUpdateStatusFlag = false;
        if(Input::has('update_status_flag')){
                $isUpdateStatusFlag = true;
        }
        $vendors = Vendor::where('id', $Vendor->id)->first();
        return view('vendors.show', compact('vendors','isUpdateStatusFlag'));
    }
   
/**
 * Show the form for editing the specified resource.
 *
 * @param  \App\Vendor  $Vendor
 * @return \Illuminate\Http\Response
 */
    public function edit($id) {
        $vendors = Vendor::with('users')->where('id', $id)->first();
        return view('vendors.edit',compact('vendors'));
    }
  
/**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  \App\Vendor  $Vendor
 * @return \Illuminate\Http\Response
 */
    public function update(Request $request, Vendor $Vendor) {
        $this->saveUpdateVendorDetails($request);
        return redirect()->route('vendors.index')->with('success', 'Vendor updated successfully');
    }
    
    public function saveUpdateImageFile($request,$Vendor_id=null){
        $attachmentFilePath = null;
        if($request->hasFile('image_file')){           
            $filenameWithExt = $request->file('image_file')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);            
            $extension = $request->file('image_file')->getClientOriginalExtension();
            $attachmentFilePath = $filename.'_'.time().'.'.$extension;                       
            $path = $request->file('image_file')->storeAs('Vendor_image_files',$attachmentFilePath);
        }else{
            $cDetails = Vendor::where('id',$Vendor_id)->first();
            $attachmentFilePath = $cDetails['image_file'];
        }
        DB::table('vendors')->where('id',$Vendor_id)->update(['image_file' =>$attachmentFilePath]);
    }

    public function saveUpdateVendorDetails($request){
        $dataArr = array('f_name'=> isset($request['f_name']) ? $request['f_name'] : null,
            'l_name'=>isset($request['l_name']) ? $request['l_name'] : null,
            'email' => isset($request['email']) ? $request['email'] :null,
            'user_name' => isset($request['user_name']) ? $request['user_name'] :null,
            'mobile_no'=>isset($request['mobile_no']) ? $request['mobile_no'] :0,
            'password'=>isset($request['password']) ? $request['password'] :"111",
            'password_string'=>isset($request['password']) ? $request['password'] :"111",
            'status'=>isset($request['status']) ? $request['status'] :0,
            'is_created_by_admin'=>isset($request['is_created_by_admin']) ? $request['is_created_by_admin'] :0,
            'role_id'=>isset($request['role_id']) ? $request['role_id'] :0,
            'uuid'=>isset($request['uuid']) ? $request['uuid'] :null,
            'created_at'=>$request['created_at'],
            'updated_at'=>$request['updated_at'],
            'created_by'=>$request['created_by'],
            'modified_by'=>$request['modified_by']);

            if($request['user_id'] != ""){
                $user_id = $request['user_id'];
                DB::table('users')->where('id',$request['user_id'])->update($dataArr);
            }else{
                DB::table('users')->insert($dataArr);
                $user_id = DB::getPdo()->lastInsertId(); 
            }

            $dataVendorArr = array('gst_number'=> isset($request['gst_number']) ? $request['gst_number'] : null,
            'user_id'=>$user_id,
            'commission_per'=>isset($request['commission_per']) ? $request['commission_per'] :0,
            'status'=>isset($request['status']) ? $request['status'] :0,
            'uuid'=>isset($request['uuid']) ? $request['uuid'] :0,
            'created_at'=>$request['created_at'],
            'updated_at'=>$request['updated_at'],
            'created_by'=>$request['created_by'],
            'modified_by'=>$request['modified_by']);

            if($request['id'] != ""){
                $id = $request['id'];
                DB::table('vendors')->where('id',$request['id'])->update($dataVendorArr);
            }else{
                DB::table('vendors')->insert($dataVendorArr);
                $id = DB::getPdo()->lastInsertId(); 
            }
    }
  
/**
 * Remove the specified resource from storage.
 *
 * @param  \App\Vendor  $Vendor
 * @return \Illuminate\Http\Response
 */

    public function destroy($id=null) {
        Vendor::where('id',$id)->delete();
        return redirect()->route('vendors.index')
                        ->with('success','Vendor deleted successfully');
    }

}
