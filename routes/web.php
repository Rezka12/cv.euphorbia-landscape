<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Public Controllers
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\ServicePageController;
use App\Http\Controllers\Public\ProjectPageController;
use App\Http\Controllers\Public\PortfolioPageController;
use App\Http\Controllers\Public\PlantPageController;
use App\Http\Controllers\Public\AboutPageController;
use App\Http\Controllers\Public\ContactPageController;

/*
|--------------------------------------------------------------------------
| Admin Controllers
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\PortfolioController as AdminPortfolioController;
use App\Http\Controllers\Admin\PlantController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ContactAdminController;

/*
|--------------------------------------------------------------------------
| FRONTEND (PUBLIC)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('site.home');

Route::get('/services', [ServicePageController::class, 'index'])->name('site.services');

/* Projects */
Route::get('/projects', [ProjectPageController::class, 'index'])->name('site.projects');
Route::get('/projects/{slug}', [ProjectPageController::class, 'show'])->name('site.projects.show');
Route::get('/projects/category/{slug}', [ProjectPageController::class, 'category'])
    ->name('site.projects.category');

/* Portfolio */
Route::get('/portfolio', [PortfolioPageController::class, 'index'])->name('site.portfolio');
Route::get('/portfolio/{slug}', [PortfolioPageController::class, 'show'])
    ->name('site.portfolio.show');

/* Plants */
Route::get('/plants', [PlantPageController::class, 'index'])->name('site.plants');
Route::get('/plants/{slug}', [PlantPageController::class, 'show'])
    ->name('site.plants.show');

/* About */
Route::get('/about', [AboutPageController::class, 'index'])->name('site.about');

/* Contact */
Route::get('/contact', [ContactPageController::class, 'index'])->name('site.contact');
Route::post('/contact', [ContactPageController::class, 'store'])->name('site.contact.store');

/* Download profil */
Route::get('/download-profil', function () {
    $path = 'downloads/Rekapan_Pekerjaan_Perusahaan.xlsx';
    abort_unless(Storage::disk('public')->exists($path), 404);

    return response()->download(
        storage_path('app/public/' . $path),
        'Profil_Perusahaan_' . now()->format('Ymd_His') . '.xlsx'
    );
})->name('site.download.profile');

/*
|--------------------------------------------------------------------------
| BACKEND (ADMIN)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'isAdmin'])
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {

        Route::view('/dashboard', 'admin.dashboard')->name('dashboard');
        Route::redirect('/', '/admin/dashboard');

        Route::resource('services', ServiceController::class);
        Route::resource('projects', AdminProjectController::class);
        Route::resource('portfolios', AdminPortfolioController::class);
        Route::resource('plants', PlantController::class);
        Route::resource('categories', CategoryController::class);

        // Project photos
        Route::delete(
            'projects/{project}/photos/{photo}',
            [AdminProjectController::class, 'destroyPhoto']
        )->name('projects.photos.destroy');

        // Project complete
        Route::get(
            'projects/{project}/complete',
            [AdminProjectController::class, 'completeForm']
        )->name('projects.complete.form');

        Route::post(
            'projects/{project}/complete',
            [AdminProjectController::class, 'complete']
        )->name('projects.complete');

        Route::get('about', [AboutController::class, 'index'])->name('about.index');
        Route::get('about/edit', [AboutController::class, 'edit'])->name('about.edit');
        Route::put('about', [AboutController::class, 'update'])->name('about.update');


        // ABOUT (INI YANG KAMU BUTUHKAN)
        // Route::get('about', [AboutController::class, 'index'])->name('about.index');
        // Route::get('about/edit', [AboutController::class, 'edit'])->name('about.edit');
        // Route::put('about', [AboutController::class, 'update'])->name('about.update');

        // Contact admin
        Route::resource('contacts', ContactAdminController::class)
            ->only(['index', 'show', 'destroy']);
    });

require __DIR__ . '/auth.php';
