<?php 
namespace App\Http\Controllers\website; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use Session;
use App\Models\User;

class LoginController extends Controller
{
        public function login(){	
                if(Session::has('CS_ADMIN')){
                        return redirect()->route('website.dashboard.index');    
                }
                $title='Login';
                return view('website.layouts.login');
        }
        public function loginprocess(Request $request){
		if($request->isMethod('post')){
                        $request->validate([
                                'admin_email' => 'required',
                                'admin_password' => 'required',
                        ]);
                        $adminData=User::where('email',$request->admin_email)->first();
			if($adminData){
				
				if (Hash::check($request->admin_password, $adminData->password_hash)) {
					Session::put('CS_ADMIN', $adminData);
					Session::save();
					return redirect()->route('website.dashboard.index')->with(['success'=>'Login successfull']);
                                }else{
                                        return redirect()->back()->with(['error'=>'Wrong Email or Password. Please try again']);
                                }
                        }else{
                                return redirect()->back()->with(['error'=>'Wrong Email or Password. Please try again']);
                        }
                } else{
                        return redirect()->back()->with('error', 'Invalid Method');
                }
         
                }
        public function logout(Request $request){	
		Session::forget('CS_ADMIN');
		return redirect()->route('login')->withErrors("Logged out.");
	}
}
