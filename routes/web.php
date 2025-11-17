<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CrmController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsaletterController;
use Illuminate\Support\Facades\Route;

// Rotas do Frontend (público)
// Home
Route::get('/', HomeController::class)->name('home');

// Newsletter Subscriber
Route::post('/newsletter', [NewsaletterController::class, 'store'])
    ->name('newsletter.store');


// Authencation
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/cadastro', function () {
        return view('frontend.auth.register');
    })->name('register');

    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
        ->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
        ->name('password.email');
});

// Client routes (store routes)
Route::prefix('my-account')->name('account.')->middleware(['auth', 'role:cliente'])->group(function () {
    Route::get('/pedidos', function () {
        return view('frontend.account.orders');
    })->name('orders');

    Route::get('/perfil', function () {
        return view('frontend.account.profile');
    })->name('profile');

    // Add others routes here
});

// Logout (acces  for all users logged)
Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


// Produtcs
Route::prefix('products')->name('products.')->group(function () {
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

// Rotas Admin (protegidas - apenas para funcionários)
Route::prefix('crm')->name('crm.')->middleware(['auth', 'role:admin,employee'])->group(function () {
    // TODO: Adicionar middleware 'role:employee' quando implementar o sistema de roles
    Route::get('/dashboard', [CrmController::class, 'index'])->name('dashboard');

    // Aqui você pode adicionar outras rotas administrativas
    // Route::resource('products', ProductController::class);
    // Route::resource('orders', OrderController::class);
    // Route::resource('users', UserController::class);
});

// Rotas do Delivery
Route::prefix('delivery')->name('delivery.')->middleware(['auth', 'role:delivery'])->group(function () {
    Route::get('/dashboard', function () {
        return view('delivery.dashboard');
    })->name('dashboard');

    // Adicione outras rotas do delivery aqui quando criar o sistema
});

Route::get('/coming-soon', function () {
    return view('frontend.coming-soon');
})->name('coming.soon');
