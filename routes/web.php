<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogCommentController;
use App\Http\Controllers\AccountManagementController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/password/email', function () {
    return abort(404);
});

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/game/{gameid}', [GameController::class, 'gameapp']);
Route::get('/game/{gameid}/gameonly', [GameController::class, 'game']);

Route::resource('/community', BlogController::class);
Route::get('/account/{id}', [AccountManagementController::class, 'show_other_account']);

Route::middleware('auth')->group(function () {
    Route::get('/myposts', [BlogCommentController::class, 'myposts']);
    Route::get('/mycomments', [BlogCommentController::class, 'mycomments']);
    Route::post('/community/{community}/reply',[BlogCommentController::class, 'addComment']);
    Route::get('/management/account', [AccountManagementController::class, 'index']);
    Route::get('/management/account/passwordchange', [AccountManagementController::class, 'changepassword_index']);
    Route::patch('/management/account/passwordchange', [AccountManagementController::class, 'changepassword_update']);
    Route::patch('/management/account/namechange', [AccountManagementController::class, 'changename_update']);

    Route::middleware('is_admin')->group(function () {
        Route::get('/admin', [AdminController::class, 'index']);
        Route::get('/admin/passcodes', [AdminController::class, 'passcode_index']);
        Route::get('/admin/passcodes/edit', [AdminController::class, 'passcode_edit']);
        Route::put('/admin/passcodes/edit', [AdminController::class, 'passcode_update']);
        Route::get('/admin/accounts', [AdminController::class, 'account_index'])->name('adminaccounts');
        Route::patch('/admin/accounts/{userid}', [AdminController::class, 'account_update']);
        Route::get('/admin/games', [AdminController::class, 'game_index']);
        Route::get('/admin/games/control', [AdminController::class, 'game_control_index'])->name('admingamescontrol');
        Route::patch('/admin/games/control/{gameid}', [AdminController::class, 'game_control_update']);
        Route::get('/admin/games/control/{gameid}/edit', [AdminController::class, 'game_control_edit']);
        Route::get('/admin/games/control/{debugid}/edit/debug', [AdminController::class, 'game_control_edit_debug']);
        Route::put('/admin/games/control/{gameid}/edit', [AdminController::class, 'game_control_edit_update']);
        Route::get('/admin/games/upload', [AdminController::class, 'game_upload']);
        Route::post('/admin/games/upload', [AdminController::class, 'game_upload_create']);
    });
});