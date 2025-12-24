<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DoctorDashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Home page
Route::get('/', [HomeController::class, 'index'])->name('home');
// Doctors page
Route::get('/doctors', [DoctorController::class, 'doctorsPage'])->name('doctors.page');

// Contact page
Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact.form');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// about page

Route::get('/about', [PageController::class, 'about'])->name('about.page');

// Authentication (Breeze)
require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| Guest Only Routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {

    // Doctor signup page
    Route::get('/doctor/register', [RegisteredUserController::class, 'createDoctor'])
        ->name('doctor.register');

    // Doctor signup submit
    Route::post('/doctor/register', [RegisteredUserController::class, 'storeDoctor']);
});

/*
|--------------------------------------------------------------------------
| Authenticated User Routes (Patients)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Patient profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Patient dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Appointments
    Route::get('/appointment/create', [AppointmentController::class, 'create'])
        ->name('appointment.create');

    Route::post('/appointment', [AppointmentController::class, 'store'])
        ->name('appointment.store');

    Route::get('/appointments/{appointment}/edit', [AppointmentController::class, 'edit'])
        ->name('appointment.edit');

    Route::put('/appointment/{appointment}', [AppointmentController::class, 'update'])
        ->name('appointment.update');

    Route::delete('/appointment/{appointment}', [AppointmentController::class, 'destroy'])
        ->name('appointment.destroy');

    Route::get('/appointment/confirmation/{appointment}', function ($appointment) {
        return view('appointment.confirmation', compact('appointment'));
    })->name('appointment.confirmation');


    Route::post('/payment/verify', [PaymentController::class, 'verify'])
        ->name('payment.verify');

    Route::get('/payment/{appointment}', [PaymentController::class, 'checkout'])->name('payment.checkout');
});



/*
|--------------------------------------------------------------------------
| Doctor Only Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'doctor'])->prefix('doctor')->group(function () {

    // Doctor dashboard
    Route::get('/dashboard', [DoctorDashboardController::class, 'dashboard'])
        ->name('doctor.dashboard');

    // Doctor profile
    Route::get('/profile', [ProfileController::class, 'editDoctor'])
        ->name('doctor.profile-edit');

    Route::post('/profile', [ProfileController::class, 'updateDoctor'])
        ->name('doctor.profile-update');
});

/*
|--------------------------------------------------------------------------
| Google Calendar OAuth
|--------------------------------------------------------------------------
*/
Route::get('/google/auth', [GoogleController::class, 'auth'])->name('google.auth');
Route::get('/google/callback', [GoogleController::class, 'callback'])->name('google.callback');


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});


Route::post('/doctor/profile-edit', [ProfileController::class, 'updateDoctor'])
    ->name('doctor.profile-edit');
