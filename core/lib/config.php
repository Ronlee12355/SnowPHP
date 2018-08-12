<?php
namespace core\lib;
class config{
    static private $_config=[];
    static public function getConfig(string $name, string $file='config'){
        if(isset(self::$_config[$file])){
            return self::$_config[$file][$name];
        }

        $fileName=CORE.'/common/config/'.$file.'.php';
        if(is_file($fileName)){
            $config=require($fileName);
        }else{
            throw new \Exception("No Such File");
        }

        if(!array_key_exists($name,$config)){
            throw new \Exception('No Such Config Name In This File');
        }
        self::$_config[$file]=$config;
        return $config[$name];
    }

    static public function getAllConfig($file='log'){
        if(isset(self::$_config[$file])){
            return self::$_config[$file];
        }

        $fileName=CORE.'/common/config/'.$file.'.php';
        if(is_file($fileName)){
            $config=require($fileName);
        }else{
            throw new \Exception("No Such File");
        }

        self::$_config[$file]=$config;
        return $config;
    }
}