<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Request;

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

    use AuthenticatesUsers {
        logout as protected originalLogout;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }

    public function redirectTo()
    {
        if (auth()->user()->roles()->first()->allowed_route != '') {
            return $this->redirectTo = auth()->user()->roles()->first()->allowed_route . '/index';
        }
    }
    // public function logout(Request $request)
    // {
    //     $cart = collect($request->session()->get('cart'));

    //     /* Call original logout method */
    //     $response = $this->originalLogout($request);

    //     /* Repopulate Sesssion with Cart */
    //     if (!config('cart.destroy_on_logout')) {
    //         $cart->each(function ($rows, $identifier) use ($request){
    //             $request->session()->put('cart.'. $identifier, $rows);
    //         });
    //     }

    //     /* Return original response */
    //     return $response;

    // }
    protected function loggedOut()
    {
        Cache::forget('admin_side_menu');
        Cache::forget('role_routes');
        Cache::forget('user_routes');
    }
    

}
