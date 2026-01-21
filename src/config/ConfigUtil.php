<?php
declare(strict_types=1);

namespace ModuleWechat\Common\Config;

class ConfigUtil
{
    private string $appid;
    private string $secret;

    public function __construct()
    {
        $this->appid = getenv('WECHAT_APPID');
        $this->secret = getenv('WECHAT_SECRET');
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