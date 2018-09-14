<?php
namespace core\lib;

use core\lib\config as config;

class log{
    static private $_log;
    static public function init(){
        $storeType=config::getConfig('TYPE','log');
        $logCalss='\core\drive\log\\'.$storeType;
        self::$_log=new $logCalss();
    }

    static public function writeLog($message,$fileName='log'){
        self::$_log->log($message,$fileName='log');
    }
}