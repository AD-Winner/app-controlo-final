<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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

    protected function authenticated(Request $request, $user){

        if($user->is_active == false){
            return redirect()->route('login')->with('error', 'ATENÇÃO! Conta inactiva, contacte administrador.');
        }
        // if($user->hasRole('coordenador-nacional')){
        //     // return redirect()->route('login')->with('error', 'ATENÇÃO! Conta inactiva, contacte administrador.');
        //     return redirect(route('coordenador.nacional.dashboard'));
        // }

        else{

            return redirect(route('home'));
        }

        // if($user->profil=='Administrateur' || $user->profil=='administrateur' || $user->profil=='admin'){
        //    // return RouteServiceProvider::HOMEADMIN;
        //    return redirect()->route('home-admin');
        // }
        // if($user->profil=='dcse' || $user->profil=='DCSE'){
        //     return redirect()->route('home-user');
        //     //return  RouteServiceProvider::HOMEUSER;
        // }

        // if($user->profil=='pcre' || $user->profil=='PCRE' || $user->profil=='President' || $user->profil=='PRESIDENT' ){
        //     return redirect()->route('home-cre');
        //     //return  RouteServiceProvider::HOMEUSER;
        // }
        // if($user->profil=='cds' || $user->profil=='CDS'){ //|| $user->profil=='c' || $user->profil=='PRESIDENT' ){
        //     return redirect()->route('home-cds');
        //     //return  RouteServiceProvider::HOMEUSER;
        // }else{
        //     return redirect()->route('login');
        // }


}
}
