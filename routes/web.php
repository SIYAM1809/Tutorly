<?php

use App\Http\Controllers\PaymentController;
use App\Livewire\Auth\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// ─── Auth Routes ─────────────────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
});

Route::post('/logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect()->route('login');
})->middleware('auth')->name('logout');


Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/students', function () {
        return view('students.index');
    })->name('students.index');

    // Payment Routes (SSLCommerz)
    Route::get('/payment/pay/{fee}', [PaymentController::class, 'pay'])->name('payment.pay');
    Route::get('/payment/sandbox', [PaymentController::class, 'sandboxCheckout'])->name('payment.sandbox.checkout');
    Route::post('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
    Route::post('/payment/fail', [PaymentController::class, 'fail'])->name('payment.fail');
    Route::post('/payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');
});

Route::post('/payment/ipn', [PaymentController::class, 'ipn'])->name('payment.ipn');
