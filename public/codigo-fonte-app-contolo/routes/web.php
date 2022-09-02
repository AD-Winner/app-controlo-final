<?php

// <<<<<<< HEAD
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegiaoController;
// =======
// use Illuminate\Support\Facades\Route;
// >>>>>>> 7764d3ccff43272916eae7249740e16c27caf798

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

// <<<<<<< HEAD
// Route::get('/regioes', [App\Http\Controllers\RegiaoController::class, 'index'])->name('regiao.index');
// Route::resource('/regioes', RegiaoController::class);
// Route::middleware(['auth', 'role:cds'])->group(function(){
Route::middleware(['auth'])->group(function(){



    Route::get('/findRegiaoName', [App\Http\Controllers\HomeController::class, 'findRegiaoName'])->name('find.regiao');
    Route::get('/findCirculoName', [App\Http\Controllers\HomeController::class, 'findCirculoName'])->name('find.circulo');
    Route::get('/findSectorName', [App\Http\Controllers\HomeController::class, 'findSectorName'])->name('find.sector');
        // Route::get('/findBureauName', [App\Http\Controllers\HomeController::class, 'findBureauName'])->name('find-bureau');

    Route::prefix('users')->group(function(){
        Route::get('', [UserController::class, 'index'])->name('user.index');
        Route::get('/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/store', [UserController::class, 'store'])->name('user.store');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::get('/{id}/show', [UserController::class, 'show'])->name('user.show');
        Route::get('/{id}/check', [UserController::class, 'check'])->name('user.check');
        Route::put('/{id}/update', [UserController::class, 'update'])->name('user.update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('user.destroy');
        Route::get('/pdf',     [UserController::class, 'geraPdf'])->name('user.print');

        Route::post('/{user}/roles',  [UserController::class, 'assignRole'])->name('user.roles');
        Route::delete('/{user}/roles/{role}', [UserController::class, 'removeRole'])->name('user.role.remove');

        Route::post('/{user}/permissions', [UserController::class, 'givePermission'])->name('user.permissions');
        Route::delete('/{user}/permissions/{permission}', [UserController::class, 'revokePermission'])->name('user.permission.revoke');

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


    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // =======
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    // >>>>>>> 7764d3ccff43272916eae7249740e16c27caf798
});

