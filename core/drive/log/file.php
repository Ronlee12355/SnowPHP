<?php
namespace core\drive\log;
use core\lib\config;

class file{
    public $path;
    private $filePath;
    public function __construct(){
        $this->path=config::getConfig('PATH','log');
        $this->getFilePath();
    }

    public function log($message,$fileName='log'){
        $file=$this->filePath.'/'.$fileName.'.txt';
        $message=date('Y-m-d H:i:s',time()).'  '.json_encode($message).PHP_EOL;
        return file_put_contents($file,$message,FILE_APPEND);
    }

    private function getFilePath(){
        $this->filePath=$this->path.'/'.date('Ymd',time());
        if(!is_dir($this->filePath)){
            mkdir($this->filePath,0777,true);
        }
    }
}