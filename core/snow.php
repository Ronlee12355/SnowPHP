<?php
namespace core;
use core\lib\route as route;
use core\lib\config as config;
use core\lib\log as log;
class snow{
    static private $_module;
    static private $_action;
    static private $_control;
    public $assign;
    static public function loadAuto(string $class){
        $classInclude=[];
        if (isset($classInclude[$class])) {
            return true;
        }
        $class=str_replace('\\','/',$class);
        $class=SnowPHP.'/'.$class.'.php';
        if (is_file($class)) {
            require $class;
        } else {
            return false;
        }   
    }

    static public function run(){
        date_default_timezone_set(config::getConfig('TIME_ZONE'));
        $route=new route();
        self::$_module=$route->module;
        self::$_action=$route->action;
        $action=self::$_action;
        self::$_control=$route->control;
        $controlFile=APP.'/'.self::$_module.'/controller/'.self::$_control.'Controller.php';

        log::init();
        $logMeg=[];
        if (is_file($controlFile)) {
            $ctlClass='\\app\\'.self::$_module.'\controller\\'.self::$_control.'Controller';
            $ctl=new $ctlClass();
            $logMeg['module']=self::$_module;
            $logMeg['control']=self::$_control;
            $logMeg['action']=self::$_action;
            $logMeg['status']='success';
            log::writeLog($logMeg);
            $ctl->$action();
            
        } else {
            $logMeg['module']=self::$_module;
            $logMeg['control']=self::$_control;
            $logMeg['action']=self::$_action;
            $logMeg['status']='fail';
            log::writeLog($logMeg);
            throw new \Exception('Cannot find the controller file '.self::$_control);
        }
    }

    public function assign($name,$value){
        $this->assign[$name]=$value;
    }

    public function render($viewFile=''){
        if($viewFile !== '' && strstr($viewFile,'/')){
            $viewFile=APP.'/'.self::$_module.'/view//'.$viewFile.'.html';
        }else if($viewFile !== ''){
            $viewFile=APP.'/'.self::$_module.'/view//'.self::$_control.'/'.$viewFile.'.html';
        }else{
            $viewFile=APP.'/'.self::$_module.'/view//'.self::$_control.'/'.self::$_action.'.html';
        }

        if(is_file($viewFile)){
            extract($this->assign);
            include $viewFile;
        }else{
            throw new \Exception('No such file');
        }
    }
}