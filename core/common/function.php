<?php
function p($var){
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