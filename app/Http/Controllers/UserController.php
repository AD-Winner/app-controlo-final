<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Regiao;
use App\Models\Sector;
use App\Models\Circulo;
use App\Models\Provincia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function index(){
        $users = User::all();
        $tot = User::count();
        $provincias = Provincia::all();
        $regioes = Regiao::all();
        $circulos = Circulo::all();
        $sectores = Sector::all();
        return view('user.index', compact('users','tot', 'provincias','regioes','circulos','sectores'));
    }


    public function store(Request $request){
            $request->validate([
                'name'=>'required|unique:users|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:4|confirmed',
            ]);
            $user = new User();
            $user->name=$request->name;
            $user->email=$request->email;
            $user->password= Hash::make($request->password);
            $user->save();

            return redirect(route('user.index'))->with('success', '[OK] Utilizador registado com sucesso.');

    }

    public function check(User $user){
        try {
            //code...
           // $user = User::find($id);
            if($user){
                if($user->is_active==false){ // Se l'utilisateur est desactivé
                    $user->is_active = true; // On l'active
                    $user->update();
                    return redirect(route('user.index'))->with('success', '[OK] Utilizador '. $user->name.' está activo.');
                    // return redirect(route('user-index'))
                }elseif($user->is_active==true){ //Se l'utilisateur est activé
                    $user->is_active = false; //On le desactive
                    $user->update();
                    return redirect(route('user.index'))->with('success', '[OK] Utilizador '. $user->name.' está inactivo.');

                }
            }else{
                return redirect(route('user.index'));
            }
        } catch (\Throwable $th) {
             if(config('app.debug')){
                 return redirect(route('user.index'))->with('error', '[DEBUG] Houve erro, utilizador não activo.');
             }
          return redirect(route('user.index'))->with('error', '[ERRO] Utilizador não activo.');
          }

     }


     public function destroy(User $user){
        try {
            //code...
            if($user->delete()){
                return redirect(route('user.index'))->with('success','[OK] Utilizador eliminado.');
            }
        } catch (\Throwable $th) {
            //throw $th;
            if(config('app.debug')){
                return redirect(route('user.index'))->with('error', '[ERRO] Operação abortada, utilizador não eliminado.');
            }
         return redirect(route('user.index'))->with('error', '[ERRO] Utilizador não eliminado.');
        }
     }

}
