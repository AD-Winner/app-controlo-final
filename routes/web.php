<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\CoordenadorNacionalController;
use App\Http\Controllers\CoordenadorRegionalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware(['auth'])->group( function(){
     Route::get('/', function () {
        return view('home');
     });
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

Auth::routes();
Auth::routes();
Route::get('/findRegiaoName', [App\Http\Controllers\HomeController::class, 'findRegiaoName'])->name('find.regiao');
Route::get('/findCirculoName', [App\Http\Controllers\HomeController::class, 'findCirculoName'])->name('find.circulo');
Route::get('/findSectorName', [App\Http\Controllers\HomeController::class, 'findSectorName'])->name('find.sector');


// Rotas que administrador e logados podem accessar
Route::middleware(['auth', 'role:admin'])->group( function(){
    #----Routes de Roles ----#
   Route::prefix('roles')->group( function(){
        Route::get('', [App\Http\Controllers\RoleController::class, 'index'])->name('role.index');
        Route::get('/edit/{role}', [App\Http\Controllers\RoleController::class, 'edit'])->name('role.edit');
        Route::get('/show/{role}', [App\Http\Controllers\RoleController::class, 'show'])->name('role.show');
        Route::post('/store', [App\Http\Controllers\RoleController::class, 'store'])->name('role.store');
        Route::put('/update/{role}', [App\Http\Controllers\RoleController::class, 'update'])->name('role.update');
        Route::delete('/destroy/{role}', [App\Http\Controllers\RoleController::class, 'destroy'])->name('role.destroy');
        Route::post('/role/{role}/permission', [App\Http\Controllers\RoleController::class, 'givePermission'])->name('role.permissions');
        Route::delete('/role/{role}/permission/{permission}', [App\Http\Controllers\RoleController::class, 'revokePermission'])->name('role.permission.revoke');

    });

    #----Routes de Permissioes ----#
    Route::prefix('permissoes')->group( function(){
        Route::get('', [App\Http\Controllers\PermissionController::class, 'index'])->name('permission.index');
        Route::get('/edit/{permission}', [App\Http\Controllers\PermissionController::class, 'edit'])->name('permission.edit');
        Route::get('/show/{permission}', [App\Http\Controllers\PermissionController::class, 'show'])->name('permission.show');
        Route::post('/store', [App\Http\Controllers\PermissionController::class, 'store'])->name('permission.store');
        Route::put('/update/{permission}', [App\Http\Controllers\PermissionController::class, 'update'])->name('permission.update');
        Route::delete('/destroy/{permission}', [App\Http\Controllers\PermissionController::class, 'destroy'])->name('permission.destroy');
        Route::post('/permission/{permission}/permission', [App\Http\Controllers\PermissionController::class, 'assignRole'])->name('permission.roles');
        Route::delete('/permission/{permission}/role/{role}', [App\Http\Controllers\PermissionController::class, 'removeRole'])->name('permission.role.remove');
    });
    Route::prefix('users')->group( function(){
        Route::get('', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
        Route::post('edit/{user}', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
        Route::get('check/{user}', [App\Http\Controllers\UserController::class, 'check'])->name('user.check');
        Route::get('show/{user}', [App\Http\Controllers\UserController::class, 'show'])->name('user.show');
        Route::post('store', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');
        Route::delete('destroy/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');

        Route::post('user/{user}/roles', [App\Http\Controllers\UserController::class, 'assignRole'])->name('user.roles');
        Route::delete('user/{user}/role/{role}', [App\Http\Controllers\UserController::class, 'removeRole'])->name('user.role.remove');

        Route::post('user/{user}/permissions', [App\Http\Controllers\UserController::class, 'givePermission'])->name('user.permissions');
        Route::delete('user/{user}/permission/{permission}', [App\Http\Controllers\UserController::class, 'revokePermission'])->name('user.permission.remove');
    });


    Route::prefix('provincias')->group(function(){
        Route::get('/', [App\Http\Controllers\ProvinciaController::class, 'index'])->name('provincia.index');
        Route::get('/provincias/all', [App\Http\Controllers\ProvinciaController::class, 'allData'])->name('provincia.allData');
        Route::post('/store', [App\Http\Controllers\ProvinciaController::class, 'store'])->name('provincia.store');
        Route::put('/update/{id}', [App\Http\Controllers\ProvinciaController::class, 'update'])->name('provincia.update');
        Route::get('/edit/{id}', [App\Http\Controllers\ProvinciaController::class, 'edit'])->name('provincia.edit');
        Route::put('/update/{id}', [App\Http\Controllers\ProvinciaController::class, 'update'])->name('provincia.edit');
        Route::delete('/destroy/{id}', [App\Http\Controllers\ProvinciaController::class, 'destroy'])->name('provincia.destroy');
    });

    Route::prefix('regioes')->group(function(){

        Route::get('/', [App\Http\Controllers\RegiaoController::class, 'index'])->name('regioes.index');
        Route::post('/store', [App\Http\Controllers\RegiaoController::class, 'store'])->name('regioes.store');
        Route::delete('/{id}', [App\Http\Controllers\RegiaoController::class, 'destroy'])->name('regioes.destroy');

    });
    Route::prefix('circulos')->group(function(){
        Route::get('/', [App\Http\Controllers\CirculoController::class, 'index'])->name('circulo.index');
        Route::post('/store', [App\Http\Controllers\CirculoController::class, 'store'])->name('circulo.store');
        Route::delete('/{id}', [App\Http\Controllers\CirculoController::class, 'destroy'])->name('circulo.destroy');
    });
    Route::prefix('sectores')->group(function(){
        Route::get('/', [App\Http\Controllers\SectorController::class, 'index'])->name('sector.index');
        Route::post('/store', [App\Http\Controllers\SectorController::class, 'store'])->name('sector.store');
        Route::delete('/{id}', [App\Http\Controllers\SectorController::class, 'destroy'])->name('sector.destroy');
    });
    Route::prefix('kits')->group(function(){
        Route::get('/', [App\Http\Controllers\KitController::class, 'index'])->name('kit.index');
        Route::post('/store', [App\Http\Controllers\KitController::class, 'store'])->name('kit.store');
        Route::delete('/{id}', [App\Http\Controllers\KitController::class, 'destroy'])->name('kit.destroy');
    });
    Route::prefix('recenseamentos')->group(function(){
        Route::get('/', [App\Http\Controllers\RecenseamentoController::class, 'index'])->name('recenseamento.index');
        Route::post('/store', [App\Http\Controllers\RecenseamentoController::class, 'store'])->name('recenseamento.store');
        Route::delete('/{id}', [App\Http\Controllers\RecenseamentoController::class, 'destroy'])->name('recenseamento.destroy');
    });

    // Route::prefix('recenseados')->group(function(){
        Route::get('/recenseados', [App\Http\Controllers\RecenseadoController::class, 'index'])->name('recenseado.index');
        Route::post('/store', [App\Http\Controllers\RecenseadoController::class, 'store'])->name('recenseado.store');
        Route::delete('/{id}', [App\Http\Controllers\RecenseadoController::class, 'destroy'])->name('recenseado.destroy');
    // });
}); //Fim de Rotas de Administrador


// Rotas para supervisor e logados podem accessar
Route::middleware(['auth', 'role:supervisor'])->group( function(){
    Route::prefix('dados')->group(function(){
        // Route::get('/', [App\Http\Controllers\RecenseadoController::class, 'index'])->name('recenseado.index');
        Route::get('/dashboard', [App\Http\Controllers\SupervisorController::class, 'dashboard'])->name('supervisor.dashboard');
        Route::get('/kits', [App\Http\Controllers\SupervisorController::class, 'kits'])->name('supervisor.kits');
        Route::get('/diario', [App\Http\Controllers\SupervisorController::class, 'recenseados'])->name('supervisor.recenseados');
        Route::post('/store', [App\Http\Controllers\SupervisorController::class, 'store'])->name('supervisor.recenseados.store');
        Route::delete('/{recenseado}/destroy', [App\Http\Controllers\SupervisorController::class, 'destroy'])->name('supervisor.recenseados.destroy');
    });
});

// Rotas para coordenador Regional e logados podem accessar
Route::middleware(['auth', 'role:coordenador-regional'])->group( function(){
    Route::prefix('controlo-regional')->group(function(){
        Route::get('/dashboard', [App\Http\Controllers\CoordenadorRegionalController::class, 'dashboard'])->name('coordenador.regional.dashboard');
        Route::get('/kits', [App\Http\Controllers\CoordenadorRegionalController::class, 'kits'])->name('coordenador.regional.kits');
        Route::get('/diario', [App\Http\Controllers\CoordenadorRegionalController::class, 'recenseados'])->name('coordenador.regional.recenseados');
    });
});

// Rotas para coordenador provincial conectados podem accessar
Route::middleware(['auth', 'role:coordenador-provincia'])->group( function(){
    Route::prefix('controlo-provincial')->group(function(){
        Route::get('dashboard', [App\Http\Controllers\CoordenadorProvinciaController::class, 'dashboard'])->name('coordenador.provincial.dashboard');
        Route::get('kits', [App\Http\Controllers\CoordenadorProvinciaController::class, 'kits'])->name('coordenador.provincial.kits');
        Route::get('diario', [App\Http\Controllers\CoordenadorProvinciaController::class, 'recenseados'])->name('coordenador.provincial.recenseados');
    });
});

// Rotas para coordenador Nacional conectados podem accessar
Route::middleware(['auth', 'role:coordenador-nacional'])->group( function(){
    Route::prefix('controlo-nacional')->group(function(){
        Route::get('dashboard', [App\Http\Controllers\CoordenadorNacionalController::class, 'index'])->name('coordenador.nacional.dashboard');
        Route::get('kits', [App\Http\Controllers\CoordenadorNacionalController::class, 'kits'])->name('coordenador.nacional.kits');
        Route::get('diario', [CoordenadorNacionalController::class, 'recenseados'])->name('coordenador.nacional.recenseados');
    });
});

