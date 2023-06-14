<?php

require __DIR__ . '/../vendor/autoload.php';

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
