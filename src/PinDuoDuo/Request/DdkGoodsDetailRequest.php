<?php

namespace EasyTK\PinDuoDuo\Request;

use EasyTK\PinDuoDuo\RequestInterface;

class DdkGoodsDetailRequest implements RequestInterface
{
    /**
     * 查询多多进宝商品详情
     * @var string
     */
    private $type = 'pdd.ddk.goods.detail';

    /**
     * 商品ID
     * @var
     */
    private $goodsSign;

    public function setType($type)
    {
        $this->type = $type;
    }

    public function setGoodsSign($goodsSign)
    {
        $this->goodsSign = $goodsSign;
    }


    public function getType()
    {
        return $this->type;
    }

    public function getGoodsSign()
    {
        return $this->goodsSign;
    }

    public function getParams()
    {
        return [
            'type' => $this->type,
            'goods_sign' => $this->goodsSign,
        ];
    }
}