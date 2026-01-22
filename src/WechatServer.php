<?php
declare(strict_types=1);

namespace ModuleWechat\Common;

use ModuleWechat\Common\Config\ConfigUtil;
use ModuleWechat\Common\Config\Request;
use ModuleWechat\Common\helper\MiniprogramInterface;
use ModuleWechat\Common\Helper\MpOauthInterface;

/**
 * 基础类
 * @property MpOauthInterface $oauth
 * @property MiniprogramInterface $miniprogram
*/
class WechatServer
{
    public ConfigUtil $config;
    public Request $http;
    protected array $binds = [
        'oauth' => 'ModuleWechat\Oauth\WechatOauthServer',
        'miniprogram' => 'ModuleWechat\Miniprogram\WechatMiniProgramServer',
    ];
    protected array $instances = [
        'oauth' => null,
        'miniprogram' => null
    ];
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

    public function __get($name)
    {
        if (is_null($this->instances[$name])) {
            $this->instances[$name] = $this->config->make($this->binds[$name],[$this]);
        }
        return $this->instances[$name];
    }
}