<?php

namespace EasyTK\JingDong;

interface RequestInterface
{
    public function getMethod();

    public function getParamJson();
}