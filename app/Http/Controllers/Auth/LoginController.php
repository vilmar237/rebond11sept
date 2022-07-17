<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\PostLoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
    protected function redirectTo()
    {
        if(Auth::user()->role == 'Admin' || Auth::user()->role == 'Super'){
            return '/admin';
        }
        return '/dashboard';
    }

    public function postLogin(PostLoginRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            if(Auth::user()->role == 'Admin' || Auth::user()->role == 'Super'){
                notify()->success('Bienvenue '. auth()->user()->name, 'Connexion');
                return redirect('admin')->with('success', 'Bienvenue ' . auth()->user()->name);
            }else{
                notify()->success('Bienvenue '. auth()->user()->name, 'Connexion');
                return redirect('dashboard')->with('success', 'Bienvenue ' . auth()->user()->name);
            }
        }
        notify()->error('E-mail / mot de passe incorrect', 'Connexion');
        return back()->with('error', 'E-mail ou mot de passe incorrect');
    }


    public function logout()
    {
        $name = auth()->user()->first_name;
        Auth::logout();
        notify()->success('Déconnexion réussie '. $name, 'Déconnexion');
        return redirect('login')->with('success', 'Déconnexion réussie ' . $name);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
