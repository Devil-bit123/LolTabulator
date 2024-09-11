<?php

use App\Http\Controllers\PlayerController;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('players')->group(function () {
    // Obtener la lista de empleados
    Route::get('/', [PlayerController::class, 'index']);

    Route::post('/', [PlayerController::class, 'store']);


});
