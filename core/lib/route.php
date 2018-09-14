<?php
namespace core\lib;

use core\lib\config as config;

class route{
    public $module;
    public $control;
    public $action;
    /* 
       /index.php/home/index/index?id=5&pid=6    
    */
    public function __construct(){
        if($_SERVER['REQUEST_URI'] !== '/' && $_SERVER['REQUEST_URI']){
            $pathInfo=trim($_SERVER['REQUEST_URI'],'/');
            $pathArr=explode('?',$pathInfo);

            $pathArrInfo=explode('/',$pathArr[0]);
            $this->module=isset($pathArrInfo[0])?$pathArrInfo[0]:config::getConfig('MODULE');
            $this->control=isset($pathArrInfo[1])?$pathArrInfo[1]:config::getConfig('CONTROL');
            $this->action=isset($pathArrInfo[2])?$pathArrInfo[2]:config::getConfig('ACTION');

            $paraMeters=explode('&',$pathArr[1]);

            foreach($paraMeters as $meter){
                $meter=explode('=',$meter);
                $_GET[$meter[0]]=$meter[1];
            }
        }else{
            $this->module=config::getConfig('MODULE');
            $this->control=config::getConfig('CONTROL');
            $this->action=config::getConfig('ACTION');   
        }
    }
}