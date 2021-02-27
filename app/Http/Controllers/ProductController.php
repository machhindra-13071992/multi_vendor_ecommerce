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
use App\Country;
use App\Product;
use App\User;
use Input;
use Auth;
use Session;

class ProductController extends Controller
{

/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */

    public function index() {
        $products = Product::with('users')->paginate(20);
        return view('products.index', compact('products'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
   
/**
 * Show the form for creating a new resource.
 *
 * @return \Illuminate\Http\Response
 */
    public function create() {
        $uuid = Str::uuid();
		$quantities  = DB::table('quantities')->orderBy('name')->pluck('name', 'id')->toArray();
		$categories  = DB::table('categories')->orderBy('name')->pluck('name', 'id')->toArray();
        $sub_categories  = DB::table('sub_categories')->orderBy('name')->pluck('name', 'id')->toArray();
		$product_code = $this->getMaxInvoiceNumber();
        return view('products.create',compact('product_code','categories','quantities','sub_categories','uuid'));
    }
	
	public function getMaxInvoiceNumber(){
		$invoice_number = 100;
		$result = DB::table("products as i")->select([DB::raw('MAX(i.product_code) AS max_invoice_number')])->first();
		if(isset($result->max_invoice_number)){
			$invoice_number = $result->max_invoice_number*1;
		}
		return $invoice_number+1;
	}

/**
 * Store a newly created resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
    public function store(Request $request) {
        $request->validate([
            'product_code' => 'required'
        ]);
        $ProductData = Product::create($request->all());
		$this->saveUpdateImageFile($request,$ProductData->id);
        return redirect()->route('products.index')->with('success', 'Product data entry created successfully.');
    }
   
/**
 * Display the specified resource.
 *
 * @param  \App\Product  $Product
 * @return \Illuminate\Http\Response
 */
    public function show(Product $Product) {
		$isUpdateStatusFlag = false;
		if(Input::has('update_status_flag')){
				$isUpdateStatusFlag = true;
		}
        $Products = Product::with('countries','payment_terms','Product_remark_details')->where('id', $Product->id)->first();
        return view('products.show', compact('Products','isUpdateStatusFlag'));
    }
   
/**
 * Show the form for editing the specified resource.
 *
 * @param  \App\Product  $Product
 * @return \Illuminate\Http\Response
 */
    public function edit($id) {
		$categories  = DB::table('categories')->orderBy('name')->pluck('name', 'id')->toArray();
		$quantities  = DB::table('quantities')->orderBy('name')->pluck('name', 'id')->toArray();
        $sub_categories  = DB::table('sub_categories')->orderBy('name')->pluck('name', 'id')->toArray();
        $products = Product::where('id', $id)->first();
        return view('products.edit',compact('products','categories','quantities','sub_categories'));
    }
  
/**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  \App\Product  $Product
 * @return \Illuminate\Http\Response
 */
    public function update(Request $request, Product $Product) {
		$request->validate([
            'product_code' => 'required'
        ]);
        $Product->update($request->all());
		$this->saveUpdateImageFile($request,$Product->id);
        return redirect()->route('products.index')->with('success', 'Product data entry updated successfully');
    }
	
	public function saveUpdateImageFile($request,$product_id=null){
		$attachmentFilePath = null;
		if($request->hasFile('image_file')){           
			$filenameWithExt = $request->file('image_file')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);            
            $extension = $request->file('image_file')->getClientOriginalExtension();
            $attachmentFilePath = $filename.'_'.time().'.'.$extension;                       
            $path = $request->file('image_file')->storeAs('product_image_files',$attachmentFilePath);
        }else{
			$cDetails = Product::where('id',$product_id)->first();
			$attachmentFilePath = $cDetails['image_file'];
		}
		DB::table('products')->where('id',$product_id)->update(['image_file' =>$attachmentFilePath]);
	}
  
/**
 * Remove the specified resource from storage.
 *
 * @param  \App\Product  $Product
 * @return \Illuminate\Http\Response
 */

    public function destroy($id=null) {
        Product::where('id',$id)->delete();
        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }

}
