<?php


namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Http\Requests\Zomato\Common\CityRequest;
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
}