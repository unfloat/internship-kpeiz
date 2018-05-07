<?php

namespace App\Youtube;

use GuzzleHttp\Client;

class Api
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'https://www.googleapis.com/']);
    }

    public static function __callStatic($name, $arguments)
    {
        if ('get' == $name) {
            return call_user_func_array([new Api(), 'request'], $arguments);
        }

        // if ('post' == $name) {
        //     return call_user_func_array([new \Api(), 'get'], $arguments);
        // }
    }

    private function request($call, $params = [], $headers = [])
    {
        //  dd($this->buildUri($call, $params));

        try {
            return json_decode($this->client->get($this->buildUri($call, $params))->getBody()->getContents());
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    private function buildUri($call, $params)
    {
        $params['key'] = env('API_KEY');
        return '/youtube/v3/' . $call . '?' . http_build_query($params);
    }
}
