<?php

include ("../includes/connection.php");

if(isset($_POST['uploadPhoto1'])) {

header('content-type:text/html;charset=utf-8');
$fileInfo=$_FILES['myFile'];
$maxSize=2097152;//允许的最大值
$allowExt=array('jpeg','jpg','png','gif','wbmp');
$flag=true;//检测是否为真实图片类型
//1.判断错误号
if($fileInfo['error']==0){
	//判断上传文件的大小
	if($fileInfo['size']>$maxSize){
		exit('上传文件过大');
	}
	//$ext=strtolower(end(explode('.',$fileInfo['name'])));
	$ext=pathinfo($fileInfo['name'],PATHINFO_EXTENSION);
	if(!in_array($ext,$allowExt)){
		exit('非法文件类型');
	}
	//判断文件是否是通过HTTP POST方式上传来的
	if(!is_uploaded_file($fileInfo['tmp_name'])){
		exit('文件不是通过HTTP POST方式上传来的');
	}
	//检测是否为真实的图片类型
	if($flag){
		if(!getimagesize($fileInfo['tmp_name'])){
			exit('不是真正图片类型');
		}
	}
	$path='../uploads';
	if(!file_exists($path)){
		mkdir($path,0777,true);
		chmod($path,0777);
	}
	//确保文件名唯一，防止重名产生覆盖
	$uniName=uniqid(microtime(true),true).'.'.$ext;
	//echo $uniName;exit;
	$destination=$path.'/'.$uniName;
	if(@move_uploaded_file($fileInfo['tmp_name'],$destination)){
		echo "<script>alert('OK')</script>";
	}else{
		echo "<script>alert('Fail to upload')</script>";
	}
}else{
	//匹配错误信息
	switch($fileInfo['error']){
		case 1:
			echo '上传文件超过了PHP配置文件中upload_max_filesize选项的值';
			break;
		case 2:
			echo '超过了表单MAX_FILE_SIZE限制的大小';
			break;
		case 3:
			echo '文件部分被上传';
			break;
		case 4:
			echo '没有选择上传文件';
			break;
		case 6:
			echo '没有找到临时目录';
			break;
		case 7:
		case 8:
			echo '系统错误';
			break;
	}
}

$logged_email = $_SESSION['user_email'];

$get_userID = "SELECT * FROM user WHERE user_email = '$logged_email'";
$run_userID = mysqli_query($con, $get_userID);
$row = mysqli_fetch_array($run_userID);

$sessionUserID = $row['user_id'];
$photoDescription = $_POST['photo_description'];
$photoColleciton = $_POST['collection_id'];
$photoDay = date('d');
$photoMonth = date('m');
$photoYear = date('y');
// $photoLink = $_POST['photo_link'];


$insertPost = "INSERT INTO photos (user_id,collection_id,photo_description,photo_day, photo_month, photo_year, photo_link)
VALUES ('$sessionUserID','$collection_id','$photoDescription','$photoDay', '$photoMonth', '$photoYear', '$uniName')";
$run_insertPost = mysqli_query($con, $insertPost);

if($run_insertPost) {
	echo "<script>alert('Yay!!! New post!!!')</script>";
} else {
	echo "<script>alert('Ahhh crap...')</script>";
}



}
?>
