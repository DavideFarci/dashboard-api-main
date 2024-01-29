<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DayController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\DateController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\SlotController;
use App\Http\Controllers\Admin\TimeController;
use App\Http\Controllers\Admin\MonthController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\HashtagController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Guests\PageController as GuestsPageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [GuestsPageController::class, 'home'])->name('guests.home');

Route::middleware(['auth', 'verified'])
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {

        Route::get('/',                                      [AdminPageController::class, 'dashboard'])->name('dashboard');
        Route::get('/setting',                               [AdminPageController::class, 'setting'])->name('setting');
        Route::get('/timeslot',                              [AdminPageController::class, 'timeslot'])->name('timeslot');
        Route::get('/slot',                                  [AdminPageController::class, 'slot'])->name('slot');

        // Rotte Projects 
        Route::post('/projects/updatestatus/{project_id}',      [ProjectController::class, 'updatestatus'])->name('projects.updatestatus');
        Route::get('/projects/trashed',                      [ProjectController::class, 'trashed'])->name('projects.trashed');
        Route::post('/projects/{project}/restore',           [ProjectController::class, 'restore'])->name('projects.restore');
        Route::delete('/projects/{project}/hardDelete',      [ProjectController::class, 'harddelete'])->name('projects.hardDelete');

        // Rotte Post 
        Route::get('/posts/trashed',                         [PostController::class, 'trashed'])->name('posts.trashed');
        Route::resource('posts',                             PostController::class);

        // Rotte Orders
        Route::post('/orders/updatestatus/{order_id}',       [OrderController::class, 'updatestatus'])->name('orders.updatestatus');

        // Rotte Reservations
        Route::post('/reservations/updatestatus/{order_id}', [ReservationController::class, 'updatestatus'])->name('reservations.updatestatus');

        // Rotte Settings
        Route::put('/settings/allupdate',                    [SettingController::class, 'allupdate'])->name('settings.allupdate');

        // Rotte Time
        Route::resource('times',                             TimeController::class);
        Route::post('/times/toggle-visibility/{time_id}',   [TimeController::class, 'toggleTimeVisibility'])->name('times.toggleTimeVisibility');

        // Rotte Slot
        Route::post('/slots/toggle-visibility/{slot_id}',   [SlotController::class, 'toggleTimeVisibility'])->name('slots.toggleTimeVisibility');


        // Rotte Resource
        Route::resource('dates',        DateController::class);
        Route::resource('slots',        SlotController::class);
        Route::resource('settings',     SettingController::class);
        Route::resource('reservations', ReservationController::class);
        Route::resource('orders',       OrderController::class);
        Route::resource('projects',     ProjectController::class);
        Route::resource('categories',   CategoryController::class);
        Route::resource('tags',         TagController::class);
        Route::resource('hashtags',     HashtagController::class);
        Route::resource('months',       MonthController::class);
        Route::resource('days',         DayController::class);

        // Rotte Date 
        Route::post('/dates/updatestatus/{order_id}',       [DateController::class, 'updatestatus'])->name('dates.updatestatus');

        Route::post('/dates/upmaxres/{order_id}',           [DateController::class, 'upmaxres'])->name('dates.upmaxres');
        Route::post('/dates/downmaxres/{order_id}',         [DateController::class, 'downmaxres'])->name('dates.downmaxres');

        Route::post('/dates/upmaxpz/{order_id}',           [DateController::class, 'upmaxpz'])->name('dates.upmaxpz');
        Route::post('/dates/downmaxpz/{order_id}',         [DateController::class, 'downmaxpz'])->name('dates.downmaxpz');

        Route::post('/dates/runSeeder',                     [DateController::class, 'runSeeder'])->name('dates.runSeeder');
    });

Route::middleware('auth')
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

require __DIR__ . '/auth.php';
