<?php
declare(strict_types=1);

namespace ModuleWechat\Common\Config;

class ConfigUtil
{
    private string $appid;
    private string $secret;

    public function __construct(string $appid = '', string $secret = '')
    {
        $envAppid = getenv('WECHAT_APPID');
        $envSecret = getenv('WECHAT_APPID');
        if ($envAppid && $envSecret) {
            $appid = $envAppid;
            $secret = $envSecret;
        }
        $this->appid = $appid;
        $this->secret = $secret;
    }

    /**
     * WeChat appid
     * @return string
     */
    public function getAppid()
    {
        return $this->appid;
    }

    /**
     * WeChat secret
     * @return string
     */
    public function getSecret()
    {
        return $this->secret;
    }
}