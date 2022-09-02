<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\PermissionController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/findRegiaoName', [App\Http\Controllers\HomeController::class, 'findRegiaoName'])->name('find.regiao');
Route::get('/findCirculoName', [App\Http\Controllers\HomeController::class, 'findCirculoName'])->name('find.circulo');
Route::get('/findSectorName', [App\Http\Controllers\HomeController::class, 'findSectorName'])->name('find.sector');

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
        Route::post('store', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');
        Route::delete('destroy/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');

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
    Route::prefix('recenseados')->group(function(){
        Route::get('/', [App\Http\Controllers\RecenseadoController::class, 'index'])->name('recenseado.index');
        Route::post('/store', [App\Http\Controllers\RecenseadoController::class, 'store'])->name('recenseado.store');
        Route::delete('/{id}', [App\Http\Controllers\RecenseadoController::class, 'destroy'])->name('recenseado.destroy');
    });




});

