<?php
namespace core;
use core\lib\route as route;
use core\lib\config as config;
class snow{
    static private $_module;
    static private $_action;
    static private $_control;

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
        $module=$route->module;
        $action=$route->action;
        $controlFile=APP.'/'.$module.'/controller/'.$route->control.'Controller.php';

        if (is_file($controlFile)) {
            include $controlFile;
            $ctlClass='\\app\\'.$module.'\controller\\'.$route->control.'Controller';
            $ctl=new $ctlClass();
            $ctl->$action();
        } else {
            throw new \Exception('Cannot find the controller file '.$route->control);
        }
    }
}