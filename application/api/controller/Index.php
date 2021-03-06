<?php

namespace app\api\controller;

use think\Controller;
use think\Request;
use think\Db;

class Index extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $rs = Db::query("select * from a");
        trace($rs);
        return  json_encode($rs);
    }

    public function getcode()
    {
        $n = input('n', '');
        $cd = input('cd', '');
        $rs = Db::connect("SqlserverHis")->query("exec getCode @name='$n',@cd='$cd' ");
        trace($rs);
        return  json_encode($rs);
    }

    public function setcode()
    {
        $spid = input('spid', '');
        $hiscode = input('hiscode', '');
        $hisrowid = input('hisrowid', '');
        $rs = Db::connect("SqlserverHis")->query("exec setCode @spid='$spid',@hiscode='$hiscode',@hisrowid='$hisrowid' ");
        return  json_encode($rs);
    }

    /**
    *  读取质检单数据
    *
    **/
    public function getQcImg()
    {
        //$page = input('page', 1);
        $k = input('p');
        $v = input('l');
        trace($k.':'.$v);
        $path = '../qcimg/';
        $rs = Db::connect("SqlserverHis")->query("exec getQcImage @name='$k',@lot='$v'");
        $rsarray = [];
        //trace(count($rs));
        foreach ($rs as $key => $value) {
            $img = $value[$key]['imgData'];
            $imgdata = base64_encode($img);
            $path = 'qcimg/'.time().'.jpg';
            file_put_contents($path, $img);
            $rsarray[$key]['path']= $path;
            $rsarray[$key]['img']=$imgdata;
        }
        trace(count($rsarray));
        return  json_encode($rsarray);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function plans()
    {
        $page = input('page', 1);
        $k = input('k', '');
        $v = input('v', '');
        $h = input('h', '');

        $rs = Db::connect("SqlserverHis")->query("exec getPlansHeader @pageindex='$page',@k='$k',@v='$v',@h='$h'");
        trace($rs);
        return  json_encode($rs);
    }


    public function setorderid()
    {
        $orders = $_POST;

        foreach ($orders as $row) {
            $orderid=$row['orderid'];
            $rowid=$row['rowid'];
            $ProductID = $row['ProductID'];
            $rs = Db::connect("SqlserverHis")->execute("exec setOrders @orderid='$orderid',
            @rowid=$rowid,@ProductID='$ProductID'");
            trace($rs);
        }
        //trace($orders);
        //$orders=['a'=>'a'];
        return json_encode($orders);
        /*  $orderid = input('row');
         if (isset($orderid) || !empty($orderid)) {
             $sql = "exec getPlans @orderid=$orderid";
         $rs = Db::connect("SqlserverHis")->query($sql);
         trace($rs);
         return  json_encode($rs); */
    }

    public function history()
    {
        $page = input('page', 1);
        $p = input('p');
        $l = input('l');
        $sql = "exec getPlans @h='history',@productid='$p',@lot='$l'";

        $rs = Db::connect("SqlserverHis")->query($sql);
        trace($rs);
        return  json_encode($rs);
    }

    public function planslist()
    {
        $page = input('page', 1);
        $orderid = input('orderid');
        $h = input('h', '');
        if (isset($orderid) || !empty($orderid)) {
            $sql = "exec getPlans @orderid=$orderid,@h='$h'";
        } else {
            $sql = "exec getPlans @pageindex=$page";
        }


        $rs = Db::connect("SqlserverHis")->query($sql);
        trace($rs);
        return  json_encode($rs);
    }

    public function checklogin()
    {
        $user= input('u');
        $pwd = input('p');

        $sql = "exec getusers @u='$user',@p='$pwd'";
        $data = Db::connect("SqlserverHis")->query($sql);
        trace($data[0]);
        return json_encode($data[0]);
    }

    public function applogout()
    {
        //$user= input('u');
        //$pwd = input('p');

        //$sql = "exec getusers @u='$user',@p='$pwd'";
        //$data = Db::connect("SqlserverHis")->query($sql);
        //trace($data[0]);
        $data =array('rs'=>1);
        return json_encode($data);
    }


    public function logs()
    {
        $data =array('rs'=>1);
        return json_encode($data);
    }


    public function userinfo()
    {
        $token= input('token');
        $sql = "exec getusers @token='$token'";
        $data = Db::connect("SqlserverHis")->query($sql);
        trace($data[0]);
        return json_encode($data[0]);
    }
}
