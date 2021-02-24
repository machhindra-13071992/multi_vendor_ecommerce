<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

use DB;
use App\Category;
use Input;

class CategoryController extends Controller
{

/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */

    public function index() {
        $categories = Category::paginate(20);
        return view('categories.index', compact('categories'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
   
/**
 * Show the form for creating a new resource.
 *
 * @return \Illuminate\Http\Response
 */
    public function create() {
        return view('categories.create');
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
		$CategoryData = Category::create($request->all());
		$this->saveUpdateImageFile($request,$CategoryData->id);
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }
   
/**
 * Display the specified resource.
 *
 * @param  \App\Category  $Category
 * @return \Illuminate\Http\Response
 */
    public function show(Category $Category) {
		$isUpdateStatusFlag = false;
		if(Input::has('update_status_flag')){
				$isUpdateStatusFlag = true;
		}
        $categories = Category::where('id', $Category->id)->first();
        return view('categories.show', compact('categories','isUpdateStatusFlag'));
    }
   
/**
 * Show the form for editing the specified resource.
 *
 * @param  \App\Category  $Category
 * @return \Illuminate\Http\Response
 */
    public function edit($id) {
        $categories = Category::where('id', $id)->first();
        return view('categories.edit',compact('categories'));
    }
  
/**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  \App\Category  $Category
 * @return \Illuminate\Http\Response
 */
    public function update(Request $request, Category $Category) {
		if (Input::has('categories_cultivations')){
            $categories_cultivations_Ids = Input::get('categories_cultivations');
            DB::table('categories_cultivations')->where('category_id',$request->id)->delete();
            $Category->categories_cultivations()->attach($categories_cultivations_Ids);
        }
		$this->saveUpdateImageFile($request,$Category->id);
        $Category->update($request->all());
        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }
	
	public function saveUpdateImageFile($request,$category_id=null){
		$attachmentFilePath = null;
		if($request->hasFile('image_file')){           
			$filenameWithExt = $request->file('image_file')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);            
            $extension = $request->file('image_file')->getClientOriginalExtension();
            $attachmentFilePath = $filename.'_'.time().'.'.$extension;                       
            $path = $request->file('image_file')->storeAs('category_image_files',$attachmentFilePath);
        }else{
			$cDetails = Category::where('id',$category_id)->first();
			$attachmentFilePath = $cDetails['image_file'];
		}
		DB::table('categories')->where('id',$category_id)->update(['image_file' =>$attachmentFilePath]);
	}
  
/**
 * Remove the specified resource from storage.
 *
 * @param  \App\Category  $Category
 * @return \Illuminate\Http\Response
 */

    public function destroy($id=null) {
        Category::where('id',$id)->delete();
        return redirect()->route('categories.index')
                        ->with('success','Category deleted successfully');
    }

}
