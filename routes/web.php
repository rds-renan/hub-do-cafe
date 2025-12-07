<?php

use App\Http\Controllers\Auth\CustumerRegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AddressController;
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

    Route::get('/cadastro', [CustumerRegisterController::class, 'create'])->name('register.create');
    Route::post('/cadastro', [CustumerRegisterController::class, 'store'])->name('register.store');

    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
        ->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
        ->name('password.email');
});

// Client routes (shop routes)
Route::prefix('my-account')->name('account.')->middleware(['auth', 'role:client'])->group(function () {
    Route::get('/pedidos', function () {
        return view('frontend.account.orders');
    })->name('orders');

    Route::get('/perfil', function () {
        return view('frontend.account.profile');
    })->name('profile');

    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/add', [CartController::class, 'store'])->name('add');
        Route::put('/{id}', [CartController::class, 'update'])->name('update');
        Route::delete('/{id}', [CartController::class, 'destroy'])->name('destroy');
        Route::delete('/', [CartController::class, 'clear'])->name('clear');
        Route::get('/data', [CartController::class, 'getCartData'])->name('data');
    });

    Route::prefix('addresses')->name('addresses.')->group(function () {
        Route::get('/addresses', [AddressController::class, 'index'])->name('index');
        Route::post('/addresses', [AddressController::class, 'store'])->name('store');
        Route::put('/addresses/{address}', [AddressController::class, 'update'])->name('update');
        Route::delete('/addresses/{address}', [AddressController::class, 'destroy'])->name('destroy');
        Route::post('/addresses/{address}/default', [AddressController::class, 'setDefault'])->name('set-default');
    });
});

// Logout (acces  for all users logged)
Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


// Rotas Admin (protegidas - apenas para funcionários)
Route::prefix('crm')->name('crm.')->middleware(['auth', 'role:admin,employee,deliveryman'])->group(function () {
    // TODO: Adicionar middleware 'role:employee' e 'role:deliveryman quando implementar o sistema de roles
    Route::get('/dashboard', [CrmController::class, 'index'])->name('dashboard');

    // Aqui você pode adicionar outras rotas administrativas
    // Route::resource('products', ProductController::class);
    // Route::resource('orders', OrderController::class);
    // Route::resource('users', UserController::class);
});

Route::get('/coming-soon', function () {
    return view('frontend.coming-soon');
})->name('coming.soon');
