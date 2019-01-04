<?php
namespace app\home\controller;

use core\lib\model;

class indexController{
    public function index(){
       $model = new model();
       dump($model);
    }
}