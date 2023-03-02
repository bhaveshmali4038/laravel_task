<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }  

    public function postLogin(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $emailCount = User::where('email', $request->email)->count();
        if ($emailCount == 0) {
            return redirect('login')->withErrors('No such email found');               
        }   

        $remember_me = $request->has('remember') ? true : false;
        if (Auth::attempt(['email' => $request->email, 'password' =>$request->password],$remember_me))
        {
                $user = auth()->user();
                Auth::login($user,true);    
                            
            return redirect()->intended('dashboard')
                            ->withSuccess('You have Successfully loggedin');
        }else{  
            return redirect('login')
                ->withErrors('Please enter valid password');
        }


    }

    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard');
        }
  
        return redirect("login")->withSuccess('Opps! You do not have access');
    }

    public function logout() {
        Session::flush();
        Auth::logout();  
        return Redirect('login')->withSuccess('Logout Successfully');
    }
}
