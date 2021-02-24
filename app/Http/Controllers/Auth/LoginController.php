<?php 

namespace App\Http\Controllers\Auth;
   
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use Socialite;
use Auth;
use Exception;
use App\User;
use DB;
   
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
   
    use AuthenticatesUsers;
   
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
   
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }
   
    public function redirectToGoogle() {
        return Socialite::driver('google')->redirect();
    }
   
    public function handleGoogleCallback() {
        try {
            $user = Socialite::driver('google')->user();

            $finduser = User::where('google_id', $user->id)->first();
            $userEmail = User::where('email', $user->email)->first();
            
            if($finduser){
                Auth::login($finduser);
                return redirect('/home');
            }elseif($userEmail){
                DB::table('users')->where("users.email",'=',$user->email)->update(['users.image_file'=> $user->user['picture'], 'users.google_id'=>$user->id]);
                Auth::login($userEmail);
                return redirect('/home');
            }else{
                $newUser = DB::table('users')->insert([
                    'role_id' => 1,
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                ]);
                
                $finduser = User::where('google_id', $user->id)->first();
                DB::table('users')->where("users.google_id",'=',$user->id)->update(['users.image_file'=> $user->user['picture']]);
                
                DB::table('users_roles')->insert([
                    'user_id' => $finduser->id,
                    'role_id' => '2'
                ]);

                Auth::login($finduser);
                //dd($finduser);
                return redirect('/home');
                //return redirect()->back();
            }

        } catch (Exception $e) {
            return redirect('auth/google');
        }
    }

    //public function logout(Request $request) {
    public function logout(Request $request) {
        Auth::logout();
        return redirect('/admin_login');
    }
}
