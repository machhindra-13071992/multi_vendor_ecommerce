<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

use DB;
use App\Quantity;
use Input;

class QuantityController extends Controller
{

/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */

    public function index() {
        $quantities = Quantity::paginate(20);
        return view('quantities.index', compact('quantities'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
   
/**
 * Show the form for creating a new resource.
 *
 * @return \Illuminate\Http\Response
 */
    public function create() {
        return view('quantities.create');
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
		$QuantityData = Quantity::create($request->all());
		return redirect()->route('quantities.index')->with('success', 'Quantity created successfully.');
    }
   
/**
 * Display the specified resource.
 *
 * @param  \App\Quantity  $Quantity
 * @return \Illuminate\Http\Response
 */
    public function show(Quantity $Quantity) {
		$isUpdateStatusFlag = false;
		if(Input::has('update_status_flag')){
				$isUpdateStatusFlag = true;
		}
        $quantities = Quantity::where('id', $Quantity->id)->first();
        return view('quantities.show', compact('quantities','isUpdateStatusFlag'));
    }
   
/**
 * Show the form for editing the specified resource.
 *
 * @param  \App\Quantity  $Quantity
 * @return \Illuminate\Http\Response
 */
    public function edit($id) {
        $quantities = Quantity::where('id', $id)->first();
        return view('quantities.edit',compact('quantities'));
    }
  
/**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  \App\Quantity  $Quantity
 * @return \Illuminate\Http\Response
 */
    public function update(Request $request, Quantity $Quantity) {
		$Quantity->update($request->all());
        return redirect()->route('quantities.index')->with('success', 'Quantity updated successfully');
    }
	
	public function saveUpdateImageFile($request,$Quantity_id=null){
		$attachmentFilePath = null;
		if($request->hasFile('image_file')){           
			$filenameWithExt = $request->file('image_file')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);            
            $extension = $request->file('image_file')->getClientOriginalExtension();
            $attachmentFilePath = $filename.'_'.time().'.'.$extension;                       
            $path = $request->file('image_file')->storeAs('Quantity_image_files',$attachmentFilePath);
        }else{
			$cDetails = Quantity::where('id',$Quantity_id)->first();
			$attachmentFilePath = $cDetails['image_file'];
		}
		DB::table('quantities')->where('id',$Quantity_id)->update(['image_file' =>$attachmentFilePath]);
	}
  
/**
 * Remove the specified resource from storage.
 *
 * @param  \App\Quantity  $Quantity
 * @return \Illuminate\Http\Response
 */

    public function destroy($id=null) {
        Quantity::where('id',$id)->delete();
        return redirect()->route('quantities.index')
                        ->with('success','Quantity deleted successfully');
    }

}
