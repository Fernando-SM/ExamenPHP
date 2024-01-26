<?php

use App\Http\Controllers\TicketeroController;
use App\Http\Controllers\TicketeroServiceController;
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


Route::get('/autocomplete', [TicketeroController::class, 'autocomplete']);
Route::get('/events/venue', [TicketeroController::class, 'searchEventsByVenue']);
Route::get('/events/performer', [TicketeroController::class, 'searchEventsByPerformer']);
Route::get('/events/destination', [TicketeroController::class, 'searchEventsByDestination']);

Route::get('/autocomplete1', [TicketeroServiceController::class, 'autocomplete']);
Route::get('/events/venue1', [TicketeroServiceController::class, 'searchEventsByVenue']);
Route::get('/events/performer1', [TicketeroServiceController::class, 'searchEventsByPerformer']);
Route::get('/events/destination1', [TicketeroServiceController::class, 'searchEventsByDestination']);
