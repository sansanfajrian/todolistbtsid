<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController; 
use App\Http\Controllers\ChecklistController; 
use App\Http\Controllers\ChecklistItemController;
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
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:api')->get('/user', function (Request $request) {
    Route::get('checklist', [ChecklistController::class, 'index']);
    Route::post('checklist', [ChecklistController::class, 'store']);
    Route::delete('checklist/{id}', [ChecklistController::class, 'destroy']);
    Route::get('checklist/{checklistId}/item', [ChecklistItemController::class, 'index']);
    Route::post('checklist/{checklistId}/item', [ChecklistItemController::class, 'store']);
    Route::get('checklist/{checklistId}/item/{itemId}', [ChecklistItemController::class, 'show']);
    Route::put('checklist/{checklistId}/item/{itemId}', [ChecklistItemController::class, 'updateStatus']);
    Route::delete('checklist/{checklistId}/item/{itemId}', [ChecklistItemController::class, 'destroy']);
    Route::put('checklist/{checklistId}/item/rename/{itemId}', [ChecklistItemController::class, 'rename']);
});

Route::get('/', function() {
    return response()->json(['message' => 'API is working'], 200);
});