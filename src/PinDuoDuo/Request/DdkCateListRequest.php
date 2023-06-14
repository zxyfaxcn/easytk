<?php

namespace EasyTK\PinDuoDuo\Request;

use EasyTK\PinDuoDuo\RequestInterface;

class DdkCateListRequest implements RequestInterface
{
    /**
     * 获得拼多多商品标签列表
     */
    private string $type = 'pdd.goods.opt.get';

    /**
     * 值=0时为顶点opt_id,通过树顶级节点获取opt树
     */
    private string $parent_opt_id = '0';

    public function setParentOptId($parent_opt_id)
    {
        $this->parent_opt_id = $parent_opt_id;
    }

    public function getParentOptId()
    {
        return $this->parent_opt_id;
    }

    public function getParams()
    {
        $params = [
            'type' => $this->type,
            'parent_opt_id' => $this->parent_opt_id
        ];
        return $params;
    }
}
