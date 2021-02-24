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
use App\User;
use App\Order;
use App\OrderItem;
use Input;
use Auth;
use Session;

class OrderController extends Controller
{

/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */

    public function index() {
        $orders = Order::with('users')->paginate(20);
		$order_statuses  = DB::table('order_statuses')->orderBy('id')->pluck('name', 'id')->toArray();
        return view('orders.index', compact('orders','order_statuses'))->with('i', (request()->input('page', 1) - 1) * 5);
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
        return view('orders.create',compact('product_code','categories','quantities'));
    }
	
	public function getMaxInvoiceNumber(){
		$invoice_number = 100;
		$result = DB::table("orders as i")->select([DB::raw('MAX(i.product_code) AS max_invoice_number')])->first();
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
        $ProductData = Order::create($request->all());
		$this->saveUpdateImageFile($request,$ProductData->id);
        return redirect()->route('orders.index')->with('success', 'Order data entry created successfully.');
    }
   
/**
 * Display the specified resource.
 *
 * @param  \App\Order  $Order
 * @return \Illuminate\Http\Response
 */
    public function show(Order $Order) {
        $orders = Order::with('users')->where('id', $Order->id)->first();
		$order_items = OrderItem::with('users')->where('order_id',$Order->id)->get();
        return view('orders.show',compact('orders','order_items'));
    }
   
/**
 * Show the form for editing the specified resource.
 *
 * @param  \App\Order  $Order
 * @return \Illuminate\Http\Response
 */
    public function edit($id) {
		$categories  = DB::table('categories')->orderBy('name')->pluck('name', 'id')->toArray();
		$quantities  = DB::table('quantities')->orderBy('name')->pluck('name', 'id')->toArray();
        $orders = Order::where('id', $id)->first();
        return view('orders.edit',compact('orders','categories','quantities'));
    }
  
/**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  \App\Order  $Order
 * @return \Illuminate\Http\Response
 */
    public function update(Request $request, Order $Order) {
		$request->validate([
            'product_code' => 'required'
        ]);
        $Order->update($request->all());
		$this->saveUpdateImageFile($request,$Order->id);
        return redirect()->route('orders.index')->with('success', 'Order data entry updated successfully');
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
			$cDetails = Order::where('id',$product_id)->first();
			$attachmentFilePath = $cDetails['image_file'];
		}
		DB::table('orders')->where('id',$product_id)->update(['image_file' =>$attachmentFilePath]);
	}
  
/**
 * Remove the specified resource from storage.
 *
 * @param  \App\Order  $Order
 * @return \Illuminate\Http\Response
 */

    public function destroy($id=null) {
        Order::where('id',$id)->delete();
        return redirect()->route('orders.index')
                        ->with('success','Order deleted successfully');
    }
	
	public function update_order_status($order_id=0,$order_status_id=null)
    {
        $responseArr['error'] = "1";
        if($order_status_id){ 
            $responseArr['error'] = "0";
            DB::table('orders')->where('id',$order_id)->update(['order_status_id'=>$order_status_id]);
        }
        return json_encode($responseArr);
    }

}
