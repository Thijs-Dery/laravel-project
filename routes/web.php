<?php

use App\Http\Controllers\{
    ProfileController,
    NewsController,
    FaqCategoryController,
    FaqController,
    ContactFormController,
    ContactController,
    HomeController,
    Admin\AdminController
};
use Illuminate\Support\Facades\Route;

// Redirect root to dashboard
Route::redirect('/', '/dashboard');

// Dashboard route
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Group routes that require authentication
Route::middleware('auth')->group(function () {

    // Profile routes
    Route::get('/profile/{profile}', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/{profile}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/{profile}', [ProfileController::class, 'update'])->name('profile.update');

    // FAQ routes
    Route::resource('faq-categories', FaqCategoryController::class);
    Route::resource('faqs', FaqController::class);

    // News routes (for authenticated users)
    Route::resource('news', NewsController::class);
});

// Auth routes
require __DIR__.'/auth.php';

// Home route
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Database test route
Route::get('/test-db', function () {
    try {
        \DB::connection()->getPdo();
        return 'Database connection is working!';
    } catch (\Exception $e) {
        return 'Could not connect to the database. Please check your configuration. Error: ' . $e->getMessage();
    }
});

// Admin routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    
    // Admin News management routes
    Route::get('/admin/news', [AdminController::class, 'index'])->name('admin.news.index');
    Route::post('/admin/news', [AdminController::class, 'store'])->name('admin.news.store');
    Route::delete('/admin/news/{id}', [AdminController::class, 'destroy'])->name('admin.news.destroy');

    // Contact Form management routes
    Route::get('/admin/contact-forms', [ContactFormController::class, 'index'])->name('contact.forms.index');
    Route::delete('/admin/contact-forms/{id}', [ContactFormController::class, 'destroy'])->name('contact.forms.destroy');
});

// Contact routes
Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Additional FAQ routes outside of auth middleware
Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');
Route::get('/faq/create', [FaqController::class, 'create'])->name('faqs.create');
Route::post('/faq', [FaqController::class, 'store'])->name('faqs.store');
Route::get('/faq/{faq}/edit', [FaqController::class, 'edit'])->name('faqs.edit');
Route::patch('/faq/{faq}', [FaqController::class, 'update'])->name('faqs.update');
Route::resource('faq-categories', FaqCategoryController::class);
Route::resource('faqs', FaqController::class);
Route::delete('/faq/{faq}', [FaqController::class, 'destroy'])->name('faqs.destroy');

// About page route
Route::get('/about-extra', function () {
    return view('about-extra');
})->name('about.extra');
