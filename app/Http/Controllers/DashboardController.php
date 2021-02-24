<?php
namespace App\Http\Controllers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Monolog\Logger;
use Auth;
use DB;
use App\Product;
use App\Category;
use App\User;
use Log;
use Input;
use Redirect,Response;

class DashboardController extends Controller{	
	
	//public function index($name, $age){
	public function index(){
		return view('pages.home');
	}
	
	public function home(Request $request){
		$users = DB::table('users')->get();
		$orders = DB::table('orders')->get();
		$products = DB::table('products')->get();
		if(Auth::check()){
			return view('pages.admin_home',compact('users','orders','products'));
		}else{
			 return redirect('/');
		}
	}
	
	public static function all_product_categories($category_id=null){
		$catgData = Category::where('active',true)->orderBy('updated_at','DESC')->get();
		$responseData = array();
		foreach ($catgData as $key => $cData) {
			$catgData[$key]['image_file']= secure_asset('/storage/app/category_image_files/').'/'.$cData['image_file'];
		}
		$responceData['categories'] = $catgData;
		return Response::json($responceData,200,['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
	}
	
	public static function all_products_by_categories($category_id=null){
		$responceData = array();
		if (Input::get('category_id')) {
			$category_id = trim(Input::get('category_id'),'"');
		}
		$responceData['error_flag'] = 0;
		$quantities = DB::table('quantities')->orderBy('name')->pluck('name','id')->toArray();;
		$prodData = Product::where('category_id',$category_id)->orderBy('updated_at','DESC')->get();
		foreach ($prodData as $key => $cData) {
			$prodData[$key]['image_file']= secure_asset('/storage/app/product_image_files/').'/'.$cData['image_file'];
			$prodData[$key]['quantity_name']= isset($quantities[$cData['quantity_id']])?$quantities[$cData['quantity_id']]:"";
		}
		$responceData['product_details'] = $prodData; 
		return Response::json($responceData,200,['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
	}
	
	public static function all_products_by_id($product_id=null){
		if (Input::get('product_id')) {
			$product_id = trim(Input::get('product_id'),'"');
		}
		$prodData = Product::where('id',$product_id)->orderBy('updated_at','DESC')->get();
		$responceData = array();
		$responceData['error_flag'] = 0;
		foreach ($prodData as $key => $cData) {
			$prodData[$key]['image_file']= secure_asset('/storage/app/product_image_files/').'/'.$cData['image_file'];
		}
		$responceData['product_details'] = $prodData;
		return Response::json($responceData,200,['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
	}
	
	public function createUser(Request $request){
		$responceData = array();
		$responceData['error_flag'] = "0";
		if(isset($request->mobile_no)){	
			$finduserRegular = User::where('mobile_no',$request->mobile_no)->first();	
			if(empty($finduserRegular)){
				$dataArr = array(
				'f_name'=>isset($request->f_name) ? trim($request->f_name,'"') : null,
				'l_name'=>isset($request->l_name) ? trim($request->l_name,'"') : null,
				'email'=>isset($request->email) ? trim($request->email,'"') : null,
				'user_name'=>isset($request->f_name) ? trim($request->f_name,'"') : null,
				'role_id'=>isset($request->role_id) ? trim($request->role_id,'"') : 4,
				'mobile_no'=>isset($request->mobile_no) ? trim($request->mobile_no,'"') : null,
				'password'=>isset($request->password) ? trim($request->password,'"') : null,
				'apartment'=>isset($request->apartment) ? trim($request->apartment,'"') : null,
				'address'=>isset($request->address) ? trim($request->address,'"') : null,
				'flat_number'=>isset($request->flat_number) ? trim($request->flat_number,'"') : null,
				'pincode'=>isset($request->pincode) ? trim($request->pincode,'"') : null,
				'landmark'=>isset($request->landmark) ?trim($request->landmark,'"') : null
				);
				DB::table('users')->insert($dataArr);
				$userID = DB::getPdo()->lastInsertId();
				$responceData['error_flag'] = "0";
				$responceData['error_message'] = "Registration successfully.";
			}else{
				$responceData['error_flag'] = "1";
				$responceData['error_message'] = "Account already exists for this mobile number.";
			}
		}
		return Response::json($responceData,200,['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
	}
	
	public function loginUser(Request $request){
		$responceData = array();
		$responceData['error_flag'] = "1";
		$responceData['error_message'] = "Please post required fields.";
		if(isset($request->mobile_no) && isset($request->password)){
			$mobile_no = isset($request->mobile_no)? trim($request->mobile_no,'"') : "";	
			$password = isset($request->password)? trim($request->password,'"') : "";	
			$finduserRegular = User::where(['mobile_no'=>$mobile_no,'password'=>$password])->first();	
			if(!empty($finduserRegular)){
				$responceData['error_flag'] = "0";
				$responceData['error_message'] = "Login successfully.";
				$responceData['user_id'] = $finduserRegular['id'];
				$responceData['name'] = $finduserRegular['f_name'];
				$responceData['f_name'] = $finduserRegular['f_name'];
				$responceData['l_name'] = $finduserRegular['l_name'];
				$responceData['mobile_no'] = $finduserRegular['mobile_no'];
				$responceData['address'] = $finduserRegular['address'];
				$responceData['landmark'] = $finduserRegular['landmark'];
				$responceData['flat_number'] = $finduserRegular['flat_number'];
				$responceData['apartment'] = $finduserRegular['apartment'];
				$responceData['pincode'] = $finduserRegular['pincode'];
			}else{
				$responceData['error_flag'] = "1";
				$responceData['error_message'] = "Invalid Credentials.";
			}
		}
		return Response::json($responceData,200,['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
	}
	
	public function updateUserAddress(Request $request){
		$responceData = array();
		$responceData['error_flag'] = "1";
		$responceData['error_message'] = "Address not updated.";
		if(isset($request->address) && isset($request->user_id)){	
			$finduserRegular = User::where('id','=',$request->user_id)->update(['f_name'=>isset($request->f_name)?$request->f_name:"",'l_name'=>isset($request->l_name)?$request->l_name:"",'mobile_no'=>isset($request->mobile_no)?$request->mobile_no:"",'landmark'=>isset($request->landmark)?$request->landmark:"",'flat_number'=>isset($request->flat_number)?$request->flat_number:"",'apartment'=>isset($request->apartment)?$request->apartment:"",'pincode'=>$request->pincode,'address'=>isset($request->address)?$request->address:""]);	
			$responceData['error_flag'] = "0";
			$responceData['error_message'] = "Address updated successfully.";
		}
		return Response::json($responceData,200,['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
	}
	
	public function updateOrderItems(Request $request){	
		$responceData = array();
		$responceData['error_flag'] = "1";
		$responceData['error_message'] = "orders items empty.";
		if(isset($request->user_id) && isset($request->orderitems)){
			$orderArr = array(
					'user_id'=>$request->user_id,
					'is_payment_online'=>isset($request->is_payment_online)?$request->is_payment_online:0,
					'is_payment_done'=>isset($request->is_payment_done)?$request->is_payment_done:0,
					'status'=>1,
					'created_at'=>date('Y-m-d H:i:s'),
					'updated_at'=>date('Y-m-d H:i:s'),
					'created_by'=>$request->user_id,
					'updated_by'=>$request->user_id
				);
				DB::table('orders')->insert($orderArr);
				$order_id = DB::getPdo()->lastInsertId();
				
			foreach($request->orderitems as $itemData){
				$dataArr = array(
				'user_id'=>$request->user_id,
				'order_id'=>$order_id,
				'itemImage'=>isset($itemData['itemImage']) ? $itemData['itemImage'] : null,
				'itemname'=>isset($itemData['itemname']) ? $itemData['itemname'] : null,
				'itemprice'=>isset($itemData['itemprice']) ? $itemData['itemprice'] : 0,
				'itemquantity'=>isset($itemData['itemquantity']) ? $itemData['itemquantity'] : 0,
				'itemtotal'=>isset($itemData['itemtotal']) ? $itemData['itemtotal'] : 0,
				'status'=>isset($itemData['status']) ? $itemData['status'] : 1,
				'created_at'=>date('Y-m-d H:i:s'),
				'updated_at'=>date('Y-m-d H:i:s'),
				'created_by'=>$request->user_id,
				'updated_by'=>$request->user_id
				);
				DB::table('order_items')->insert($dataArr);
				$userID = DB::getPdo()->lastInsertId();
			}
			$responceData['error_flag'] = "0";
			$responceData['error_message'] = "orders created successfully.";
		}
		return Response::json($responceData,200,['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
	}
	
	public function wallet_amounts($user_id=null){
		$responceData = array();
		if (Input::get('user_id')) {
			$user_id = trim(Input::get('user_id'),'"');
		}
		$responceData['error_flag'] = 0;
		$prodData = User::where('id',$user_id)->orderBy('id','DESC')->first();
		$responceData['wallet_amount'] = $prodData['wallet_amount']*1; 
		return Response::json($responceData,200,['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
	}
	
}