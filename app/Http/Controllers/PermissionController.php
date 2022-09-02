<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    //
    public function index()
    {

        $permissions = Permission::all();
        $tot = Permission::count();
        return view('admin.permissions.index', compact('permissions', 'tot'));
    }

    public function store(Request $request){

        $validated = $request->validate([
            'name' => 'required', 'min:3'
        ]);
        Permission::create($validated);
        return redirect(route('permission.index'))->with('success','[OK] Permissão registada com sucesso.');
    }

    public function edit(Permission $permission){
        return view('admin.permissions.edit', compact('permission'));
    }
   
   
    public function show(Permission $permission){
        
        $roles = Role::all();
        return view('admin.permissions.show', compact('permission','roles'));
    }


    public function update(Request $request, Permission $permission){

        $validated = $request->validate([
            'name' => 'required', 'min:3'
        ]);

        $permission->update($validated);

        return redirect(route('permission.index'))->with('success','[OK] Permissão alterada com sucesso.');
    }




    public function destroy( Permission $permission ){
        try {
            //code...
            $permission->delete();
            return redirect(route('permission.index'))->with('success','[OK] Perfil eliminado com sucesso.');
            
        } catch (\Throwable $th) {
            //throw $th;
            if(config('app.debug')){

                return redirect(route('permission.index'))->with('error','[ERRO] Operação abortada!');
            }
            return redirect(route('permission.index'))->with('error','[ERRO] Perfil não eliminado.');
        }
    }


    public function assignRole(Request $request, Permission $permission){

        
       try {
            //code...
            if($permission->hasRole($request->role)){
                return redirect(route('permission.show', $permission->id))->with('error','[AVISO] Perfil existente.' );
            }
            $permission->assignRole($request->role);
            return redirect(route('permission.show', $permission->id))->with('success','[OK] Autorização concedida.' );
    } catch (\Throwable $th) {
        //throw $th;
        if(config("app.debug")){
            return redirect(route('permission.show', $permission->id))->with('error','[ERRO] Operação falhou.' );

        }
        return redirect(route('permission.show', $permission->id))->with('error','[ERRO] Houve falha, repita !' );
    }
}

public function removeRole(Permission $permission, Role $role){
    
    try {
        //code...
        if($permission->hasRole($role)){
            $permission->removeRole($role);
            return redirect(route('permission.show', $permission->id))->with('success','[OK] Autorização removida.' );
        }
    } catch (\Throwable $th) {
        //throw $th;
        if(config("app.debug")){
            return redirect(route('permission.show', $permission->id))->with('error','[ERRO] Operação falhou.' );

        }
        return redirect(route('permission.show', $permission->id))->with('error','[ERRO] Houve falha, repita !' );
        }
    }
}
