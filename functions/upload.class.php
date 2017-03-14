<?php
class upload{
	protected $fileName;
	protected $maxSize;
	protected $allowMime;
	protected $allowExt;
	protected $uploadPath;
	protected $imgFlag;
	protected $fileInfo;
	protected $error;
	protected $ext;
	/**
	 * @param string $fileName
	 * @param string $uploadPath
	 * @param string $imgFlag
	 * @param number $maxSize
	 * @param array $allowExt
	 * @param array $allowMime
	 */
	public function __construct($fileName='myFile',$uploadPath='./uploads',$imgFlag=true,$maxSize=9999999,$allowExt=array('jpeg','jpg','png','gif'),$allowMime=array('image/jpeg','image/png','image/gif')){
		$this->fileName=$fileName;
		$this->maxSize=$maxSize;
		$this->allowMime=$allowMime;
		$this->allowExt=$allowExt;
		$this->uploadPath=$uploadPath;
		$this->imgFlag=$imgFlag;
		$this->fileInfo=$_FILES[$this->fileName];
	}
	/**
	 * check for errors
	 * @return boolean
	 */
	protected function checkError(){
		if(!is_null($this->fileInfo)){
			if($this->fileInfo['error']>0){
				switch($this->fileInfo['error']){
					case 1:
						$this->error='The file size is larger than the upload_max_filesize value in the php config file';
						break;
					case 2:
						$this->error='The file size is larger than the MAX_FILE_SIZE value for html form table';
						break;
					case 3:
						$this->error='file is partly uploaded';
						break;
					case 4:
						$this->error='no selected file';
						break;
					case 6:
						$this->error='can not find the upload directory';
						break;
					case 7:
						$this->error='file can not be writed';
						break;
					case 8:
						$this->error='php API breaks the file upload';
						break;

				}
				return false;
			}else{
				return true;
			}
		}else{
			$this->error='uploading error ';
			return false;
		}
	}
	/**
	 * file size test
	 * @return boolean
	 */
	protected function checkSize(){
		if($this->fileInfo['size']>$this->maxSize){
			$this->error='file is too large';
			return false;
		}
		return true;
	}
	/**
	 * file suffix
	 * @return boolean
	 */
	protected function checkExt(){
		$this->ext=strtolower(pathinfo($this->fileInfo['name'],PATHINFO_EXTENSION));
		if(!in_array($this->ext,$this->allowExt)){
			$this->error='invalid image suffix';
			return false;
		}
		return true;
	}
	/**
	 * file type
	 * @return boolean
	 */
	protected function checkMime(){
		if(!in_array($this->fileInfo['type'],$this->allowMime)){
			$this->error='file type not accept';
			return false;
		}
		return true;
	}
	/**
	 * real image?
	 * @return boolean
	 */
	protected function checkTrueImg(){
		if($this->imgFlag){
			if(!@getimagesize($this->fileInfo['tmp_name'])){
				$this->error='not real image type';
				return false;
			}
			return true;
		}
	}
	/**
	 * uploaded via HTTP POST?
	 * @return boolean
	 */
	protected function checkHTTPPost(){
		if(!is_uploaded_file($this->fileInfo['tmp_name'])){
			$this->error='file is not uploaded via HTTP POST';
			return false;
		}
		return true;
	}
	/**
	 *show error
	 */
	protected function showError(){
		exit('<span style="color:red">'.$this->error.'</span>');
	}
	/**
	 * upload directory exist?
	 */
	protected function checkUploadPath(){
		if(!file_exists($this->uploadPath)){
			mkdir($this->uploadPath,0777,true);
		}
	}
	/**
	 * set unique name
	 * @return string
	 */
	protected function getUniName(){
		return md5(uniqid(microtime(true),true));
	}
	/**
	 * file upload
	 * @return string
	 */
	public function uploadFile(){
		if($this->checkError()&&$this->checkSize()&&$this->checkExt()&&$this->checkMime()&&$this->checkTrueImg()&&$this->checkHTTPPost()){
			$this->checkUploadPath();
			$this->uniName=$this->getUniName();
			$this->destination=$this->uploadPath.'/'.$this->uniName.'.'.$this->ext;
			if(@move_uploaded_file($this->fileInfo['tmp_name'], $this->destination)){
				return  $this->uniName.'.'.$this->ext;
			}else{
				$this->error='fail to move the file from tmp folder to upload directory';
				$this->showError();
			}
		}else{
			$this->showError();
		}
	}
}
