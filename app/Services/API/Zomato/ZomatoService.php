<?php


namespace App\Services\API\Zomato;


use App\Http\Client\ZomatoClient;
use App\Http\Requests\Zomato\Common\CityRequest;
use App\Http\Requests\Zomato\Common\CollectionRequest;
use App\Http\Requests\Zomato\Common\CuisinesRequest;
use App\Http\Requests\Zomato\Common\EstablishmentsRequest;
use App\Http\Requests\Zomato\Common\GeocodeRequest;
use App\Http\Requests\Zomato\Restaurant\DaillyMenuRequest;
use App\Http\Requests\Zomato\Restaurant\RestaurantRequest;
use App\Http\Requests\Zomato\Restaurant\ReviewRequest;
use App\Http\Requests\Zomato\Restaurant\SearchRequest;
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

    /**
     * Get daily menu using Zomato restaurant ID.
     *
     * @param DaillyMenuRequest $daillyMenuRequest
     * @return array
     */
    public function dailyMenu(DaillyMenuRequest $daillyMenuRequest)
    {
        try {
            $response = $this->zomatoClient->request("daily_menu", [
                'res_id' => $daillyMenuRequest->get('res_id')
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
     * Get detailed restaurant information using Zomato restaurant ID. Partner Access is required to access
     * photos and reviews.
     *
     * @param RestaurantRequest $restaurantRequest
     * @return array
     */
    public function restaurant(RestaurantRequest $restaurantRequest)
    {
        try {
            $response = $this->zomatoClient->request("restaurant", [
                'res_id' => $restaurantRequest->get('res_id')
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
     * Get restaurant reviews using the Zomato restaurant ID. Only 5 latest reviews are available under
     * the Basic API plan.
     *
     * @param ReviewRequest $reviewRequest
     * @return array
     */
    public function reviews(ReviewRequest $reviewRequest)
    {
        try {
            $response = $this->zomatoClient->request("reviews", [
                'res_id' => $reviewRequest->get('res_id'),
                'start' => $reviewRequest->get('start'),
                'count' => $reviewRequest->get('count')
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
     * The location input can be specified using Zomato location ID or coordinates. Cuisine / Establishment /
     * Collection IDs can be obtained from respective api calls. Get up to 100 restaurants by changing the 'start' and
     * 'count' parameters with the maximum value of count being 20. Partner Access is required to access photos and reviews.
     *
     * Examples:

     * To search for 'Italian' restaurants in 'Manhattan, New York City', set cuisines = 55, entity_id = 94741 and entity_type = zone
     * To search for 'cafes' in 'Manhattan, New York City', set establishment_type = 1, entity_type = zone and entity_id = 94741
     * Get list of all restaurants in 'Trending this Week' collection in 'New York City' by using entity_id = 280, entity_type = city and collection_id = 1
     *
     * @param SearchRequest $searchRequest
     * @return array
     */
    public function search(SearchRequest $searchRequest)
    {
        try {
            $response = $this->zomatoClient->request("search", [
                'entity_id' => $searchRequest->get('entity_id'),
                'entity_type' => $searchRequest->get('entity_type'),
                'q' => $searchRequest->get('q'),
                'start' => $searchRequest->get('start'),
                'count' => $searchRequest->get('count'),
                'lat' => $searchRequest->get('lat'),
                'lon' => $searchRequest->get('lon'),
                'radius' => $searchRequest->get('radius'),
                'cuisines' => $searchRequest->get('cuisines'),
                'establishment_type' => $searchRequest->get('establishment_type'),
                'collection_id' => $searchRequest->get('collection_id'),
                'category' => $searchRequest->get('category'),
                'sort' => $searchRequest->get('sort'),
                'order' => $searchRequest->get('order')]);


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