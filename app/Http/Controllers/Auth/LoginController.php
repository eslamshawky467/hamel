<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Trait\AuthTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthTrait;

    public function log($type){
        if($type !="admin" && $type!="client") {
            return view('errors.404');
        }
        else {
            return view('auth.login', compact('type'));
        }
    }
    public function logs($type='admin'){
        return view('auth.login',compact('type'));
            }
    public function login(Request $request){
                if (Auth::guard($this->chekGuard($request))->attempt(['email' => $request->email, 'password' => $request->password])) {
                    return $this->redirect($request);
                }
                else{
                    return redirect()->back()->with('message', 'E-mail Or Password is Wrong');
                }

            }

            public function logout(Request $request,$type)
            {
                Auth::guard($type)->logout();

                $request->session()->invalidate();

                $request->session()->regenerateToken();

                return redirect('/');
            }
}
