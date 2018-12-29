<?php
namespace app\index\controller;

//use Soap;
use think\Log;
use think\Config;

class Index
{
    public function index()
    {
        return "OK";
    }


    public function hello($name = 'ThinkPHP5')
    {
        //$server = new \Soap\server();
        return  $name; //$server->getPlans('11', '22');
    }
}
