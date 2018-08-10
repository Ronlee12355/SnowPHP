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