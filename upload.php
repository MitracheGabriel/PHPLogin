<?php

session_start();
include_once 'dbh.php';
$id=$_SESSION['id'];

if(isset($_POST['submit'])){
	$file=$_FILES['file'];
	$fileName=$_FILES['file']['name'];
	$fileTmpName=$_FILES['file']['tmp_name'];
	$fileSize=$_FILES['file']['size'];
	$fileError=$_FILES['file']['error'];
	$fileType=$_FILES['file']['type'];
	
	$fileExt=explode('.',$fileName);
	$fileActualExt=strtolower(end($fileExt));
	$allowed=array('jpg','jpeg','png');
	
	if(in_array($fileActualExt,$allowed)){
		if($fileError===0){
			if($fileSize<500000){
				$fileNameNew="profile".$id.".".$fileActualExt;
				$fileDestination='uploads/'.$fileNameNew;
				move_uploaded_file($fileTmpName,$fileDestination);
				$sql="UPDATE profileimg SET status=0 WHERE userid='$id'";
				$result=mysqli_query($conn,$sql);
				header("Location: index.php?upload=succes");
			}else{
				echo "File size is too large";
			}
		}else{
			echo "An unexpected error has ocurred";
		}
		
	}else{
		echo "File needs to be a photo";
	}
}
