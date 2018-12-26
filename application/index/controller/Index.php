<?php
namespace app\index\controller;

use Soap;
use think\Log;
use think\Config;

class Index
{
    public function index()
    {
          $classname = 'getPlans1';
          getWSDL('soap', $classname, 'getPlans1');

          $server = new \SoapServer('getPlans1.wsdl', array('soap_version' => SOAP_1_2));
          ##此处的Service.wsdl文件是上面生成的

          //  $server = new \SoapServer(null, array("location"=>"http://localhost/soap/server.php", 'uri'=>'server.php'));
          $server->setClass("getPlans1"); //注册Service类的所有方法
          try {
              $server->handle();
			  
          } catch (Exception $e) {
              $server->fault('Sender', $e->getMessage());
          }
		
        
    }


    public function hello($name = 'ThinkPHP5')
    {
        //$server = new \Soap\server();
        return  $name; //$server->getPlans('11', '22');
    }
}
