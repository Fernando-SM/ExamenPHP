<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Http;

class TicketeroService
{
    protected $client;

    /**
     * TicketeroService constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client; // Inyecta el cliente HTTP configurado
    }

    /**
     * Ejemplo de un método para realizar una petición GET a la API.
     *
     * @param string $endpoint El endpoint de la API.
     * @param array $queryParams Parámetros de consulta para la petición.
     * @return array|mixed Respuesta de la API o datos vacíos en caso de error.
     */
    public function getRequest(string $endpoint, array $queryParams = [])
    {
        try {
            $response = $this->client->request('GET', $endpoint, ['query' => $queryParams]);
            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            // Aquí deberías manejar la excepción según sea necesario
            // Por ejemplo, podrías registrar el error o enviar una respuesta de error
            return [];
        }
    }


    public function autocomplete($query, $limit = 10)
    {
        // Modifica la URL completa de la API
        $url = 'https://sandbox.ticketero.co/api/v2/search/autocomplete';

        // Define el token de autenticación
        $token = 'Bearer ' . '14|ELCGEwTcPCH3ZfROWjKpFRinCswiZMFyssr1i6hb';

        // Realiza la solicitud a la API utilizando la URL completa y agrega el encabezado "Authorization"
        $response = Http::withHeaders([
            'Authorization' => $token, // Agrega el token de autenticación en el encabezado
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->get($url, [
            'q' => $query,
            'limit' => $limit,
        ]);

        // Regresa la respuesta de la API
        return $response->json();
    }

    public function searchEventsByVenue($venueQuery, $limit = 10)
    {
        // Modifica la URL completa de la API
        $url = 'https://sandbox.ticketero.co/api/v2/venues/suggest';

        // Define el token de autenticación
        $token = 'Bearer ' . '14|ELCGEwTcPCH3ZfROWjKpFRinCswiZMFyssr1i6hb';

        // Realiza la solicitud a la API utilizando la URL completa y agrega el encabezado "Authorization"
        $response = Http::withHeaders([
            'Authorization' => $token, // Agrega el token de autenticación en el encabezado
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->get($url, [
            'q' => $venueQuery,
            'limit' => $limit,
        ]);

        // Regresa la respuesta de la API
        return $response->json();
    }

    public function searchEventsByPerformer($performerId)
    {
        // Modifica la URL completa de la API
        $url = 'https://sandbox.ticketero.co/api/v2/search/events';

        // Define el token de autenticación
        $token = 'Bearer ' . '14|ELCGEwTcPCH3ZfROWjKpFRinCswiZMFyssr1i6hb';

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

        // Regresa la respuesta de la API
        return $response->json();
    }

    public function searchEventsByDestination($startDate, $endDate, $latitude, $longitude, $radius, $city)
    {
        // Modifica la URL completa de la API
        $url = 'https://sandbox.ticketero.co/api/v2/search/events';

        // Define el token de autenticación
        $token = 'Bearer ' . '14|ELCGEwTcPCH3ZfROWjKpFRinCswiZMFyssr1i6hb';

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

        // Regresa la respuesta de la API
        return $response->json();
    }



}
