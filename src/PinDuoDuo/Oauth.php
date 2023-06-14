<?php

namespace EasyTK\PinDuoDuo;

class Oauth
{
    private string $ddkCodeUrl = 'http://jinbao.pinduoduo.com/open.html';
    private string $sellerCodeUrl = 'http://mms.pinduoduo.com/open.html';
    private string $tokenUrl = 'http://open-api.pinduoduo.com/oauth/token';

    private $clientId;

    private $redirectUri;

    public function __construct($config)
    {
        $this->clientId = $config['client_id'];
        $this->redirectUri = $config['redirect_uri'];
    }

    public function getCode($type = null)
    {
        if ($type === 'ddk') {
            $url = $this->ddkCodeUrl . '?response_type=code&client_id=' . $this->clientId . '&redirect_uri=' . $this->redirectUri;
        } else {
            $url = $this->sellerCodeUrl . '?response_type=code&client_id=' . $this->clientId . '&redirect_uri=' . $this->redirectUri;
        }
        header('Location: ' . $url);
        exit();
    }

    public function getToken($code)
    {
        $url = $this->tokenUrl;

        // ...
    }
}