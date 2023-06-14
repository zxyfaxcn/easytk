<?php

namespace EasyTK\PinDuoDuo\Request;

use EasyTK\PinDuoDuo\RequestInterface;

class DdkWeappQrcodeUrlGenRequest implements RequestInterface
{

    /**
     * 多多客生成单品推广小程序二维码url
     * @var string
     */
    private $type = 'pdd.ddk.weapp.qrcode.url.gen';

    /**
     * 推广位ID
     * @var
     */
    private $pid;

    /**
     * 商品ID
     * @var
     */
    private $goodsSignList;

    /**
     * 自定义参数，为链接打上自定义标签。自定义参数最长限制64个字节。
     * @var
     */
    private $customParameters;

    /**
     * 招商多多客ID
     * @var
     */
    private $zsduoId;


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

    public function setCustomParameters($customParameters)
    {
        $this->customParameters = $customParameters;
    }

    public function getCustomParameters()
    {
        return $this->customParameters;
    }

    public function setZsduoId($zsduoId)
    {
        $this->zsduoId = $zsduoId;
    }

    public function getZsduoId()
    {
        return $this->zsduoId;
    }

    public function getParams()
    {
        $params = [
            'type' => $this->type,
            'p_id' => $this->pid,
            'goods_sign_list' => $this->goodsSignList,
            'custom_parameters' => $this->customParameters,
            'zs_duo_id' => $this->zsduoId,
        ];
        return array_filter($params);
    }
}
