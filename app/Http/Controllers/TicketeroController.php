<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TicketeroController extends Controller
{
    public function autocomplete(Request $request)
    {
        $query = $request->input('q'); // Obtener el término de búsqueda desde la solicitud
        $limit = $request->input('limit', 10); // Obtener el valor del límite desde la solicitud (10 es un valor predeterminado si no se proporciona)

        // Modifica la URL completa de la API
        $url = 'https://sandbox.ticketero.co/api/v2/search/autocomplete';

        // Define el token de autenticación
        $token = 'Bearer ' . '14|ELCGEwTcPCH3ZfROWjKpFRinCswiZMFyssr1i6hb'; // Asegúrate de que env('TICKETERO_API_TOKEN') contenga tu token real
        // Registra un mensaje de log para verificar que el método se está ejecutando
        Log::info('Método autocomplete se está ejecutando con los siguientes parámetros:');
        Log::info('Query: ' . $query);
        Log::info('Límite: ' . $limit);

        // Realiza la solicitud a la API utilizando la URL completa y agrega el encabezado "Authorization"
        $response = Http::withHeaders([
            'Authorization' => $token, // Agrega el token de autenticación en el encabezado
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->get($url, [
            'q' => $query,
            'limit' => $limit,
        ]);

        // Registra un mensaje de log con la respuesta obtenida
        Log::info('Respuesta de la búsqueda autocomplete:');
        Log::info($response->body());

        // Puedes retornar la respuesta tal como lo haces actualmente
        return response()->json($response->json());
    }

    public function searchEventsByVenue(Request $request)
    {
        $venueQuery = $request->input('q'); // Obtener el término de búsqueda desde la solicitud
        $limit = $request->input('limit', 10); // Obtener el valor del límite desde la solicitud (10 es un valor predeterminado si no se proporciona)

        // Modifica la URL completa de la API
        $url = 'https://sandbox.ticketero.co/api/v2/venues/suggest';

        // Define el token de autenticación
        $token = 'Bearer ' . '14|ELCGEwTcPCH3ZfROWjKpFRinCswiZMFyssr1i6hb';

        // Registra un mensaje de log para verificar que el método se está ejecutando
        Log::info('Método searchEventsByVenue se está ejecutando con los siguientes parámetros:');
        Log::info('Venue Query: ' . $venueQuery);
        Log::info('Límite: ' . $limit);

        // Realiza la solicitud a la API utilizando la URL completa y agrega el encabezado "Authorization"
        $response = Http::withHeaders([
            'Authorization' => $token, // Agrega el token de autenticación en el encabezado
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->get($url, [
            'q' => $venueQuery,
            'limit' => $limit,
        ]);

        // Registra un mensaje de log con la respuesta obtenida
        Log::info('Respuesta de la búsqueda de eventos por lugar (Venue):');
        Log::info($response->body());

        // Puedes retornar la respuesta tal como lo haces actualmente
        return response()->json($response->json());
    }

    public function searchEventsByPerformer(Request $request)
    {
        // Obtén el valor de performerId de la solicitud
        $performerId = $request->input('performerId');

        // Modifica la URL completa de la API
        $url = 'https://sandbox.ticketero.co/api/v2/search/events';

        // Define el token de autenticación
        $token = 'Bearer ' . '14|ELCGEwTcPCH3ZfROWjKpFRinCswiZMFyssr1i6hb';

        // Registra un mensaje de log para verificar que el método se está ejecutando
        Log::info('Método searchEventsByPerformer se está ejecutando con el siguiente parámetro:');
        Log::info('Performer ID: ' . $performerId);

        // Realiza la solicitud a la API utilizando la URL completa y agrega el encabezado "Authorization"
        $response = Http::withHeaders([
            'Authorization' => $token, // Agrega el token de autenticación en el encabezado
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->get($url, [
            'searchType' => 'performer',
            'performerId' => $performerId,
            'withPerformers' => false,
        ]);

        // Registra un mensaje de log con la respuesta obtenida
        Log::info('Respuesta de la búsqueda de eventos por intérprete (Performer):');
        Log::info($response->body());

        // Puedes retornar la respuesta tal como lo haces actualmente
        return response()->json($response->json());
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
        // Modifica la URL completa de la API
        $url = 'https://sandbox.ticketero.co/api/v2/search/events';

        // Define el token de autenticación
        $token = 'Bearer ' . '14|ELCGEwTcPCH3ZfROWjKpFRinCswiZMFyssr1i6hb';

        // Registra un mensaje de log para verificar que el método se está ejecutando
        Log::info('Método searchEventsByDestination se está ejecutando con los siguientes parámetros:');
        Log::info('Start Date: ' . $startDate);
        Log::info('End Date: ' . $endDate);
        Log::info('Latitude: ' . $latitude);
        Log::info('Longitude: ' . $longitude);
        Log::info('Radius: ' . $radius);
        Log::info('City: ' . $city);

        // Realiza la solicitud a la API utilizando la URL completa y agrega el encabezado "Authorization"
        $response = Http::withHeaders([
            'Authorization' => $token, // Agrega el token de autenticación en el encabezado
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->get($url, [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'destination' => [
                'latitude' => $latitude,
                'longitude' => $longitude,
                'radius' => $radius,
                'city' => $city,
            ],
            'searchType' => 'destination',
            'withPerformers' => false,
        ]);

        // Registra un mensaje de log con la respuesta obtenida
        Log::info('Respuesta de la búsqueda de eventos por destino (Destination):');
        Log::info($response->body());

        // Puedes retornar la respuesta tal como lo haces actualmente
        return response()->json($response->json());
    }



}
