<?php
declare(strict_types=1);

namespace ModuleWechat\Common;

use ModuleWechat\Common\Config\ConfigUtil;
use ModuleWechat\Common\Config\Request;

/**
 * 基础类
 * @property $mp
 * @property $miniprogram
*/
class Server
{
    public ConfigUtil $config;
    public Request $http;
    public function __construct(string $appid = '', string $secret = '')
    {
        $this->config = new ConfigUtil($appid, $secret);
        $this->http = new Request();
    }

    /**
     * 获取接口调用凭据
     * @return array
     */
    public function getAccessToken()
    {
        return $this->http->request('cgi-bin/token',[
            'grant_type' => 'client_credential',
            'appid' => $this->config->getAppid(),
            'secret' => $this->config->getSecret()
        ]);
    }

    /**
     * 获取sdk临时票据
     * @param $access_token
     * @return array
     */
    public function getTicket($access_token)
    {
        return $this->http->request('cgi-bin/ticket/getticket',[
            'access_token' => $access_token,
            'type' => 'jsapi'
        ]);
    }
}