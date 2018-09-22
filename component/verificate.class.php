<?php
namespace component;

class Verify{
    private $_width;
    private $_height;
    private $_num_of_code;
    private $_file_type;
    private $_image;
    public function __construct($width=null,$height=null,$code_num=4,$file_type='png'){
        if(is_null($width) || is_null($height)){
            return false;
        }
        $this->_width=$width;
        $this->_height=$height;
        $this->_num_of_code=$code_num;
        $this->_file_type=$file_type;

        $this->_image=imagecreatetruecolor($this->_width,$this->_height);
        imagefill($this->_image,0,0,imagecolorallocate($this->_image,255,255,255));
    }

    private function makePoint(){
        
    }

    private function makeLine(){
        
    }

    public function vetificateCode(){
        
    }

    public function __destruct(){
        imagedestroy($this->_image);
    }
}