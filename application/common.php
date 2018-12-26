<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------
// 应用公共文件
function trimall($str)
{
    if (is_array($str)) {
        return array_map('trimall', $str);
    }
    $qian=array(" ","　","\t","\n","\r");
    $hou=array("","","","","");
    return str_replace($qian, $hou, $str);
}

function getWSDL($service_name, $class_name, $wsdl_name)
{
    if (empty($service_name)) {
        throw new Exception('No service name.');
    }
    $headerWSDL = "<?xml version=\"1.0\" ?>\n";
    $headerWSDL.= "<definitions name=\"$service_name\" targetNamespace=\"urn:$service_name\" xmlns:wsdl=\"http://schemas.xmlsoap.org/wsdl/\" xmlns:soap=\"http://schemas.xmlsoap.org/wsdl/soap/\" xmlns:tns=\"urn:$service_name\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" xmlns:SOAP-ENC=\"http://schemas.xmlsoap.org/soap/encoding/\" xmlns=\"http://schemas.xmlsoap.org/wsdl/\">\n";
    $headerWSDL.= "<types xmlns=\"http://schemas.xmlsoap.org/wsdl/\" />\n";

    if (empty($class_name)) {
        throw new Exception('No class name.');
    }

    $class = new \ReflectionClass($class_name);

    if (!$class->isInstantiable()) {
        throw new Exception('Class is not instantiable.');
    }

    $methods = $class->getMethods();

    $portTypeWSDL = '<portType name="'.$service_name.'Port">';
    $bindingWSDL = '<binding name="'.$service_name.'Binding" type="tns:'.$service_name."Port\">\n<soap:binding style=\"rpc\" transport=\"http://schemas.xmlsoap.org/soap/http\" />\n";
    $serviceWSDL = '<service name="'.$service_name."\">\n<documentation />\n<port name=\"".$service_name.'Port" binding="tns:'.$service_name."Binding\"><soap:address location=\"http://".$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].$_SERVER['PHP_SELF']."\" />\n</port>\n</service>\n";
    $messageWSDL = '';
    foreach ($methods as $method) {
        if ($method->isPublic() && !$method->isConstructor()) {
            $portTypeWSDL.= '<operation name="'.$method->getName()."\">\n".'<input message="tns:'.$method->getName()."Request\" />\n<output message=\"tns:".$method->getName()."Response\" />\n</operation>\n";
            $bindingWSDL.= '<operation name="'.$method->getName()."\">\n".'<soap:operation soapAction="urn:'.$service_name.'#'.$class_name.'#'.$method->getName()."\" />\n<input><soap:body use=\"encoded\" namespace=\"urn:$service_name\" encodingStyle=\"http://schemas.xmlsoap.org/soap/encoding/\" />\n</input>\n<output>\n<soap:body use=\"encoded\" namespace=\"urn:$service_name\" encodingStyle=\"http://schemas.xmlsoap.org/soap/encoding/\" />\n</output>\n</operation>\n";
            $messageWSDL.= '<message name="'.$method->getName()."Request\">\n";
            $parameters = $method->getParameters();
            foreach ($parameters as $parameter) {
                $messageWSDL.= '<part name="'.$parameter->getName()."\" type=\"xsd:string\" />\n";
            }
            $messageWSDL.= "</message>\n";
            $messageWSDL.= '<message name="'.$method->getName()."Response\">\n";
            $messageWSDL.= '<part name="'.$method->getName()."\" type=\"xsd:string\" />\n";
            $messageWSDL.= "</message>\n";
        }
    }

    $portTypeWSDL.= "</portType>\n";
    $bindingWSDL.= "</binding>\n";
    //  return sprintf('%s%s%s%s%s%s', $headerWSDL, $portTypeWSDL, $bindingWSDL, $serviceWSDL, $messageWSDL, '</definitions>');
    $fso = fopen($wsdl_name . ".wsdl", "w") or die("Unable to open file!");
    fwrite($fso, sprintf('%s%s%s%s%s%s', $headerWSDL, $portTypeWSDL, $bindingWSDL, $serviceWSDL, $messageWSDL, '</definitions>'));
}


class ResponseObject
{
    public $responseCode = 0;
    public $totalpage=0;
    public $pagesize=0;
    public $role = 0;
    public $flag = 0;
    public $responseMessage = 'Unknown error!';
    public $PlansArray = null;
}

class getPlans1
{
    public $responseCode = 0;
    public $totalpage=0;
    public $pagesize=0;
    public $role = 0;
    public $flag = 0;
    public $responseMessage = 'Unknown error!';
    public $PlansArray = null;

    public function Plans($uid, $p)
    {
        $responseObject = new ResponseObject();
        $data=[
        [
          ['rowid'=>1,'rq'=>'2018-01-01','hshj'=>2,34],
          ['rowid'=>2,'rq'=>'2018-02-01','hshj'=>1.23],
          ['rowid'=>3,'rq'=>'2018-03-01','hshj'=>3.23],
          ['rowid'=>4,'rq'=>'2018-04-01','hshj'=>4.23]
        ],
        [
          [
            'rs'=>1,
             'totalpage'=>10,
             'pagesize'=>1,
             'msg'=>'this is message'
          ]
        ]
    ];
        $responseObject->responseCode =$data[1][0]['rs'] ;
        $responseObject->totalpage = $data[1][0]['totalpage'];
        $responseObject->pagesize = $data[1][0]['pagesize'];
        $responseObject->responseMessage = $data[1][0]['msg'] ;
        $responseObject->PlansArray =$data[0];

        return $responseObject;
    }
}

function getPlans($uid, $p)
    {
        $responseObject = new ResponseObject();
        $data=[
        [
          ['rowid'=>1,'rq'=>'2018-01-01','hshj'=>2,34],
          ['rowid'=>2,'rq'=>'2018-02-01','hshj'=>1.23],
          ['rowid'=>3,'rq'=>'2018-03-01','hshj'=>3.23],
          ['rowid'=>4,'rq'=>'2018-04-01','hshj'=>4.23]
        ],
        [
          [
            'rs'=>1,
             'totalpage'=>10,
             'pagesize'=>1,
             'msg'=>'this is message'
          ]
        ]
    ];
        $responseObject->responseCode =$data[1][0]['rs'] ;
        $responseObject->totalpage = $data[1][0]['totalpage'];
        $responseObject->pagesize = $data[1][0]['pagesize'];
        $responseObject->responseMessage = $data[1][0]['msg'] ;
        $responseObject->PlansArray =$data[0];

        return $responseObject;
    }




