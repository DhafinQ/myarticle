<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function checkLog(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required'
            ]
        );

        $credentials = $request->only('email','password');

        if(Auth::attempt($credentials)){
            return redirect('/');
        }

        return redirect()->back()->withErrors(['no_record' => "Email or Password Doesn't Match!"]);

    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/login');
    }

    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function sendMail(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users,email'
        ]);
        
        $token = Str::random(64);
  
          DB::table('password_reset_tokens')->insert([
              'email' => $request->email, 
              'token' => $token, 
              'created_at' => Carbon::now()
            ]);
  
          Mail::send('email.forgetPassword', ['token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Reset Password');
          });
  
          return back()->with('success', 'We have e-mailed your password reset link!');
    }

    public function showForm($token) { 
        return view('auth.forgetPasswordLink', ['token' => $token]);
    }

    public function confirmChange(Request $request)
      {
          $request->validate([
              'email' => 'required|email|exists:users,email',
              'password' => 'required|string|min:6|confirmed',
          ]);
  
          $updatePassword = DB::table('password_reset_tokens')
                              ->where([
                                'email' => $request->email, 
                                'token' => $request->token
                              ])
                              ->first();
                                
          if(!$updatePassword){
              return back()->withInput()->with('error', 'Invalid Email Address!');
          }
  
          $user = User::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);
   
          return redirect()->route('forgot-password.success',$request->token);
      }

    public function forgotPasswordSuccess(String $token)
    {
        DB::table('password_reset_tokens')->where(['token'=> $token])->delete();

        return view('auth.fg-success');
    }
}
