<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        #--- Crição dos Perfis de Utilizadores ---#
        $dev = Role::create(['name' => 'dev']);
        $admin = Role::create(['name' => 'admin']);
        $coordenador_nacional = Role::create(['name' => 'coordenador-nacional']);
        $coordenador_provincia = Role::create(['name' => 'coordenador-provincia']);
        $coordenador_regional = Role::create(['name' => 'coordenador-regional']);
        $supervisor = Role::create(['name' => 'supervisor']);



        #--- Dar permissões aos Perfis de Utilizadores ---#
        $dev->givePermissionTo('adicionar','editar', 'apagar','visualizar', 'imprimir');
        $admin->givePermissionTo('adicionar','editar', 'apagar','visualizar', 'imprimir');
        $coordenador_nacional->givePermissionTo('visualizar', 'imprimir');
        $coordenador_provincia->givePermissionTo('visualizar', 'imprimir');
        $coordenador_regional->givePermissionTo('visualizar', 'imprimir');
        $supervisor->givePermissionTo('adicionar','editar', 'apagar','visualizar', 'imprimir');
    }
}
