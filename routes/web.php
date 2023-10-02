<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\GuestbookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\NotepadController;
use App\Http\Controllers\ShoppingListController;
use Illuminate\Support\Facades\Route;
use Spatie\Honeypot\ProtectAgainstSpam;

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

Auth::routes(['register' => env('AUTH_REGISTER', false), 'verify' => env('AUTH_VERIFY', false)]);

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('guestbook')->name('guestbook.')->group(function () {
	Route::post('/', [GuestbookController::class, 'store'])->name('store')->middleware(ProtectAgainstSpam::class);
});
Route::resource('guestbook', GuestbookController::class)->except(['store']);

Route::prefix('articles')->name('articles.')->group(function () {
	Route::get('/user', [ArticleController::class, 'index_user'])->name('user');
});
Route::resource('articles', ArticleController::class);

Route::prefix('invitations')->name('invitations.')->group(function () {
	Route::post('/register/{invitation}/{hash}', [InvitationController::class, 'register'])->name('register');
	Route::get('/{invitation}/resend', [InvitationController::class, 'resend'])->name('resend');
	Route::get('/{invitation}/{hash}', [InvitationController::class, 'show'])->name('show');
});
Route::resource('invitations', InvitationController::class)->only(['index', 'create', 'store', 'destroy']);

Route::resource('notepad', NotepadController::class)->only(['index', 'store', 'update']);

Route::resource('shoppinglist', ShoppingListController::class)->only(['index']);


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

Route::get('loto', function (Illuminate\Http\Request $request) {
	$range = range(1, 36);
	$result = \App\Models\Loto::generate($range, 6, []);
	
	$loto = new \App\Models\Loto;
	$loto->result = $result;
	$loto->user()->associate($request->user());
	$loto->save();

	return \App\Models\Loto::all();
})->name('loto');

Route::get('test', function (Illuminate\Http\Request $request) {
	return view('test');
})->name('test');

Route::get('/hash/{q?}', function (Illuminate\Http\Request $request) {
	$text = $request->q ?: Illuminate\Support\Str::random(8);
	$hashes = collect([]);
	for ($i=0; $i < 5; $i++) { 
		$hash = Illuminate\Support\Facades\Hash::make($text);
		$hashes->push($hash);
	}
	return view('hash')->with(['text' => $text, 'hashes' => $hashes]);
})->name('hash');
