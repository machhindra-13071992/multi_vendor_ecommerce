<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

use DB;
use App\Country;
use App\OrderItem;
use App\User;
use App\Order;
use Input;
use Auth;
use Session;

class OrderItemController extends Controller
{

/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */

    public function index() {
        $order_items = OrderItem::with('users')->paginate(20);
        return view('order_items.index', compact('order_items'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
   
/**
 * Show the form for creating a new resource.
 *
 * @return \Illuminate\Http\Response
 */
    public function create() {
		$quantities  = DB::table('quantities')->orderBy('name')->pluck('name', 'id')->toArray();
		$categories  = DB::table('categories')->orderBy('name')->pluck('name', 'id')->toArray();
		$product_code = $this->getMaxInvoiceNumber();
        return view('order_items.create',compact('product_code','categories','quantities'));
    }
	
	public function getMaxInvoiceNumber(){
		$invoice_number = 100;
		$result = DB::table("order_items as i")->select([DB::raw('MAX(i.product_code) AS max_invoice_number')])->first();
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
        $ProductData = OrderItem::create($request->all());
		$this->saveUpdateImageFile($request,$ProductData->id);
        return redirect()->route('order_items.index')->with('success', 'OrderItem data entry created successfully.');
    }
   
/**
 * Display the specified resource.
 *
 * @param  \App\OrderItem  $OrderItem
 * @return \Illuminate\Http\Response
 */
    public function show(OrderItem $OrderItem) {
		$isUpdateStatusFlag = false;
		if(Input::has('update_status_flag')){
				$isUpdateStatusFlag = true;
		}
        $order_items = OrderItem::with('countries','payment_terms','Product_remark_details')->where('id', $OrderItem->id)->first();
        return view('order_items.show', compact('order_items','isUpdateStatusFlag'));
    }
   
/**
 * Show the form for editing the specified resource.
 *
 * @param  \App\OrderItem  $OrderItem
 * @return \Illuminate\Http\Response
 */
    public function edit($id) {
		$categories  = DB::table('categories')->orderBy('name')->pluck('name', 'id')->toArray();
		$quantities  = DB::table('quantities')->orderBy('name')->pluck('name', 'id')->toArray();
        $order_items = OrderItem::where('id', $id)->first();
        return view('order_items.edit',compact('order_items','categories','quantities'));
    }
  
/**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  \App\OrderItem  $OrderItem
 * @return \Illuminate\Http\Response
 */
    public function update(Request $request, OrderItem $OrderItem) {
		$request->validate([
            'product_code' => 'required'
        ]);
        $OrderItem->update($request->all());
		$this->saveUpdateImageFile($request,$OrderItem->id);
        return redirect()->route('order_items.index')->with('success', 'OrderItem data entry updated successfully');
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
			$cDetails = OrderItem::where('id',$product_id)->first();
			$attachmentFilePath = $cDetails['image_file'];
		}
		DB::table('order_items')->where('id',$product_id)->update(['image_file' =>$attachmentFilePath]);
	}
  
/**
 * Remove the specified resource from storage.
 *
 * @param  \App\OrderItem  $OrderItem
 * @return \Illuminate\Http\Response
 */

    public function destroy($id=null) {
        OrderItem::where('id',$id)->delete();
        return redirect()->route('order_items.index')
                        ->with('success','OrderItem deleted successfully');
    }

}
