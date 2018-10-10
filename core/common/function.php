<?php

function showMsg($var){
    if(is_bool($var)){
        var_dump($var);
    }elseif(is_null($var)){
        var_dump(null);
    }else{
        echo "<pre style='color:red;font-size:50px;'>".print_r($var,true)."</pre>";
    }
}

function ajaxReturn(int $status,string $message,array $data){
    $result=[
        'status'=>$status,
        'message'=>$message,
        'data'=>$data
    ];
    return json_encode($result);
}

function trimData(string $data):string{
    $data=trim($data);
    $data=htmlspecialchars($data);
    return $data;
}

function post(string $name,string $type='string'){
    if(!isset($_POST[$name])){
        throw new Exception("No such value in the post");
    }

    switch ($type) {
        case 'int':
            return(intval(trim($_POST[$name])));
            break;
        case 'string':
            $_POST[$name]=trim($_POST[$name]);
            $_POST[$name]=strip_tags($_POST[$name]);
            return(strval(addslashes($_POST[$name])));
        default:
            return(strval(trim(addslashes($_POST[$name]))));
            break;
    }
}

function get(string $name,string $type='string'){
    if(!isset($_GET[$name])){
        throw new Exception("No such value in the get");
    }

    switch ($type) {
        case 'int':
            return(intval(trim($_GET[$name])));
            break;
        case 'string':
            $_GET[$name]=trim($_GET[$name]);
            $_GET[$name]=strip_tags($_GET[$name]);
            return(strval(addslashes($_GET[$name])));
        default:
            return(strval(trim(addslashes($_GET[$name]))));
            break;
    }
}

function jump(string $url){
    header('Location: '.$url);
    exit();
}

function IS_AJAX() {
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'xmlhttprequest'){
        return true;
    }
    return false;
}