<?php

namespace EasyTK;

use EasyTK\PinDuoDuo\Application as PinDuoDuo;
use EasyTK\JingDong\Application as JingDong;

/**
 * Class Factory.
 *
 * @method PinDuoDuo pinduoduo($config = [])
 * @method JingDong jingdong($config = [])
 */
class Factory
{
    /**
     * @var static 单例模式
     */
    private static Factory $instance;

    /**
     * Dynamically pass methods to the application.
     *
     * @param string $name
     * @param array $arguments
     *
     * @return mixed
     */
    public static function __callStatic(string $name, array $arguments)
    {
        return self::getInstance()->make($name, ...$arguments);
    }

    /**
     * 单例获取当前对象
     */
    public static function getInstance(): Factory
    {
        if (! isset(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    /**
     * 获取配置文件名字
     */
    public function getConfigName(): string
    {
        return "easytbk";
    }

    /**
     * @param $name
     * @param array $config
     * @return mixed
     */
    public function make($name, array $config = [])
    {
        if (! in_array($name, ['pinduoduo', 'jingdong',])) {
            throw  new \InvalidArgumentException('static method is not exists');
        }

        if (count($config) === 0) {
            if (! function_exists('config')) {
                throw new \InvalidArgumentException('The config requires api keys.');
            }
            $config = config("{$this->getConfigName ()}.{$name}", []);
        }
        $config = $this->getConfig($name, $config);

        return $this->getClient($name, $config);
    }


    /**
     * Get the configuration data.
     *
     * @param string[] $config
     *
     * @return string[]
     * @throws \InvalidArgumentException
     *
     */
    protected function getConfig(string $name, array $config)
    {
        if ($name === "pinduoduo") {
            if (! array_key_exists('client_id', $config) || ! array_key_exists('client_secret', $config)) {
                throw new \InvalidArgumentException('The pinduoduo client requires client_id and client_secret.');
            }
            return \EasyTK\array_only($config, ['client_id', 'client_secret', 'format']);
        }
        if ($name === "jingdong") {
            if (! array_key_exists('app_key', $config) || ! array_key_exists('app_secret', $config)) {
                throw new \InvalidArgumentException('The jingdong client requires app_key and app_secret.');
            }
            return \EasyTK\array_only($config, ['app_key', 'app_secret', 'format']);
        }
    }

    /**
     * Get the client.
     */
    protected function getClient(string $name, array $config)
    {
        if ($name === "pinduoduo") {
            $c = new PinDuoDuo();
            $c->clientId = $config['client_id'];
            $c->clientSecret = $config['client_secret'];
            $c->format = isset($config['format']) ? $config['format'] : 'json';
            return $c;
        }
        if ($name === "jingdong") {
            $c = new JingDong();
            $c->appKey = $config['app_key'];
            $c->appSecret = $config['app_secret'];
            $c->format = isset($config['format']) ? $config['format'] : 'json';
            return $c;
        }

        throw new \RuntimeException('不支持的类型');
    }
}
