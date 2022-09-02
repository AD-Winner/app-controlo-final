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
}
