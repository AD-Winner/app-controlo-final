<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Criação das permissões para utilizadores
        Permission::create(['name' => 'adicionar']);
        Permission::create(['name' => 'editar']);
        Permission::create(['name' => 'apagar']);
        Permission::create(['name' => 'visualizar']);
        Permission::create(['name' => 'imprimir']);

    }
}
