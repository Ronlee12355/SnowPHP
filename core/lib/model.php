<?php
namespace core\lib;

use core\lib\config;

class model extends \Medoo\Medoo{
    public function __construct(){
        $db=config::getAllConfig('database');
        try{
            parent::__construct($db);
        }catch(\PDOException $e){
            die($e->getMessage());
        }
    }
}