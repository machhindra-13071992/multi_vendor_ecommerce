<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

use DB;
use App\SubCategory;
use Input;

class SubCategoryController extends Controller
{

/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */

    public function index() {
        $sub_categories = SubCategory::with('categories')->paginate(20);
        return view('sub_categories.index', compact('sub_categories'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
   
/**
 * Show the form for creating a new resource.
 *
 * @return \Illuminate\Http\Response
 */
    public function create() {
        $categories  = DB::table('categories')->orderBy('name')->pluck('name', 'id')->toArray();
        return view('sub_categories.create',compact('categories'));
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
		$SubCategoryData = SubCategory::create($request->all());
		$this->saveUpdateImageFile($request,$SubCategoryData->id);
        return redirect()->route('sub_categories.index')->with('success', 'SubCategory created successfully.');
    }
   
/**
 * Display the specified resource.
 *
 * @param  \App\SubCategory  $SubCategory
 * @return \Illuminate\Http\Response
 */
    public function show(SubCategory $SubCategory) {
		$isUpdateStatusFlag = false;
		if(Input::has('update_status_flag')){
				$isUpdateStatusFlag = true;
		}
        $sub_categories = SubCategory::where('id', $SubCategory->id)->first();
        return view('sub_categories.show', compact('sub_categories','isUpdateStatusFlag'));
    }
   
/**
 * Show the form for editing the specified resource.
 *
 * @param  \App\SubCategory  $SubCategory
 * @return \Illuminate\Http\Response
 */
    public function edit($id) {
        $sub_categories = SubCategory::where('id', $id)->first();
        $categories  = DB::table('categories')->orderBy('name')->pluck('name', 'id')->toArray();
        return view('sub_categories.edit',compact('sub_categories','categories'));
    }
  
/**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  \App\SubCategory  $SubCategory
 * @return \Illuminate\Http\Response
 */
    public function update(Request $request, SubCategory $SubCategory) {
		if (Input::has('sub_categories_cultivations')){
            $sub_categories_cultivations_Ids = Input::get('sub_categories_cultivations');
            DB::table('sub_categories_cultivations')->where('SubCategory_id',$request->id)->delete();
            $SubCategory->sub_categories_cultivations()->attach($sub_categories_cultivations_Ids);
        }
		$this->saveUpdateImageFile($request,$SubCategory->id);
        $SubCategory->update($request->all());
        return redirect()->route('sub_categories.index')->with('success', 'SubCategory updated successfully');
    }
	
	public function saveUpdateImageFile($request,$SubCategory_id=null){
		$attachmentFilePath = null;
		if($request->hasFile('image_file')){           
			$filenameWithExt = $request->file('image_file')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);            
            $extension = $request->file('image_file')->getClientOriginalExtension();
            $attachmentFilePath = $filename.'_'.time().'.'.$extension;                       
            $path = $request->file('image_file')->storeAs('SubCategory_image_files',$attachmentFilePath);
        }else{
			$cDetails = SubCategory::where('id',$SubCategory_id)->first();
			$attachmentFilePath = $cDetails['image_file'];
		}
		DB::table('sub_categories')->where('id',$SubCategory_id)->update(['image_file' =>$attachmentFilePath]);
	}
  
/**
 * Remove the specified resource from storage.
 *
 * @param  \App\SubCategory  $SubCategory
 * @return \Illuminate\Http\Response
 */

    public function destroy($id=null) {
        SubCategory::where('id',$id)->delete();
        return redirect()->route('sub_categories.index')
                        ->with('success','SubCategory deleted successfully');
    }

}
