<?php
namespace app\home\controller;
class indexController{
    public function index(){
        $redis = new \Redis();
       $redis->connect('127.0.0.1',6379);
       $redis->set('test','测试');
       echo $redis->get('test');
       exit();
    }
}