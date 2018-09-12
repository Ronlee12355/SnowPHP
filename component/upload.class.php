<?php
namespace component;
class Upload{
    public $allow_file_type=[];
    protected $file_name;
    public $file_size=8888888;
    public $ext;
    public $allow_mime=[];
    public $destination;
    protected $error;
    public function __construct($fileName='file'){
        $this->file_name=$_FILES[$fileName];
    }
    public function uploadFile(){
        
    }
    private function checkError(){
        if(!is_null($this->file_name['error']) && $this->file_name['error']>0){
            $error_code=$this->file_name['error'];
            switch ($error_code) {
                case 1:
					$this->error='超过了PHP配置文件中upload_max_filesize选项的值';
					break;
				case 2:
					$this->error='超过了表单中MAX_FILE_SIZE设置的值';
					break;
				case 3:
					$this->error='文件部分被上传';
					break;
				case 4:
					$this->error='没有选择上传文件';
					break;
                case 6:
                	$this->error='没有找到临时目录';
					break;
				case 7:
					$this->error='文件不可写';
					break;
				case 8:
					$this->error='由于PHP的扩展程序中断文件上传';
					break;
            }
            return false;
        }else{
            return true;
        }
    }
    private function checkMime(){
        if(count($this->allow_mime) == 0 || !is_array($this->allow_mime)){
            $this->error='Mime must be an array and contains at least one element';
            return false;
        }

        $mime=$this->file_name['type'];
        if(!in_array($mime,$this->allow_mime)){
            $this->error='Not allowed file type';
            return false;
        }
        return true;
    }
    private function checkHttpUpload(){
        if(!is_uploaded_file($this->file_name['tmp_name'])){
            $this->error='File is not upladed throught http';
            return false;
        }
        return true;
    }
    private function checkExt(){
        if(count($this->allow_file_type) == 0 || !is_array($this->allow_file_type)){
            $this->error='File extension must be an array and contains one elements';
            return false;
        }

        $extension=strtolower(pathinfo($this->file_name['name'],PATHINFO_EXTENSION));
        if(!in_array($extension,$this->allow_file_type)){
            $this->error='Not allowed file extension';
            return false;
        }
        return true;
    }
    private function checkVaildDest(){
        
    }
    private function checkFileSize(){
        if($this->file_name['size'] > $this->file_size){
            $this->error='File size is bigger than allowed';
            return false;
        }
        return true;
    }
    private function showError(){
        throw new \Exception($this->error);
    }
}