<?php

namespace app\webserver\controller;

use think\Controller;

use Soap;
use think\Log;
use think\Config;

class Index extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $server = new \Soap\nuserver();
        $config=config('soapserver.complexTypes');
        $server->setRegisters(config('soapserver.registers'));
        $server->setComplexTypes($config);
        $host = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $server->init($host);
    }
}
