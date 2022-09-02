<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Role;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    //
    public function index()
    {

        //$roles = Role::whereNotIn('name', ['admin'])->get();
        $roles = Role::all();//whereNotIn('name', ['admin'])->get();
        $tot = Role::count();
        return view('admin.roles.index', compact('roles', 'tot'));
    }

    public function store(Request $request){

        $validated = $request->validate([
            'name' => 'required', 'min:3'
        ]);

        Role::create($validated);
        return redirect(route('role.index'))->with('success','[OK] Perfil registado com sucesso.');
    }

    public function edit(Role $role){
        return view('admin.roles.edit', compact('role'));
    }


    public function show(Role $role){
        $permissions = Permission::all();
        return view('admin.roles.show', compact('role','permissions'));
    }

    public function update(Request $request, Role $role){

        $validated = $request->validate([
            'name' => 'required|unique:roles', 'min:3'
        ]);

        $role->update($validated);

        return redirect(route('role.index'))->with('success','[OK] Perfil atualizado com sucesso.');
    }


    
    public function destroy( Role $role ){
        try {
            //code...
            $role->delete();
            return redirect(route('role.index'))->with('success','[OK] Perfil eliminado com sucesso.');
            
        } catch (\Throwable $th) {
            //throw $th;
            if(config('app.debug')){

                return redirect(route('role.index'))->with('error','[ERRO] Operação abortada!');
            }
            return redirect(route('role.index'))->with('error','[ERRO] Perfil não eliminado.');
        }
    }


    public function givePermission(Request $request, Role $role){

       try {
        //code...
        if($role->hasPermissionTo($request->permission)){
            return redirect(route('role.show', $role->id))->with('error','[AVISO] Perfil tem esta permissão.' );
        }
        $role->givePermissionTo($request->permission);
        return redirect(route('role.show', $role->id))->with('success','[OK] Permissão concedida.' );
       } catch (\Throwable $th) {
        //throw $th;
       }
    }



    public function revokePermission(Role $role, Permission $permission){
        if($role->hasPermissionTo($permission)){
            $role->revokePermissionTo($permission);
            return redirect(route('role.show', $role->id))->with('success', '[OK] Permissão eliminada.');
        }

    }
}
