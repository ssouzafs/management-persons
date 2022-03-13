<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\AdminController;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    // login administrador
    Route::get('/', [AdminController::class, 'showFormLogin'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.do');

    // Rotas Protegidas ADM
    Route::group(['middleware' => 'auth:admin'], function () {

        // index
        Route::get('/administradores', [AdminController::class, 'index'])->name('index');
        Route::get('/administradores/carregar-dados', [AdminController::class, 'loadData'])->name('load.data');

        // Create
        Route::get('/administradores/novo', [AdminController::class, 'create'])->name('create');
        Route::post('/administradores/store', [AdminController::class, 'store'])->name('store');

        // edit
        Route::get('/administradores/edit/{id}', [AdminController::class, 'edit'])->name('edit');
        Route::put('/administradores/update/{id}', [AdminController::class, 'update'])->name('update');

        // Delete
        Route::delete('/administradores/destroy/{id}', [AdminController::class, 'destroy'])->name('destroy');

        // Dashboard Home
        Route::get('/home', [AdminController::class, 'home'])->name('home');

        // Edit Client [usuário]
        Route::get('/perfil-cliente/{id}', [AdminController::class, 'editClient'])->name('edit.client');
        Route::patch('/perfil-cliente/update/{id}', [AdminController::class, 'updateClient'])->name('update.client');
    });

    // Sair
    Route::get('/logout', [AdminController::class, 'logout'])->name('logout');

});

// ---------------------------------------------------------------------------------------------------------------------

// Formulário de Login do usuário
Route::get('/', [UserAuthController::class, 'showFormLogin'])->name('user.login');

// Formulário de Registro de usuário
Route::get('/cadastrar-se', [UserAuthController::class, 'showFormRegister'])->name('user.register');

Route::post('/register', [UserAuthController::class, 'register'])->name('user.store');

// Ação de Logar
Route::post('/login', [UserAuthController::class, 'login'])->name('user.login.do');

// Rotas Protegidas
Route::group(['middleware' => 'auth:web'], function () {
    Route::get('cliente/perfil/{id}', [UserAuthController::class, 'edit'])->name('user.edit');
    Route::put('update/{id}', [UserAuthController::class, 'update'])->name('user.update');
});

// Sair
Route::get('/logout', [UserAuthController::class, 'logout'])->name('user.logout');
