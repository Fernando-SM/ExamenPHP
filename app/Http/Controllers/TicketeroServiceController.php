<?php

namespace App\Http\Controllers;

use App\Services\TicketeroService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TicketeroServiceController extends Controller
{

    protected $ticketeroService;

    public function __construct(TicketeroService $ticketeroService)
    {
        $this->ticketeroService = $ticketeroService;
    }

    public function autocomplete(Request $request)
    {
        $query = $request->input('q'); // Obtener el término de búsqueda desde la solicitud
        $limit = $request->input('limit', 10); // Obtener el valor del límite desde la solicitud (10 es un valor predeterminado si no se proporciona)

        // Llama al método del servicio para buscar autocompletado
        $response = $this->ticketeroService->autocomplete($query, $limit);

        // Registra un mensaje de log con la respuesta obtenida
        Log::info('Respuesta de la búsqueda autocomplete:');
        Log::info(json_encode($response));

        // Retorna la respuesta de la API
        return response()->json($response);
    }

    public function searchEventsByVenue(Request $request)
    {
        $venueQuery = $request->input('q'); // Obtener el término de búsqueda desde la solicitud
        $limit = $request->input('limit', 10); // Obtener el valor del límite desde la solicitud (10 es un valor predeterminado si no se proporciona)

        // Llama al método del servicio para buscar eventos por lugar (Venue)
        $response = $this->ticketeroService->searchEventsByVenue($venueQuery, $limit);

        // Registra un mensaje de log con la respuesta obtenida
        Log::info('Respuesta de la búsqueda de eventos por lugar (Venue):');
        Log::info(json_encode($response));

        // Retorna la respuesta de la API
        return response()->json($response);
    }

    public function searchEventsByPerformer(Request $request)
    {
        // Obtén el valor de performerId de la solicitud
        $performerId = $request->input('performerId');

        // Llama al método del servicio para buscar eventos por intérprete (Performer)
        $response = $this->ticketeroService->searchEventsByPerformer($performerId);

        // Registra un mensaje de log con la respuesta obtenida
        Log::info('Respuesta de la búsqueda de eventos por intérprete (Performer):');
        Log::info(json_encode($response));

        // Retorna la respuesta de la API
        return response()->json($response);
    }

    public function searchEventsByDestination(Request $request)
    {
        // Obtiene el contenido JSON del cuerpo de la solicitud
        $requestData = json_decode($request->getContent(), true);

        // Extrae los valores de latitude, longitude, radius y city de destination
        $latitude = $requestData['destination']['latitude'];
        $longitude = $requestData['destination']['longitude'];
        $radius = $requestData['destination']['radius'];
        $city = $requestData['destination']['city'];
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        // Llama al método del servicio para buscar eventos por destino
        $response = $this->ticketeroService->searchEventsByDestination($startDate, $endDate, $latitude, $longitude, $radius, $city);

        // Registra un mensaje de log con la respuesta obtenida
        Log::info('Respuesta de la búsqueda de eventos por destino (Destination):');
        Log::info(json_encode($response));

        // Retorna la respuesta de la API
        return response()->json($response);
    }

}
