# 介绍

多多进宝、京东联盟SDK封装。

# 安装

1、安装扩展包

```bash
composer require zxyfaxcn/easytk
```

# 初始化SDK

每个平台SDK的具体调用方法参考各平台的文档

1、拼多多SDK初始化

```php
<?php
$client = \EasyTK\Factory::pinduoduo([
    'client_id' => 'PDD_CLIENT_ID',
    'client_secret' => 'PDD_CLIENT_SECRET',
    'format' => 'json'
]);
$req = new \EasyTK\PinDuoDuo\Request\DdkGoodsPromotionUrlGenerateRequest();
// GoodsSign https://jinbao.pinduoduo.com/qa-system?questionId=252
$pid = '37186626_266418764';
$goodsSign = ['c9_2jIGD8q9HeEqRwvfY5A2CBcK7_JOFdnZa6o'];
$customParams = [
    'uid' => '1',
    'foo' => 'bar',
];
$req->setGoodsSignList(json_encode($goodsSign, JSON_THROW_ON_ERROR));
$req->setPid($pid);
$req->setCustomParameters(json_encode($customParams, JSON_THROW_ON_ERROR));
$response = $client->execute($req);
```

2、京东SDK初始化

```php
<?php
$client = \EasyTK\Factory::jingdong([
    'app_key' => 'JD_APP_KEY',
    'app_secret' => 'JD_APP_SECRET',
    'format' => 'json'
]);
$request = new \EasyTK\JingDong\Request\JdUnionGoodsJingfenQueryRequest();
$request->setEliteId(1);
$request->setPageIndex(1);
$request->setPageSize(20);
print_r($client->execute($request));
```



