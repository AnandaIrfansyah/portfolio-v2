<?php

use App\Http\Controllers\Admin\AboutController as AdminAboutController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\CertificationController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProjectCategoryController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
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
    Route::get('/{slug}', [ProjectController::class, 'show'])->name('project.show');
});
Route::prefix('publications')->group(function () {
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

        Route::prefix('menu')->group(function () {
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

            // ✅ PROJECTS (BARU)
            Route::prefix('projects')->group(function () {
                Route::get('/', [AdminProjectController::class, 'index'])->name('projects.index');
                Route::post('/store', [AdminProjectController::class, 'store'])->name('projects.store');
                Route::get('/{id}/show', [AdminProjectController::class, 'show'])->name('projects.show');
                Route::put('/{id}/update', [AdminProjectController::class, 'update'])->name('projects.update');
                Route::delete('/{id}/destroy', [AdminProjectController::class, 'destroy'])->name('projects.destroy');
            });

            // ✅ PROJECT CATEGORIES (Helper)
            Route::prefix('project-categories')->group(function () {
                Route::get('/list', [ProjectCategoryController::class, 'list'])->name('project-categories.list');
                Route::post('/store', [ProjectCategoryController::class, 'store'])->name('project-categories.store');
            });

            // ✅ TECH STACKS LIST (Helper untuk Projects)
            Route::prefix('tech-stacks')->group(function () {
                Route::get('/list', [TechStackController::class, 'list'])->name('tech-stacks.list');
            });

            // About Management Routes
            Route::prefix('about')->name('abouts.')->group(function () {
                // Main page
                Route::get('/', [AdminAboutController::class, 'index'])->name('index');

                // Intro & CV
                Route::get('/intro/show', [AdminAboutController::class, 'showIntro'])->name('intro.show');
                Route::post('/intro/update', [AdminAboutController::class, 'updateIntro'])->name('intro.update');

                // Experiences
                Route::prefix('experiences')->name('experiences.')->group(function () {
                    Route::get('/list', [ExperienceController::class, 'list'])->name('list');
                    Route::post('/store', [ExperienceController::class, 'store'])->name('store');
                    Route::get('/{id}/show', [ExperienceController::class, 'show'])->name('show');
                    Route::put('/{id}/update', [ExperienceController::class, 'update'])->name('update');
                    Route::delete('/{id}/destroy', [ExperienceController::class, 'destroy'])->name('destroy');

                    // Positions
                    Route::post('/{experience_id}/positions/store', [ExperienceController::class, 'storePosition'])->name('positions.store');
                    Route::put('/positions/{id}/update', [ExperienceController::class, 'updatePosition'])->name('positions.update');
                    Route::delete('/positions/{id}/destroy', [ExperienceController::class, 'destroyPosition'])->name('positions.destroy');

                    // Achievements
                    Route::post('/positions/{position_id}/achievements/store', [ExperienceController::class, 'storeAchievement'])->name('achievements.store');
                    Route::delete('/achievements/{id}/destroy', [ExperienceController::class, 'destroyAchievement'])->name('achievements.destroy');
                });

                // Educations
                Route::prefix('educations')->name('educations.')->group(function () {
                    Route::get('/list', [EducationController::class, 'list'])->name('list');
                    Route::post('/store', [EducationController::class, 'store'])->name('store');
                    Route::get('/{id}/show', [EducationController::class, 'show'])->name('show');
                    Route::put('/{id}/update', [EducationController::class, 'update'])->name('update');
                    Route::delete('/{id}/destroy', [EducationController::class, 'destroy'])->name('destroy');

                    // Achievements
                    Route::post('/{education_id}/achievements/store', [EducationController::class, 'storeAchievement'])->name('achievements.store');
                    Route::delete('/achievements/{id}/destroy', [EducationController::class, 'destroyAchievement'])->name('achievements.destroy');
                });

                // Certifications
                Route::prefix('certifications')->name('certifications.')->group(function () {
                    Route::get('/list', [CertificationController::class, 'list'])->name('list');
                    Route::post('/store', [CertificationController::class, 'store'])->name('store');
                    Route::get('/{id}/show', [CertificationController::class, 'show'])->name('show');
                    Route::put('/{id}/update', [CertificationController::class, 'update'])->name('update');
                    Route::delete('/{id}/destroy', [CertificationController::class, 'destroy'])->name('destroy');

                    // Achievements
                    Route::post('/{certification_id}/achievements/store', [CertificationController::class, 'storeAchievement'])->name('achievements.store');
                    Route::delete('/achievements/{id}/destroy', [CertificationController::class, 'destroyAchievement'])->name('achievements.destroy');
                });
            });
        });
    }
);
