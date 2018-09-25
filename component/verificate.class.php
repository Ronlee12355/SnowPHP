<?php
namespace component;

class Verify{
    private $_width;
    private $_height;
    private $_num_of_code;
    private $_file_type;
    private $_image;
    public $font=6;
    private $_code='abcdefghijklmnopqrstuvwxyz123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    public function __construct($width=null,$height=null,$code_num=4,$file_type='png'){
        if(is_null($width) || is_null($height)){
            return false;
        }
        if(session_status() == PHP_SESSION_DISABLED){
            return false;
        }elseif(session_status() == PHP_SESSION_NONE){
            session_start();
        }
        $_SESSION['verify_code']='';
        $this->_width=$width;
        $this->_height=$height;
        $this->_num_of_code=$code_num;
        $this->_file_type=$file_type;

        $this->_image=imagecreatetruecolor($this->_width,$this->_height);
        imagefill($this->_image,0,0,imagecolorallocate($this->_image,255,255,255));
    }

    private function makePoint(){
        for ($i=0; $i < 200; $i++) { 
            
        }
    }

    private function makeLine(){
        
    }

    public function vetificateCode(){
        
    }

    public function getCode(){
        $final_code='';
        for ($i=0; $i < strlen($this->_num_of_code); $i++) { 
            $num=substr($this->_code,rand(0,strlen($this->_code)-1),1);
            $final_code.=$num;
            $color=imagecolorallocate($this->_image,rand(0,120),rand(0,120),rand(0,120));
            $x=($i*$this->_width)/$this->_num_of_code+rand(5,9);
            $y=rand(0,intval(($this->_height)/3));
            imagestring($this->_image,$this->font,$x,$y,$num,$color);
        }
        $_SESSION['verify_code']=$final_code;
    }

    public function __destruct(){
        imagedestroy($this->_image);
    }
}