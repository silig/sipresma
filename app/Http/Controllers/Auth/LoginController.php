<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use DB;
use CekLengkap;

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
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        
        //dd($request->all());
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|string'
        ]);
        
        if (auth()->attempt(['username' => $request->username, 'password' => $request->password, 'status' => 1])) {
            session_start();
            return redirect()->intended('home');
        }
        return redirect(route('login'))->with(['error' => 'Password Invalid / Inactive Users']);
    }
}
