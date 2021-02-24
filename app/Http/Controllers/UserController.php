<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use DB;
use Hash;
use App\User;
use App\Role;
use App\Country;
use App\Language;
use App\UserMoneyTransaction;
use Redirect,Response;
use Input;
use Carbon\Carbon;
use Auth;
use Helper;

class UserController extends Controller{

	//public function index($name, $age){
	public function login(){
		//echo "The name is ".$name." & age is ".$age;
		return view('login_page'); 
	}

 	public function index(Request $request)
    {
		$queryData = [];
		if (Input::get('role_id')) {
			$queryData[] = ['role_id',Input::get('role_id')];
		}
        $data = User::with('roles','user_money_transactions')->where($queryData)->orderBy('id', 'asc')->paginate(20);
        return view('users.index',compact('data'))->with('i',($request->input('page', 1) - 1) * 5);
    }
	/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $roles = Role::orderBy('id')->pluck('name', 'id')->toArray();
        return view('users.add',compact('roles'));
    }


     public function create()
    {
        $roles = Role::orderBy('id')->pluck('name', 'id')->toArray();
        return view('users.create', compact('roles'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email|unique:users,email',
			'confirm_password'=>'required|same:password',
        ]);
        $input = $request->all();
        $user = User::create($input);
        return redirect()->route('users.index')->with('success','User created successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
		$isUpdateStatusFlag = false;
		if(Input::has('update_status_flag')){
				$isUpdateStatusFlag = true;
		}
        $user = User::with('roles','user_remark_details','users_countries_of_employments','users_languages_to_speaks')
                    ->where('id', $user->id)->first();
					$userMasters = User::orderBy('user_name')->pluck('user_name', 'id');
        return view('users.show', compact('user','userMasters','isUpdateStatusFlag'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$userMasters = User::orderBy('user_name')->pluck('user_name', 'id');
        $users = User::with('roles')->where('id', $id)->first();
        $roles = Role::orderBy('id')->pluck('name', 'id')->toArray();
        $countries = Country::where('active', true)->orderBy('id')->pluck('name', 'id')->toArray();
        return view('users.edit', compact('users', 'roles', 'countries'));

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $User)
    {
        $this->validate($request, [
            'email' => 'required|email',
			'confirm_password'=>'same:password'
        ]);
        $User->update($request->all());
        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }
	
	public function saveUpdateUserPermissionDetails($request){
			$request->request->add(['create_new_user' => $request->request->get('create_new_user') == true ? 1 : 0]);
			$request->request->add(['edit_existing_user' => $request->request->get('edit_existing_user') == true ? 1 : 0]);
			$request->request->add(['change_status_of_user' => $request->request->get('change_status_of_user') == true ? true : 0]);
			$request->request->add(['customer_data_entry' => $request->request->get('customer_data_entry') == true ? true : 0]);
			$request->request->add(['add_customer' => $request->request->get('add_customer') == true ? true : 0]);
			$request->request->add(['edit_customer' => $request->request->get('edit_customer') == true ? true : 0]);
			$request->request->add(['view_customer' => $request->request->get('view_customer') == true ? true : 0]);
			$request->request->add(['change_status_of_customer' => $request->request->get('change_status_of_customer') == true ? true : 0]);
			
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
			
			$dataArr = array(
				'user_id' => $request->id,
				'create_new_user' => $request->create_new_user,
				'edit_existing_user' => $request->edit_existing_user,
				'change_status_of_user' => $request->change_status_of_user,
				'customer_data_entry' => $request->customer_data_entry,
				'add_customer' => $request->add_customer,
				'edit_customer' => $request->edit_customer,
				'view_customer' => $request->view_customer,
				'change_status_of_customer' => $request->change_status_of_customer,
				'stock_data_entry_screen' => $request->stock_data_entry_screen,
				'stock_edit_change_status' => $request->stock_edit_change_status,
				'mode_of_shipment' => $request->mode_of_shipment,
				'shipment_schedule' => $request->shipment_schedule,
				'delivery' => $request->delivery,
				'access_to_bank' => $request->access_to_bank,
				'payment_terms' => $request->payment_terms,
				'port_of_destination' => $request->port_of_destination,
				'access_to_company' => $request->access_to_company,
				'performa_invoice' => $request->performa_invoice,
				'shipment_tracking' => $request->shipment_tracking,
				'created_at'=>date('Y-m-d H:i:s'),
				'updated_at'=>date('Y-m-d H:i:s')
			);
			
	}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')->with('success','User deleted successfully');
    }


    public function delete_sweet_alert(Request $request) {
        $responseArr = array();
        $responseArr['model_name'] = "";
        try { 
            if($request->deleteType == "update"){
                DB::table($request->modelName)->where('id',$request->id)->update(['status' => false]);
            }

            if($request->deleteType == "delete"){
                DB::table($request->modelName)->where('id',$request->id)->delete();
            }

            $responseArr['error'] = 0;
            $responseArr['model_name'] = str_replace('_',' ',$request->modelName);
            } catch (\Illuminate\Database\QueryException $e) {
                $responseArr['error'] = 1;
                
            }
        return Response::json($responseArr);
    }

    public function update_model_status(Request $request) {
        $responseArr = array();
        $responseArr['model_name'] = "";
        try { 
            
            DB::table($request->modelName)->where('id',$request->id)->update(['active' => $request->statusMode]);
            $responseArr['error'] = 0;
            $responseArr['model_name'] = str_replace('_',' ',$request->modelName);
            } catch (\Illuminate\Database\QueryException $e) {
                $responseArr['error'] = 1;
                
            }
        return Response::json($responseArr);
    }

    public function user_login(Request $request) {
         $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:3'
        ]);
        // create our user data for the authentication
        $userdata = array(
            'email' => Input::get('email'),
            'password' => Input::get('password')
        );

        //First time login user
        $finduserRegular = User::where('email', $userdata['email'])
            ->first();
        
        if(!empty($finduserRegular)){
            Auth::login($finduserRegular);
            return Redirect::to('/admin_home');
        }else{
            return Redirect::to('/login?error=1');
        }
        
    }
    
    public function admin_login_backend(Request $request) {
         $request->validate([
            'password' => 'required|min:3'
        ]);
        // create our user data for the authentication
        $userdata = array(
            'name' => Input::get('name'),
            'password' => Input::get('password')
        );

        //First time login user
        $finduserRegular = User::where('user_name', $userdata['name'])
            ->first();
        
        if(!empty($finduserRegular)){
            Auth::login($finduserRegular);
			if(Input::get('is_sales_login')){
				return Redirect::to('sales_worker_informations?add=1&user_id='.$finduserRegular['id']);
			}
            return Redirect::to('admin_home');
        }else{
            return Redirect::to('admin_login?error=1');
        }
        
    }
	
	
	public function farmer_login_backend(Request $request) {
        $userdata = array(
            'mobile' => Input::get('mobile'),
            'otp' => Input::get('otp')
        );
        $finduserRegular = User::where('mobile_no',$userdata['mobile'])
            ->first();
        if(!empty($finduserRegular) && !Input::get('otp')){
			$this->send_otp($userdata['mobile']);
           return Redirect::to('farmers_login?otp_send=1&mobile='.$userdata['mobile']);
        }else if(Input::get('otp')){
			$findByOtp = User::where(['mobile_no'=>$userdata['mobile'],'otp'=>$userdata['otp']])
            ->first();
			if(!empty($findByOtp)){
				Auth::login($findByOtp);
				return Redirect::to('farmer_worker_informations?add=1&user_id='.$findByOtp['id']);
			}else{
				return Redirect::to('farmers_login?mobile='.$userdata['mobile'].'&error=1');
			}
        }else{
			$dataArr = array('role_id'=>'4','otp'=>'12345','password'=>$userdata['mobile'],'password_string'=>$userdata['mobile'],'mobile_no'=>$userdata['mobile']);
            DB::table('users')->insert($dataArr);
            $userID = DB::getPdo()->lastInsertId();
			return Redirect::to('farmers_login?mobile='.$userdata['mobile']);
		}
    }
	
	
	public function farmer_registration_backend(Request $request) {
        $dataArr = array('role_id'=>'4','otp'=>'12345','user_name'=>Input::get('user_name'),'password'=>Input::get('mobile'),'password_string'=>Input::get('mobile'),'mobile_no'=>Input::get('mobile'),'email'=>Input::get('email'));
        $finduserRegular = User::where('mobile_no',$dataArr['mobile_no'])
            ->first();
        if(!empty($finduserRegular)){
           return Redirect::to('farmers_login?error=3');
        }else{
            DB::table('users')->insert($dataArr);
            $userID = DB::getPdo()->lastInsertId();
			$fdataArr = array('farmer_user_id'=>$userID,'mobile'=>$dataArr['mobile_no'],'farmer_name'=>$dataArr['user_name'],'address'=>Input::get('address'),'village_name'=>Input::get('village_name'));
			DB::table('farmer_information')->insert($fdataArr);
			return Redirect::to('farmers_login?error=2');
		}
    }
	
	public function user_money_transactions ($user_id){
		$users = User::with('roles','user_money_transactions')->where('id',$user_id)->first();
		$user_money_transactions = UserMoneyTransaction::where('user_id',$user_id)->orderBy('created_at','desc')->paginate(20);
        return view('users.user_money_transactions', compact('users','user_id','user_money_transactions'));
	}
	
	public function post_money_transactions(Request $request){
		$dataArr = array('is_deposite'=>$request->is_deposite,'amount'=>$request->amount,'user_id'=>$request->user_id,'created_at'=>$request->created_at,'updated_at'=>$request->updated_at);
		DB::table('user_money_transactions')->insert($dataArr);
		$user_money_transactions = UserMoneyTransaction::where('user_id',$request->user_id)->orderBy('created_at','desc')->get();
		$total_amount=0;
		foreach($user_money_transactions as $wallet_info){
			if($wallet_info['is_deposite'] == '1'){ $total_amount += $wallet_info['amount']; } 
			if($wallet_info['is_deposite'] == '0'){ $total_amount -= $wallet_info['amount']; }
		}
		DB::table('users')->where('id',$request->user_id)->update(array('wallet_amount'=>$total_amount));
		return redirect()->to('users')->with('success','Money has been added successfully!');
	}
    
    public function user_registration(Request $request) {
         $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:3'
        ]);
        // create our user data for the authentication
        $userdata = array(
            'email' => Input::get('email'),
            'password' => Input::get('password'),
            'mobile_no' => Input::get('mobile_no')
        );
        
        //First time login user
        $finduserRegular = User::where('email', $userdata['email'])
            ->first();
        
        if(empty($finduserRegular)){
            $dataArr = array('name'=>$userdata['email'],'email'=>$userdata['email'],'password'=>$userdata['password'],'password_string'=>$userdata['password'],'mobile_no'=>$userdata['mobile_no']);
            DB::table('users')->insert($dataArr);
            $userID = DB::getPdo()->lastInsertId();
            return Redirect::to('/register?success=1');
        }else{
            return Redirect::to('/register?error=1');
        }
    }
	
	
	public function send_otp($mobileNumber=0) {
        $responseArr = array();
        try {
			$responseArr['error'] = 0;
			$otp = rand(100000, 999999);
			$message = urlencode("Your One Time Password is ".$otp);
			$url = 'https://www.logonutility.in/app/smsapi/index.php?key=45D1F165E72B10&campaign=1&routeid=20&type=text&contacts='.$mobileNumber.'&senderid=MANOVI&msg=Hello+%2Cyour+one+time+password+is+'.$otp.'+'; 
			DB::table('users')->where('mobile_no',$mobileNumber)->update(['otp'=>$otp]);
			$ch = curl_init();
			curl_setopt($ch,CURLOPT_URL,$url);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
			$output=curl_exec($ch);
			$ipdat = @json_decode($output);
			curl_close($ch);
        } catch (\Illuminate\Database\QueryException $e) {
                $responseArr['error'] = 1;
            }
        return Response::json($responseArr);
    }
	
}
