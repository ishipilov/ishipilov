<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HomeController;
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
	Route::get('/user', [ArticleController::class, 'user_articles'])->name('user_articles');
});
Route::resource('articles', ArticleController::class);

Route::resource('notepad', NotepadController::class)->only(['index','store','update']);

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
