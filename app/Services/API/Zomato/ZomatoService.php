<?php


namespace App\Services\API\Zomato;


use App\Http\Client\ZomatoClient;
use App\Http\Requests\Zomato\Common\CityRequest;
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

}