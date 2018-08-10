<?php
    define('SnowPHP',__DIR__);
    define('CORE',SnowPHP.'/core');
    define('APP',SnowPHP.'/app');
    define('PUBLIC',SnowPHP.'/public');
    define('RUNTIME',SnowPHP.'/Runtime');
    define('DEBUG',true);

    if (DEBUG) {
        ini_set('debug_errors','on');
    } else {
        ini_set('debug_errors','off');
    }
    
    require CORE.'/common/function.php';
    require CORE.'/snow.php';
    spl_autoload_register('\core\snow::loadAuto');
    \core\snow::run();
    

    