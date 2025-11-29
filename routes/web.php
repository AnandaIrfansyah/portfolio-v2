<?php

use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\PublicationController as AdminPublicationController;
use App\Http\Controllers\Admin\PublicationTagController;
use App\Http\Controllers\Admin\TechStackController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Pages\AboutController;
use App\Http\Controllers\Pages\BlogController;
use App\Http\Controllers\Pages\ContactController;
use App\Http\Controllers\Pages\GuestBookController;
use App\Http\Controllers\Pages\HomeController;
use App\Http\Controllers\Pages\ProjectController;
use App\Http\Controllers\Pages\PublicationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('home.index');
});

Route::prefix('panel')->group(
    function () {
        Route::get('/login', [LoginController::class, 'index'])->name('login');
        Route::post('/login', [LoginController::class, 'authenticate'])->name('login.post');
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    }
);

Route::prefix('home')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
});
Route::prefix('projects')->group(function () {
    Route::get('/', [ProjectController::class, 'index'])->name('project.index');
});
Route::prefix('publication')->group(function () {
    Route::get('/', [PublicationController::class, 'index'])->name('publication.index');
    Route::get('/{slug}', [PublicationController::class, 'show'])->name('publication.show');
});
Route::prefix('about')->group(function () {
    Route::get('/', [AboutController::class, 'index'])->name('about.index');
});
Route::prefix('contact')->group(function () {
    Route::get('/', [ContactController::class, 'index'])->name('contact.index');
});
Route::prefix('guestbook')->group(function () {
    Route::get('/', [GuestBookController::class, 'index'])->name('guestbook.index');
});


Route::middleware(['auth', 'role:author'])->group(
    function () {
        Route::prefix('dashboard')->group(function () {
            Route::get('/', function () {
                return view('admin.dashboard.index');
            })->name('author.dashboard');
        });

        Route::prefix('profile')->group(function () {
            Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
            Route::post('/', [ProfileController::class, 'update'])->name('profile.update');
        });

        Route::prefix('setting')->group(function () {
            Route::prefix('tech-stack')->group(function () {
                Route::get('/', [TechStackController::class, 'index'])->name('tech-stack.index');
                Route::post('/store', [TechStackController::class, 'store'])->name('tech-stack.store');
                Route::get('/{id}/show', [TechStackController::class, 'show'])->name('tech-stack.show');
                Route::put('/{id}/update', [TechStackController::class, 'update'])->name('tech-stack.update');
                Route::delete('/{id}/destroy', [TechStackController::class, 'destroy'])->name('tech-stack.destroy');
            });
        });

        // ✅ PUBLICATIONS (TERPISAH, GAK DI SETTING)
        Route::prefix('publications')->group(function () {
            Route::get('/', [AdminPublicationController::class, 'index'])->name('publications.index');
            Route::post('/store', [AdminPublicationController::class, 'store'])->name('publications.store');
            Route::get('/{id}/show', [AdminPublicationController::class, 'show'])->name('publications.show');
            Route::put('/{id}/update', [AdminPublicationController::class, 'update'])->name('publications.update');
            Route::delete('/{id}/destroy', [AdminPublicationController::class, 'destroy'])->name('publications.destroy');
        });

        // ✅ AUTHORS (Helper untuk dropdown/quick add)
        Route::prefix('authors')->group(function () {
            Route::get('/list', [AuthorController::class, 'list'])->name('authors.list');
            Route::post('/store', [AuthorController::class, 'store'])->name('authors.store');
        });

        // ✅ TAGS (Helper untuk dropdown/quick add)
        Route::prefix('tags')->group(function () {
            Route::get('/list', [PublicationTagController::class, 'list'])->name('tags.list');
            Route::post('/store', [PublicationTagController::class, 'store'])->name('tags.store');
        });
    }
);
