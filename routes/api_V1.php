<?php

use App\Http\Controllers\Api\V1\NotepadController;
use App\Http\Controllers\Api\V1\ShoppingListController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->group(function () {
    Route::apiResource('notepad', NotepadController::class);

    Route::prefix('shoppinglists')->name('shoppinglists.')->group(function () {
        Route::get('/{shoppinglist}/toggle', [ShoppingListController::class, 'toggle'])->name('toggle');
    });
    Route::apiResource('shoppinglists', ShoppingListController::class);
});
