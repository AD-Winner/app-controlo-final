<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Regiao;
use App\Models\Sector;
use App\Models\Circulo;
use App\Models\Provincia;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

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
        $roles = Role::whereNotIn('name', ['dev'])->get();

        return view('user.index', compact('users','roles','tot', 'provincias','regioes','circulos','sectores'));
    }


    public function store(Request $request){
            $request->validate([
                'name'=>'required|unique:users|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:4|confirmed',
                'perfil' => 'required|exists:roles,name',
            ]);

            ##-- Testar se utilizador é administrador ou coordenador de Nacional --#
            if(($request->perfil=="admin") || ($request->perfil=="coordenador-nacional") ){
                $user = new User();
                $user->name=$request->name;
                $user->email=$request->email;
                $user->password= Hash::make($request->password);
                $user->is_active= false;
                $user->save();
                if($user->hasRole($request->perfil)){ // -- Verificar se utilizador não tem perfil -- #
                return redirect(route('user.index'))->with('success', '[OK] Utilizador registado.');
                }
                $user->assignRole($request->perfil); ## -- Registar se utilizador não tem perfil -- #
                return redirect(route('user.index'))->with('success', '[OK] Utilizador registado com sucesso.');

            }elseif($request->perfil=="coordenador-provincia"){ //Testar se utilizador é oordenador de provincia
                $user = new User();
                $user->name=$request->name;
                $user->email=$request->email;
                $user->password= Hash::make($request->password);
                $user->is_active= false;
                $user->provincia_id = $request->provincia_id;
                $user->save();

                if($user->hasRole($request->perfil)){## -- Verificar se utilizador não tem perfil -- #
                return redirect(route('user.index'))->with('success', '[OK] Utilizador registado.');
                }
                $user->assignRole($request->perfil);## -- Registar se utilizador não tem perfil -- #
                return redirect(route('user.index'))->with('success', '[OK] Utilizador registado com sucesso.');

            }elseif($request->perfil=="coordenador-regional"){//Testar se utilizador é Coordenador Regional
                $user = new User();
                $user->name=$request->name;
                $user->email=$request->email;
                $user->password= Hash::make($request->password);
                $user->is_active= false;
                $user->provincia_id = $request->provincia_id;
                $user->regiao_id = $request->regiao_id;
                $user->save();
                if($user->hasRole($request->perfil)){ ## -- Verificar se utilizador não tem perfil -- #
                return redirect(route('user.index'))->with('success', '[OK] Utilizador registado.');
                }
                $user->assignRole($request->perfil);## -- Registar se utilizador não tem perfil -- #
                return redirect(route('user.index'))->with('success', '[OK] Utilizador registado com sucesso.');

            }elseif($request->perfil=="supervisor"){ //Testar se utilizador é Supervisor
                $user = new User();
                $user->name=$request->name;
                $user->email=$request->email;
                $user->password= Hash::make($request->password);
                $user->is_active= false;
                $user->provincia_id = $request->provincia_id;
                $user->circulo_id = $request->circulo_id;
                $user->regiao_id = $request->regiao_id;
                $user->sector_id = $request->sector_id;
                $user->save();
                if($user->hasRole($request->perfil)){## -- Verificar se utilizador não tem perfil -- #
                    return redirect(route('user.index'))->with('success', '[OK] Utilizador registado.');
                }
                $user->assignRole($request->perfil);## -- Registar se utilizador não tem perfil -- #
                return redirect(route('user.index'))->with('success', '[OK] Utilizador registado com sucesso.');
            }


    }

    public function show(User $user){
        // $roles = Role::all();

        $roles = Role::whereNotIn('name',['dev'])->get();
        $permissions = Permission::all();
        return view('user.role', compact('user', 'roles', 'permissions'));
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

        public function assignRole(Request $request, User $user){


                 try {
                    //code...
                    if($user->hasRole($request->role)){
                        return redirect(route('user.show', $user->id))->with('error','[AVISO] Perfil existente.' );
                    }
                    $user->assignRole($request->role);
                    return redirect(route('user.show', $user->id))->with('success','[OK] Autorização concedida.' );
                } catch (\Throwable $th) {
                //throw $th;
                    if(config("app.debug")){
                        return redirect(route('user.show', $user->id))->with('error','[ERRO] Operação falhou.' );

                    }
                    return redirect(route('user.show', $user->id))->with('error','[ERRO] Houve falha, repita !' );
            }
        }

            public function removeRole(User $user, Role $role){

                try {
                    //code...
                    if($user->hasRole($role)){
                        $user->removeRole($role);
                        return redirect(route('user.show', $user->id))->with('success','[OK] Autorização removida.' );
                    }
                } catch (\Throwable $th) {
                    //throw $th;
                    if(config("app.debug")){
                        return redirect(route('user.show', $user->id))->with('error','[ERRO] Operação falhou.' );

                    }
                    return redirect(route('user.show', $user->id))->with('error','[ERRO] Houve falha, tente de novo !' );
                    }

            }

            public function givePermission(Request $request, User $user){

                try {
                 //code...
                 if($user->hasPermissionTo($request->permission)){
                     return redirect(route('user.show', $user->id))->with('error','[AVISO] Perfil tem esta permissão.' );
                 }
                 $user->givePermissionTo($request->permission);
                 return redirect(route('user.show', $user->id))->with('success','[OK] Permissão concedida.' );

                } catch (\Throwable $th) {
                 //throw $th;

                  if(config("app.debug")){
                    return redirect(route('user.show', $user->id))->with('error','[ERRO] Operação falhou.' );
                }

                    return redirect(route('user.show', $user->id))->with('error','[ERRO] Houve falha, tente de novo !' );

                }
             }



             public function revokePermission(User $user, Permission $permission){
                try {
                    //code...
                    if($user->hasPermissionTo($permission)){
                        $user->revokePermissionTo($permission);
                        return redirect(route('user.show', $user->id))->with('success', '[OK] Permissão eliminada.');
                    }
                } catch (\Throwable $th) {
                    //throw $th;
                    if(config("app.debug")){
                        return redirect(route('user.show', $user->id))->with('error','[ERRO] Operação falhou.' );
                    }
                    return redirect(route('user.show', $user->id))->with('error','[ERRO] Houve falha, tente de novo !' );
                }


             }


}
