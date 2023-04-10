<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\NotepadController;
use Illuminate\Support\Facades\Route;

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

Route::view('/', 'welcome')->name('welcome');
Route::redirect('/', '/home');

Auth::routes(['register' => env('AUTH_REGISTER', false), 'verify' => env('AUTH_VERIFY', false)]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('articles')->name('articles.')->group(function () {
	Route::get('/user', [ArticleController::class, 'index_user'])->name('user');
});
Route::resource('articles', ArticleController::class);

Route::prefix('invitations')->name('invitations.')->group(function () {
	Route::post('/register/{invitation}/{hash}', [InvitationController::class, 'register'])->name('register');
	Route::get('/{invitation}/{hash}', [InvitationController::class, 'show'])->name('show');
});
Route::resource('invitations', InvitationController::class)->only(['index', 'create', 'store']);

Route::resource('notepad', NotepadController::class)->only(['index', 'store', 'update']);

/**
 * ADMIN
 */

Route::prefix('admin')->name('admin.')->group(function () {
	Route::prefix('users')->name('users.')->group(function () {
		Route::get('login_as/{user}', [App\Http\Controllers\Admin\UserController::class, 'login_as'])->name('login_as');
	});
	Route::resource('users', App\Http\Controllers\Admin\UserController::class)->only(['index']);
});


/**
 * MISC
 */

Route::get('/hash/{q?}', function (Illuminate\Http\Request $request) {
	$text = $request->q ?: Illuminate\Support\Str::random(8);
	$hashes = collect([]);
	for ($i=0; $i < 5; $i++) { 
		$hash = Illuminate\Support\Facades\Hash::make($text);
		$hashes->push($hash);
	}
	return view('hash')->with(['text' => $text, 'hashes' => $hashes]);
})->name('hash');
