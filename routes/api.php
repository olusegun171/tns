<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactNoteController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources([
    'companies' => CompanyController::class,
    'contacts' => ContactController::class,
    'notes' => ContactNoteController::class,
    ]);
Route::post('/contacts/search', [ContactController::class, 'search']);
Route::get('/companies/{id}/contacts', [CompanyController::class, 'contacts']);
