<?php

namespace EasyTK\PinDuoDuo;

class Application
{
    private static Application $instance;

    private string $gatewayUrl = 'https://gw-api.pinduoduo.com/api/router';

    public string $clientId;

    public string $clientSecret;

    public int $readTimeout = 3;

    public int $connectTimeout = 3;

    public string $format = "JSON";

    public function __construct($client_id = "", $client_secret = "")
    {
        $this->clientId = $client_id;
        $this->clientSecret = $client_secret;
    }

    /**
     * 生成加密签名
     */
    public function generateSign($params): string
    {
        ksort($params);
        $str = $this->clientSecret;
        foreach ($params as $paramKey => $param) {
            $str .= $paramKey . $param;
        }
        $str .= $this->clientSecret;
        return strtoupper(md5($str));
    }

    /**
     * post请求
     */
    public function curl_post($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FAILONERROR, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($this->readTimeout) {
            curl_setopt($ch, CURLOPT_TIMEOUT, $this->readTimeout);
        }
        if ($this->connectTimeout) {
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->connectTimeout);
        }
        // https 请求
        if (strlen($url) > 5 && stripos($url, "https") === 0) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }

        curl_setopt($ch, CURLOPT_POST, true);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new \RuntimeException(curl_error($ch), 0);
        }

        $httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        return $response;
    }

    /**
     * 执行
     */
    public function execute($request, $access_token = '')
    {
        $baseParams = [
            'client_id' => $this->clientId,
            'access_token' => $access_token,
            'data_type' => $this->format,
            'timestamp' => time(),
            'version' => '',
        ];
        $apiParams = $request->getParams();
        $params = array_merge($apiParams, $baseParams);
        $params['sign'] = $this->generateSign($params);
        $requestUrl = $this->gatewayUrl . "?";
        foreach ($params as $paramKey => $param) {
            $requestUrl .= "$paramKey=" . urlencode($param) . '&';
        }
        $requestUrl = substr($requestUrl, 0, -1);
        $resp = $this->curl_post($requestUrl);

        return json_decode($resp, true, 512, JSON_THROW_ON_ERROR);
    }

    public function oauth($config = []): Oauth
    {
        return new Oauth($config);
    }

    /**
     * 单例获取当前对象
     */
    public static function getInstance(): Application
    {
        if (! isset(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    /**
     * 魔术方法 调用不存在的静态方法时触发
     */
    public static function __callStatic($name, $arguments)
    {
        return self::getInstance()->$name($arguments);
    }
}