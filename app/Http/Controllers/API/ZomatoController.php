<?php


namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Http\Requests\Zomato\Common\CityRequest;
use App\Http\Requests\Zomato\Common\CollectionRequest;
use App\Http\Requests\Zomato\Common\CuisinesRequest;
use App\Http\Requests\Zomato\Common\EstablishmentsRequest;
use App\Http\Requests\Zomato\Common\GeocodeRequest;
use App\Http\Requests\Zomato\Location\LocationDetailRequest;
use App\Http\Requests\Zomato\Location\LocationRequest;
use App\Library\ApiBaseResponse;
use App\Services\API\Zomato\ZomatoService;
use Illuminate\Http\Response;
use Exception;

class ZomatoController extends Controller
{

    protected $zomatoService;
    protected $apiBaseResponse;

    public function __construct(ZomatoService $zomatoService, ApiBaseResponse $apiBaseResponse)
    {
        $this->zomatoService = $zomatoService;
        $this->apiBaseResponse = $apiBaseResponse;
    }

    public function getCities(CityRequest $cityRequest)
    {
        try {
            $result = $this->zomatoService->cities($cityRequest);

            if ($result['code'] == 200) {
                $response = $this->apiBaseResponse->singleData($result['data'], []);
            } else {
                $response = $this->apiBaseResponse->status(403, $result['data']->message, $result['data']);
            }
            return response($response);

        } catch (Exception $e) {
            $response = $this->apiBaseResponse->errorResponse($e);
            return response($response, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getCategories()
    {
        try {
            $result = $this->zomatoService->categories();

            if ($result['code'] == 200) {
                $response = $this->apiBaseResponse->singleData($result['data'], []);
            } else {
                $response = $this->apiBaseResponse->status(403, $result['data']->message, $result['data']);
            }
            return response($response);

        } catch (Exception $e) {
            $response = $this->apiBaseResponse->errorResponse($e);
            return response($response, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getCollections(CollectionRequest $collectionRequest)
    {
        try {
            $result = $this->zomatoService->collections($collectionRequest);

            if ($result['code'] == 200) {
                $response = $this->apiBaseResponse->singleData($result['data'], []);
            } else {
                $response = $this->apiBaseResponse->badRequest($result['data']->message);
            }
            return response($response);

        } catch (Exception $e) {
            $response = $this->apiBaseResponse->errorResponse($e);
            return response($response, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getCuisines(CuisinesRequest $cuisinesRequest)
    {
        try {
            $result = $this->zomatoService->cuisines($cuisinesRequest);

            if ($result['code'] == 200) {
                $response = $this->apiBaseResponse->singleData($result['data'], []);
            } else {
                $response = $this->apiBaseResponse->badRequest($result['data']->message);
            }
            return response($response);

        } catch (Exception $e) {
            $response = $this->apiBaseResponse->errorResponse($e);
            return response($response, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getEstablishments(EstablishmentsRequest $establishmentsRequest)
    {
        try {
            $result = $this->zomatoService->establishments($establishmentsRequest);

            if ($result['code'] == 200) {
                $response = $this->apiBaseResponse->singleData($result['data'], []);
            } else {
                $response = $this->apiBaseResponse->badRequest($result['data']->message);
            }
            return response($response);

        } catch (Exception $e) {
            $response = $this->apiBaseResponse->errorResponse($e);
            return response($response, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getGeoCode(GeocodeRequest $geocodeRequest)
    {
        try {
            $result = $this->zomatoService->geoCode($geocodeRequest);

            if ($result['code'] == 200) {
                $response = $this->apiBaseResponse->singleData($result['data'], []);
            } else {
                $response = $this->apiBaseResponse->badRequest("Data not found");

            }
            return response($response);

        } catch (Exception $e) {
            $response = $this->apiBaseResponse->errorResponse($e);
            return response($response, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getLocations(LocationRequest $locationRequest)
    {
        try {
            $result = $this->zomatoService->locations($locationRequest);

            if ($result['code'] == 200) {
                $response = $this->apiBaseResponse->singleData($result['data'], []);
            } else {
                $response = $this->apiBaseResponse->status(403, $result['data']->message, $result['data']);
            }
            return response($response);

        } catch (Exception $e) {
            $response = $this->apiBaseResponse->errorResponse($e);
            return response($response, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function getLocationDetails(LocationDetailRequest $locationDetailRequest)
    {
        try {
            $result = $this->zomatoService->locationDetails($locationDetailRequest);

            if ($result['code'] == 200) {
                $response = $this->apiBaseResponse->singleData($result['data'], []);
            } else {
                $response = $this->apiBaseResponse->status(403, $result['data']->message, $result['data']);
            }
            return response($response);

        } catch (Exception $e) {
            $response = $this->apiBaseResponse->errorResponse($e);
            return response($response, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}