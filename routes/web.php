<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsaletterController;
use Illuminate\Support\Facades\Route;

// Rotas do Frontend (público)
Route::get('/', HomeController::class)->name('home');

Route::post('/newsletter', [NewsaletterController::class, 'store'])
    ->name('newsletter.store');

Route::prefix('produtos')->name('products.')->group(function () {
    Route::get('/', function () {
        return view('frontend.products.index');
    })->name('index');

    Route::get('/{id}', function ($id) {
        return view('frontend.products.show', compact('id'));
    })->name('show');
});

Route::prefix('carrinho')->name('cart.')->group(function () {
    Route::get('/revisao', function () {
        return view('frontend.cart.review');
    })->name('review');

    Route::get('/checkout', function () {
        return view('frontend.cart.checkout');
    })->name('checkout');
});

// Rotas de autenticação (compartilhadas - frontend)
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('frontend.auth.login');
    })->name('login');

    Route::get('/cadastro', function () {
        return view('frontend.auth.register');
    })->name('register');
});

Route::post('/logout', function () {
    auth()->logout();
    return redirect()->route('home');
})->name('logout')->middleware('auth');

// Rotas Admin (protegidas - apenas para funcionários)
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    // TODO: Adicionar middleware 'role:employee' quando implementar o sistema de roles
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Aqui você pode adicionar outras rotas administrativas
    // Route::resource('products', ProductController::class);
    // Route::resource('orders', OrderController::class);
    // Route::resource('users', UserController::class);
});
