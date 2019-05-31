<?php


namespace App\Services\API\Zomato;


use App\Http\Client\ZomatoClient;
use App\Http\Requests\Zomato\Common\CityRequest;
use App\Http\Requests\Zomato\Common\CollectionRequest;
use App\Http\Requests\Zomato\Common\CuisinesRequest;
use App\Http\Requests\Zomato\Common\EstablishmentsRequest;
use App\Http\Requests\Zomato\Common\GeocodeRequest;
use App\Http\Requests\Zomato\Location\LocationDetailRequest;
use App\Http\Requests\Zomato\Location\LocationRequest;
use GuzzleHttp\Exception\TransferException;

class ZomatoService
{


    private $zomatoClient;

    public function __construct(ZomatoClient $client)
    {
        $this->zomatoClient = $client;

    }


    /**
     * Find the Zomato ID and other details for a city . You can obtain the Zomato City ID in one of the following ways:
     * 1. City Name in the Search Query - Returns list of cities matching the query
     * 2. Using coordinates - Identifies the city details based on the coordinates of any location inside a city
     *
     * @param CityRequest $cityRequest
     * @return array
     */
    public function cities(CityRequest $cityRequest)
    {
        try {
            $response = $this->zomatoClient->request("cities", [
                'q' => $cityRequest->get('q'),
                'city_ids' => $cityRequest->get('city_ids'),
                'count' => $cityRequest->get('count')
            ]);

            return [
                'code' => $response['code'],
                'data' => $response['data']
            ];


        } catch (TransferException $e) {
            $data = json_decode($e->getResponse()->getBody()->getContents());
            return [
                'code' => $e->getResponse()->getStatusCode(),
                'data' => $data
            ];
        }

    }

    /**
     * Get a list of categories. List of all restaurants categorized under a particular restaurant type can be obtained
     * using /Search API with Category ID as inputs
     *
     * @return array
     */
    public function categories()
    {
        try {
            $response = $this->zomatoClient->request("categories", []);
            return [
                'code' => $response['code'],
                'data' => $response['data']
            ];


        } catch (TransferException $e) {
            $data = json_decode($e->getResponse()->getBody()->getContents());
            return [
                'code' => $e->getResponse()->getStatusCode(),
                'data' => $data
            ];
        }

    }

    /**
     * Returns Zomato Restaurant Collections in a City. The location/City input can be provided in the following ways :

     * 1. Using Zomato City ID
     * 2. Using coordinates of any location within a city
     *
     * List of all restaurants listed in any particular Zomato Collection can be obtained using the '/search' API with
     * Collection ID and Zomato City ID as the input
     *
     * @param CollectionRequest $collectionRequest
     * @return array
     */
    public function collections(CollectionRequest $collectionRequest)
    {
        try {
            $response = $this->zomatoClient->request("collections", [
                'city_id' => $collectionRequest->get('city_id'),
                'lat' => $collectionRequest->get('lat'),
                'lon' => $collectionRequest->get('lon'),
                'count' => $collectionRequest->get('count')
            ]);

            return [
                'code' => $response['code'],
                'data' => $response['data']
            ];


        } catch (TransferException $e) {
            $data = json_decode($e->getResponse()->getBody()->getContents());
            return [
                'code' => $e->getResponse()->getStatusCode(),
                'data' => $data
            ];
        }

    }

    /**
     * Get a list of all cuisines of restaurants listed in a city. The location/city input can be provided in the
     * following ways :

     * 1. Using Zomato City ID
     * 2. Using coordinates of any location within a city
     *
     * @param CuisinesRequest $cuisinesRequest
     * @return array
     */
    public function cuisines(CuisinesRequest $cuisinesRequest)
    {
        try {
            $response = $this->zomatoClient->request("cuisines", [
                'city_id' => $cuisinesRequest->get('city_id'),
                'lat' => $cuisinesRequest->get('lat'),
                'lon' => $cuisinesRequest->get('lon')
            ]);

            return [
                'code' => $response['code'],
                'data' => $response['data']
            ];


        } catch (TransferException $e) {
            $data = json_decode($e->getResponse()->getBody()->getContents());
            return [
                'code' => $e->getResponse()->getStatusCode(),
                'data' => $data
            ];
        }

    }


    /**
     * Get a list of restaurant types in a city. The location/City input can be provided in the following ways:

     * 1. Using Zomato City ID
     * 2. Using coordinates of any location within a city
     *
     * List of all restaurants categorized under a particular restaurant type can obtained using /Search API with
     * Establishment ID and location details as inputs
     *
     * @param EstablishmentsRequest $establishmentsRequest
     * @return array
     */
    public function establishments(EstablishmentsRequest $establishmentsRequest)
    {
        try {
            $response = $this->zomatoClient->request("cuisines", [
                'city_id' => $establishmentsRequest->get('city_id'),
                'lat' => $establishmentsRequest->get('lat'),
                'lon' => $establishmentsRequest->get('lon')
            ]);

            return [
                'code' => $response['code'],
                'data' => $response['data']
            ];


        } catch (TransferException $e) {
            $data = json_decode($e->getResponse()->getBody()->getContents());
            return [
                'code' => $e->getResponse()->getStatusCode(),
                'data' => $data
            ];
        }

    }

    /**
     * Get Foodie and Nightlife Index, list of popular cuisines and nearby restaurants around the given coordinates
     *
     * @param GeocodeRequest $geocodeRequest
     * @return array
     */
    public function geoCode(GeocodeRequest $geocodeRequest)
    {
        try {
            $response = $this->zomatoClient->request("geocode", [
                'city_id' => $geocodeRequest->get('city_id'),
                'lat' => $geocodeRequest->get('lat'),
                'lon' => $geocodeRequest->get('lon')
            ]);

            return [
                'code' => $response['code'],
                'data' => $response['data']
            ];


        } catch (TransferException $e) {
            $data = json_decode($e->getResponse()->getBody()->getContents());
            return [
                'code' => $e->getResponse()->getStatusCode(),
                'data' => $data
            ];
        }

    }

    /**
     * Search for Zomato locations by keyword. Provide coordinates to get better search results
     *
     * @param LocationRequest $locationRequest
     * @return array
     */
    public function locations(LocationRequest $locationRequest)
    {
        try {
            $response = $this->zomatoClient->request("locations", [
                'query' => $locationRequest->get('query'),
                'lat' => $locationRequest->get('lat'),
                'lon' => $locationRequest->get('lon'),
                'count' => $locationRequest->get('count')
            ]);

            return [
                'code' => $response['code'],
                'data' => $response['data']
            ];


        } catch (TransferException $e) {
            $data = json_decode($e->getResponse()->getBody()->getContents());
            return [
                'code' => $e->getResponse()->getStatusCode(),
                'data' => $data
            ];
        }

    }

    /**
     * Get Foodie Index, Nightlife Index, Top Cuisines and Best rated restaurants in a given location
     *
     * @param LocationDetailRequest $locationDetailRequest
     * @return array
     */
    public function locationDetails(LocationDetailRequest $locationDetailRequest)
    {
        try {
            $response = $this->zomatoClient->request("location_details", [
                'entity_id' => $locationDetailRequest->get('entity_id'),
                'entity_type' => $locationDetailRequest->get('entity_type')
            ]);

            return [
                'code' => $response['code'],
                'data' => $response['data']
            ];


        } catch (TransferException $e) {
            $data = json_decode($e->getResponse()->getBody()->getContents());
            return [
                'code' => $e->getResponse()->getStatusCode(),
                'data' => $data
            ];
        }

    }
}