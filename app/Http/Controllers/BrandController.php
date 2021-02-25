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
use App\Brand;
use Input;

class BrandController extends Controller
{

/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */

    public function index() {
        $brands = Brand::paginate(20);
        return view('brands.index', compact('brands'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
   
/**
 * Show the form for creating a new resource.
 *
 * @return \Illuminate\Http\Response
 */
    public function create() {
        $uuid = Str::uuid();
        return view('brands.create',compact('uuid'));
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
        $BrandData = Brand::create($request->all());
        $this->saveUpdateImageFile($request,$BrandData->id);
        return redirect()->route('brands.index')->with('success', 'Brand created successfully.');
    }
   
/**
 * Display the specified resource.
 *
 * @param  \App\Brand  $Brand
 * @return \Illuminate\Http\Response
 */
    public function show(Brand $Brand) {
        $isUpdateStatusFlag = false;
        if(Input::has('update_status_flag')){
                $isUpdateStatusFlag = true;
        }
        $brands = Brand::where('id', $Brand->id)->first();
        return view('brands.show', compact('brands','isUpdateStatusFlag'));
    }
   
/**
 * Show the form for editing the specified resource.
 *
 * @param  \App\Brand  $Brand
 * @return \Illuminate\Http\Response
 */
    public function edit($id) {
        $brands = Brand::where('id', $id)->first();
        return view('brands.edit',compact('brands'));
    }
  
/**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  \App\Brand  $Brand
 * @return \Illuminate\Http\Response
 */
    public function update(Request $request, Brand $Brand) {
        if (Input::has('brands_cultivations')){
            $brands_cultivations_Ids = Input::get('brands_cultivations');
            DB::table('brands_cultivations')->where('brand_id',$request->id)->delete();
            $Brand->brands_cultivations()->attach($brands_cultivations_Ids);
        }
        $this->saveUpdateImageFile($request,$Brand->id);
        $Brand->update($request->all());
        return redirect()->route('brands.index')->with('success', 'Brand updated successfully');
    }
    
    public function saveUpdateImageFile($request,$brand_id=null){
        $attachmentFilePath = null;
        if($request->hasFile('image_file')){           
            $filenameWithExt = $request->file('image_file')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);            
            $extension = $request->file('image_file')->getClientOriginalExtension();
            $attachmentFilePath = $filename.'_'.time().'.'.$extension;                       
            $path = $request->file('image_file')->storeAs('brand_image_files',$attachmentFilePath);
        }else{
            $cDetails = Brand::where('id',$brand_id)->first();
            $attachmentFilePath = $cDetails['image_file'];
        }
        DB::table('brands')->where('id',$brand_id)->update(['image_file' =>$attachmentFilePath]);
    }
  
/**
 * Remove the specified resource from storage.
 *
 * @param  \App\Brand  $Brand
 * @return \Illuminate\Http\Response
 */

    public function destroy($id=null) {
        Brand::where('id',$id)->delete();
        return redirect()->route('brands.index')
                        ->with('success','Brand deleted successfully');
    }

}
