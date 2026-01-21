<?php

namespace ModuleWechat\Common\Helper;

interface MpOauthInterface
{
    public function getAuthUrl($redirect_uri, $scope = 'snsapi_base', $state = 'STATE');

    public function getOauthToken($code);

    public function getUserInfo($openid, $access_token);

    public function getJssdk($url, $ticket);
}