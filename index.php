<?php
    if(version_compare(PHP_VERSION,'7.0','<')){
        die('PHP Version Should Not Be Lower Than 7.0');
    }
    if(PHP_OS == 'Win'){
        define('SnowPHP',str_replace('\\','/',__DIR__));
    }else{
        define('SnowPHP',__DIR__);
    }
    define('CORE',SnowPHP.'/core');
    define('APP',SnowPHP.'/app');
    define('PUBLIC',SnowPHP.'/public');
    define('RUNTIME',SnowPHP.'/Runtime');
    define('DEBUG',true);
    require "vendor/autoload.php";

    if (DEBUG) {
        $whoops = new \Whoops\Run;
        $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
        $whoops->register();
        ini_set('debug_errors','on');
    } else {
        ini_set('debug_errors','off');
    }
    
    require CORE.'/common/function.php';
    require CORE.'/snow.php';
    spl_autoload_register('\core\snow::loadAuto');
    \core\snow::run();
    

    