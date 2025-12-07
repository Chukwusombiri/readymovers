<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function login(){        
        return view('admin_auth.login');
    }

    public function authenticate(Request $request){        
        $credentials = $request->validate([
            'email' => 'required|email',
            'password'=>'required',
        ]);
        $admin = Admin::where('email', $credentials['email'])->first();

        if (!$admin) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }
    
        if ($admin->isSuspended) {
            return back()->withErrors([
                'isSuspended' => 'Your account is suspended till further notice.',
            ])->onlyInput('email');
        }
        
        $remember = $request->has('remember');

        if(Auth::guard('admin')->attempt($credentials,$remember)){
            $request->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::ADMIN_HOME);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',            
        ])->onlyInput('email');
    }

    public function logout(Request $request){
        if(!Auth::guard('admin')->check()){
            return redirect()->back();
        }
        
        Auth::guard('admin')->logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    public function forgotPassword(){        
        return view('admin_auth.forgot_password');
    }

    public function sendResetPassword(Request $request){        
        $request->validate(['email' => 'required|email']);
 
        $status = Password::broker('admins')->sendResetLink(
            $request->only('email')
        );
     
        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }

    public function resetPassword(Request $request, $token){
        if($request->query('email')){
            $email = $request->query('email');
        }       
        return view('admin_auth.reset_password')->with([
            'token'=>$token,
            'email' => $email ?? '',
        ]);
    }

    public function resetComplete(Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
     
        $status = Password::broker('admins')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (Admin $admin, string $password) {
                $admin->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
     
                $admin->save();
     
                event(new PasswordReset($admin));
            }
        );
     
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('admin.login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }
}
