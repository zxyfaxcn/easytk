<?php

namespace EasyTK\JingDong;

class Application
{
    private static Application $instance;

    private string $gatewayUrl = 'https://api.jd.com/routerjson';

    public string $appKey;

    public string $appSecret;

    public int $readTimeout = 3;

    public int $connectTimeout = 3;

    public string $format = "json";

    private string $signMethod = "md5";

    private string $v = "1.0";

    public function __construct($appKey = "", $appSecret = "")
    {
        $this->appKey = $appKey;
        $this->appSecret = $appSecret;
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

    /**
     * 执行
     */
    public function execute($request, $access_token = null)
    {
        $timestamp = date('Y-m-d H:i:s');

        $params = [
            'v' => $this->v,
            'method' => $request->getMethod(),
            'app_key' => $this->appKey,
            'sign_method' => $this->signMethod,
            'format' => $this->format,
            'timestamp' => $timestamp,
        ];
        if (null !== $access_token) {
            $params["access_token"] = $access_token;
        }

        $params['360buy_param_json'] = $request->getParamJson();;

        $params['sign'] = $this->generateSign($params);

        $requestUrl = $this->gatewayUrl . "?";
        foreach ($params as $k => $v) {
            $requestUrl .= "$k=" . urlencode($v) . '&';
        }

        $requestUrl = substr($requestUrl, 0, -1);

        $resp = $this->curl_post($requestUrl);

        return json_decode($resp, true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * 生成加密签名
     */
    public function generateSign($params): string
    {
        ksort($params);
        $stringToBeSigned = $this->appSecret;
        foreach ($params as $k => $v) {
            if (! is_array($v) && "@" !== substr($v, 0, 1)) {
                $stringToBeSigned .= "$k$v";
            }
        }
        unset($k, $v);
        $stringToBeSigned .= $this->appSecret;
        return strtoupper(md5($stringToBeSigned));
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
}
