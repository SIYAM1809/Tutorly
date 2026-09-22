<?php

use App\Http\Controllers\AdmissionsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
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

// ─── Public Homepage & Inquiries ─────────────────────────────────────────────
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::post('/admissions/inquiry', [AdmissionsController::class, 'store'])->name('admissions.store');

// ─── Authenticated Routes ─────────────────────────────────────────────────────
Route::middleware(['auth'])->group(function () {

    // ── Smart Role-Based Dashboard (redirects each actor to their portal) ──
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ── Admin & Branch Admin Routes (super_admin + branch_admin) ──
    Route::middleware(['role:super_admin|branch_admin'])->group(function () {
        Route::get('/students', function () {
            return view('students.index');
        })->name('students.index');

        Route::get('/fees', function () {
            return view('fees.index');
        })->name('fees.index');

        Route::get('/exams', function () {
            return view('exams.index');
        })->name('exams.index');
    });

    // ── Admin, Branch Admin & Teacher Routes ──
    Route::middleware(['role:super_admin|branch_admin|teacher'])->group(function () {
        Route::get('/batches', function () {
            return view('batches.index');
        })->name('batches.index');

        Route::get('/attendance', function () {
            return view('attendance.index');
        })->name('attendance.index');
    });

    // ── Student Self-Service Portal Routes ──
    Route::middleware(['role:student'])->group(function () {
        Route::get('/my-attendance', function () {
            return view('student.my-attendance');
        })->name('student.attendance');

        Route::get('/my-fees', function () {
            return view('student.my-fees');
        })->name('student.fees');

        Route::get('/my-exams', function () {
            return view('student.my-exams');
        })->name('student.exams');

        Route::get('/my-batches', function () {
            return view('student.my-batches');
        })->name('student.batches');
    });

    // ── Payment Routes (SSLCommerz — accessible to all auth users) ──
    Route::get('/payment/pay/{fee}', [PaymentController::class, 'pay'])->name('payment.pay');
    Route::get('/payment/sandbox', [PaymentController::class, 'sandboxCheckout'])->name('payment.sandbox.checkout');
    Route::post('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
    Route::post('/payment/fail', [PaymentController::class, 'fail'])->name('payment.fail');
    Route::post('/payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');

    // ── User Profile & Security ──
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});

Route::post('/payment/ipn', [PaymentController::class, 'ipn'])->name('payment.ipn');

