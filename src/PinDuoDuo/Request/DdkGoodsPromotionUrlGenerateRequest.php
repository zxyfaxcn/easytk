<?php

namespace EasyTK\PinDuoDuo\Request;

use EasyTK\PinDuoDuo\RequestInterface;

/**
 * 接口文档：https://open.pinduoduo.com/application/document/api?id=pdd.ddk.goods.promotion.url.generate
 */
class DdkGoodsPromotionUrlGenerateRequest implements RequestInterface
{
    /**
     * 生成普通商品推广链接
     * @var string
     */
    private $type = 'pdd.ddk.goods.promotion.url.generate';

    /**
     * 推广位ID
     * @var
     */
    private $pid;

    /**
     * 商品goodsSign列表，例如：["c9r2omogKFFAc7WBwvbZU1ikIb16_J3CTa8HNN"]，支持批量生链。goodsSign是加密后的goodsId
     * @var
     */
    private $goodsSignList;

    /**
     * 是否生成短链接，true-是，false-否
     * @var
     */
    private $generateShortUrl;

    /**
     * true--生成多人团推广链接 false--生成单人团推广链接（默认false）1、单人团推广链接：用户访问单人团推广链接，可直接购买商品无需拼团。2、多人团推广链接：用户访问双人团推广链接开团，若用户分享给他人参团，则开团者和参团者的佣金均结算给推手
     * @var
     */
    private $multiGroup;

    /**
     * 自定义参数，为链接打上自定义标签。自定义参数最长限制64个字节。
     * @var
     */
    private $customParameters;

    /**
     * 是否开启订单拉新，true表示开启（订单拉新奖励特权仅支持白名单，请联系工作人员开通）
     * @var
     */
    private $pullNew;

    /**
     * 是否生成唤起微信客户端链接，true-是，false-否，默认false
     * @var
     */
    private $generateWeappWebview;

    /**
     * 招商多多客ID
     * @var
     */
    private $zsduoId;

    /**
     * 是否生成小程序推广
     * @var
     */
    private $generateWeApp;


    public function setPid($pid)
    {
        $this->pid = $pid;
    }

    public function getPid()
    {
        return $this->pid;
    }

    public function setGoodsSignList($goodsSignList)
    {
        $this->goodsSignList = $goodsSignList;
    }

    public function getGoodsSignList()
    {
        return $this->goodsSignList;
    }

    public function setGenerateShortUrl($generateShortUrl)
    {
        $this->generateShortUrl = $generateShortUrl;
    }

    public function getGenerateShortUrl()
    {
        return $this->generateShortUrl;
    }

    public function setMultiGroup($multiGroup)
    {
        $this->multiGroup = $multiGroup;
    }

    public function getMultiGroup()
    {
        return $this->multiGroup;
    }

    public function setCustomParameters($customParameters)
    {
        $this->customParameters = $customParameters;
    }

    public function getCustomParameters()
    {
        return $this->customParameters;
    }

    public function setPullNew($pullNew)
    {
        $this->pullNew = $pullNew;
    }

    public function getPullNew()
    {
        return $this->pullNew;
    }

    public function setGenerateWeappWebview($generateWeappWebview)
    {
        $this->generateWeappWebview = $generateWeappWebview;
    }

    public function getGenerateWeappWebview()
    {
        return $this->generateWeappWebview;
    }

    public function setZsduoId($zsduoId)
    {
        $this->zsduoId = $zsduoId;
    }

    public function getZsduoId()
    {
        return $this->zsduoId;
    }

    public function setGenerateWeApp($generateWeApp)
    {
        $this->generateWeApp = $generateWeApp;
    }

    public function getGenerateWeApp()
    {
        return $this->generateWeApp;
    }

    public function getParams()
    {
        $params = [
            'type' => $this->type,
            'p_id' => $this->pid,
            'goods_sign_list' => $this->goodsSignList,
            'generate_short_url' => $this->generateShortUrl,
            'multi_group' => $this->multiGroup,
            'custom_parameters' => $this->customParameters,
            'pull_new' => $this->pullNew,
            'generate_weapp_webview' => $this->generateWeappWebview,
            'zs_duo_id' => $this->zsduoId,
            'generate_we_app' => $this->generateWeApp,
            'generate_schema_url' => "true"
        ];
        $params = array_filter($params);
        return $params;
    }
}
