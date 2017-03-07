<?php 
header('content-type:text/html;charset=utf-8');
$fileInfo=$_FILES['myFile'];
$maxSize=2097152;//MAX size allowed
$allowExt=array('jpeg','jpg','png','gif','wbmp');
$flag=true;//verfy file type
//1.error number
if($fileInfo['error']==0){
	//TEST FILE SIZE
	if($fileInfo['size']>$maxSize){
		exit('file is too large');
	}
	//$ext=strtolower(end(explode('.',$fileInfo['name'])));
	$ext=pathinfo($fileInfo['name'],PATHINFO_EXTENSION);
	if(!in_array($ext,$allowExt)){
		exit('invaild file type');
	}
	// posting method
	if(!is_uploaded_file($fileInfo['tmp_name'])){
		exit('file does not come from http, but "POST"');
	}
	// test pic type
	if($flag){
		if(!getimagesize($fileInfo['tmp_name'])){
			exit('not a pic type');
		}
	}
	$path='uploads';
	if(!file_exists($path)){
		mkdir($path,0777,true);
		chmod($path,0777);
	}

	$uniName=md5(uniqid(microtime(true),true)).'.'.$ext;
	//echo $uniName;exit;
	$destination=$path.'uploads/'.$uniName;
	if(@move_uploaded_file($fileInfo['tmp_name'],$destination)){
		echo 'upload successful';
	}else{
		echo 'fail to upload';
	}
}else{
	//match the error
	switch($fileInfo['error']){
		case 1:
			echo 'file is larger than the MAX size threshold';
			break;
		case 2:
			echo 'file is larger than the MAX size threshold';
			break;
		case 3:
			echo 'only part of the file is uploaded';
			break;
		case 4:
			echo 'no file is selected'; 
			break;
		case 6:
			echo 'no temp folder';
			break;
		case 7:
		case 8:
			echo 'system error';
			break;
	}
}