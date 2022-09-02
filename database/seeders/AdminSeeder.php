<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         #-- Criação de utilizador desenvolvidor --#
         $dev = User::create([
            'name' => 'Dev',
            'email' => 'dev@controlo.app',
            'email_verified_at' => now(),
            'password' =>  Hash::make('123456789'),
        ]);

        #-- Criação de utilizador administrador --#
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@controlo.app',
            'email_verified_at' => now(),
            'password' =>  Hash::make('123456789'),
        ]);

        ##-- Designar Perfil para utilizador desenvolvedor
        $dev->assignRole('dev', 'admin');
        ##-- Designar Perfil para utilizador Administrador
        $admin->assignRole('admin');



    }
}
