<?php

use App\Http\Controllers\TicketeroController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


// Ruta para autocomplete
Route::get('/autocomplete', [TicketeroController::class, 'autocomplete']);

// Ruta para búsqueda de eventos por venue
Route::get('/events/venue', [TicketeroController::class, 'searchEventsByVenue']);

// Ruta para búsqueda de eventos por performer
Route::get('/events/performer', [TicketeroController::class, 'searchEventsByPerformer']);

// Ruta para búsqueda de eventos por destino
Route::get('/events/destination', [TicketeroController::class, 'searchEventsByDestination']);


Route::get('/test-ticketero', function(App\Services\TicketeroService $service) {
    return $service->autocomplete('query');
});
