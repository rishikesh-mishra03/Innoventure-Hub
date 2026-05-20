<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StartupController;
use App\Http\Controllers\CorporateController;
use App\Http\Controllers\OpportunityController;
use App\Http\Controllers\AdminController;

// ──────────────────────────────────────────────
// Public routes
// ──────────────────────────────────────────────
Route::get('/', fn() => view('home'))->name('home');

// Auth
Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/login',   [AuthController::class, 'login'])->name('login.post');
Route::post('/register',[AuthController::class, 'register'])->name('register.post');
Route::post('/logout',  [AuthController::class, 'logout'])->name('logout');
Route::get('/demo-login',[AuthController::class, 'demoLogin'])->name('demo.login');

// Public startup browsing
Route::prefix('startups')->name('startups.')->group(function () {
    Route::get('/',        [StartupController::class, 'index'])->name('index');
    Route::get('/{id}',    [StartupController::class, 'show'])->name('show');
});

// Public corporate browsing
Route::prefix('corporates')->name('corporates.')->group(function () {
    Route::get('/',     [CorporateController::class, 'index'])->name('index');
    Route::get('/{id}', [CorporateController::class, 'show'])->name('show');
});

// Public opportunities browsing
Route::prefix('opportunities')->name('opportunities.')->group(function () {
    Route::get('/',     [OpportunityController::class, 'index'])->name('index');
    Route::get('/{id}', [OpportunityController::class, 'show'])->name('show');
});

// Public static pages
Route::view('/about',        'pages.about')->name('about');
Route::view('/how-it-works', 'pages.how-it-works')->name('how-it-works');
Route::view('/pricing',      'pages.pricing')->name('pricing');
Route::view('/contact',      'pages.contact')->name('contact');
Route::view('/events',       'pages.events')->name('events');
Route::view('/blog',         'pages.blog')->name('blog');
Route::view('/matchmaking',  'pages.matchmaking')->name('matchmaking');

// ──────────────────────────────────────────────
// Authenticated routes
// ──────────────────────────────────────────────
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Startup management
    Route::prefix('startups')->name('startups.')->group(function () {
        Route::get('/create',        [StartupController::class, 'create'])->name('create');
        Route::post('/',             [StartupController::class, 'store'])->name('store');
        Route::get('/my-dashboard',  [StartupController::class, 'dashboard'])->name('dashboard');
        Route::get('/{id}/edit',     [StartupController::class, 'edit'])->name('edit');
        Route::put('/{id}',          [StartupController::class, 'update'])->name('update');
    });

    // Corporate management
    Route::prefix('corporates')->name('corporates.')->group(function () {
        Route::get('/create',       [CorporateController::class, 'create'])->name('create');
        Route::post('/',            [CorporateController::class, 'store'])->name('store');
        Route::get('/my-dashboard', [CorporateController::class, 'dashboard'])->name('dashboard');
    });

    // Opportunity management
    Route::prefix('opportunities')->name('opportunities.')->group(function () {
        Route::get('/create',      [OpportunityController::class, 'create'])->name('create');
        Route::post('/',           [OpportunityController::class, 'store'])->name('store');
        Route::post('/{id}/apply', [OpportunityController::class, 'apply'])->name('apply');
    });

    // ── Admin Panel ──
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/',               [AdminController::class, 'index'])->name('index');
        Route::get('/users',          [AdminController::class, 'users'])->name('users');
        Route::get('/startups',       [AdminController::class, 'startups'])->name('startups');
        Route::get('/corporates',     [AdminController::class, 'corporates'])->name('corporates');
        Route::get('/opportunities',  [AdminController::class, 'opportunities'])->name('opportunities');
        Route::delete('/users/{id}',         [AdminController::class, 'deleteUser'])->name('users.delete');
        Route::delete('/startups/{id}',      [AdminController::class, 'deleteStartup'])->name('startups.delete');
        Route::delete('/opportunities/{id}', [AdminController::class, 'deleteOpportunity'])->name('opportunities.delete');
    });
});

