<?php
namespace core\lib;

use core\lib\config;

class model extends \PDO{
    public function __construct(){
        $db=config::getAllConfig('database');
        $dsn=$db['DATABASE_TYPE'].':host='.$db['SERVER'].';dbname='.$db['DATABASE_NAME'].';charset='.$db['CHARSET'];
        try{
            parent::__construct($dsn,$db['USERNAME'],$db['PASSWORD']);
        }catch(\PDOException $e){
            die($e->getMessage());
        }
    }
}