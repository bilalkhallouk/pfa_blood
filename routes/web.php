<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Donor\DashboardController as DonorDashboardController;
use App\Http\Controllers\Patient\DashboardController as PatientDashboardController;
use App\Http\Controllers\BloodRequest\BloodRequestController;
use App\Http\Controllers\Donor\DonorController;
use App\Http\Controllers\Emergency\EmergencyController;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Settings\SettingsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Routes
Route::get('/', function () {
    return view('landing');
})->name('home');

// Authentication Routes
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Settings Routes
    Route::get('/settings', [SettingsController::class, 'show'])->name('settings.show');
    Route::put('/settings/password', [SettingsController::class, 'updatePassword'])->name('settings.password.update');
    Route::put('/settings/notifications', [SettingsController::class, 'updateNotifications'])->name('settings.notifications.update');

    // Admin Routes
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
    });

    // Donor Routes
    Route::middleware(['role:donor'])->prefix('donor')->group(function () {
        Route::get('/dashboard', [DonorDashboardController::class, 'index'])
             ->name('donor.dashboard');
    });

    // Patient Routes
    Route::middleware(['role:patient'])->prefix('patient')->group(function () {
        Route::get('/dashboard', [PatientDashboardController::class, 'index'])
             ->name('patient.dashboard');
    });

    // Centers Routes
    Route::get('/centers/nearby', [CenterController::class, 'nearby'])->name('centers.nearby');
    Route::get('/centers', [CenterController::class, 'index'])->name('centers.index');

    // Donor Routes
    Route::get('/donors/search', [App\Http\Controllers\Donor\DonorController::class, 'search'])->name('donors.search');
});

// Patient Routes
Route::middleware(['auth', 'role:patient'])->group(function () {
    Route::get('/patient/dashboard', function () {
        $data = [
            'activeRequests' => \App\Models\BloodRequest::where('user_id', auth()->id())
                ->where('status', 'pending')
                ->count(),
            'availableDonors' => \App\Models\User::where('role', 'donor')
                ->where('last_donation_at', '<=', now()->subMonths(3))
                ->count(),
            'notifications' => \App\Models\Notification::where('user_id', Auth::id())
                ->where('read', false)
                ->count(),
            'recentRequests' => \App\Models\BloodRequest::where('user_id', Auth::id())
                ->latest()
                ->take(5)
                ->get()
        ];
        return view('patient.patientdashboard', $data);
    })->name('patient.dashboard');

    Route::post('/blood-requests/store', [BloodRequestController::class, 'store'])->name('blood-requests.store');
    Route::get('/donors/search', [DonorController::class, 'search'])->name('donors.search');
    Route::post('/emergency/alert', [EmergencyController::class, 'alert'])->name('emergency.alert');
});