<?php


namespace App\Http\Client;


use GuzzleHttp\Client;

class ZomatoClient
{
    private $client;
    private $baseUrl;
    private $userKey;


    public function __construct(Client $client)
    {
        $this->client = $client;

        if (env("APP_ENV") == "local") {
            $this->baseUrl = env("ZOMATO_BASE_URL", "https://developers.zomato.com/api/v2.1");
            $this->userKey = env("ZOMATO_USER_KEY", "2e00c9026a768f5be0f299d29ebd3601");
        } elseif (env("APP_ENV") == "develop") {
            $this->baseUrl = env("ZOMATO_BASE_URL", "https://developers.zomato.com/api/v2.1");
            $this->userKey = env("ZOMATO_USER_KEY", "2e00c9026a768f5be0f299d29ebd3601");
        } else {
            $this->baseUrl = env("ZOMATO_BASE_URL", "https://developers.zomato.com/api/v2.1");
            $this->userKey = env("ZOMATO_USER_KEY", "2e00c9026a768f5be0f299d29ebd3601");
        }

    }

    public function request($endpoint, $params = [])
    {
        $response = $this->client->get(
            $this->baseUrl . "/" . $endpoint,
            [
                'query' => $params,
                'headers' => ['user-key' => $this->getUserKey()
                ]
            ]);

        return [
            'code' => json_decode($response->getStatusCode()),
            'data' => json_decode($response->getBody()->getContents()),
        ];
    }

    public function getCredential(): string
    {
        return $this->baseUrl;
    }

    public function getUserKey(): string
    {
        return $this->userKey;
    }
}