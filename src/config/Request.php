<?php

namespace ModuleWechat\Common\Config;

use GuzzleHttp\Client;

class Request
{
    private $client = null;

    public function __construct()
    {
        if (is_null($this->client)) {
            $this->client = new Client([
                'base_uri' => 'https://api.weixin.qq.com'
            ]);
        }
        return $this->client;
    }

    public function request($uri,$data = [],$method = 'get')
    {
        $params = ['json' => $data];
        $result = $this->client->request($method, $uri, $params);
        return json_decode($result->getBody()->getContents(), true);
    }
}