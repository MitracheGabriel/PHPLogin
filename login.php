<?php

session_start();

if(isset($_POST['submitLogin'])){
	require 'dbh.php';
	$username=$_POST['uid'];
	$password=$_POST['pwd'];
	
	if(empty($username)||empty($password)){
	header("Location: index.php");
	exit();
	}else{
	$sql="SELECT * FROM user WHERE  mail=?";
	$stmt=mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt,$sql)){
			header("Location: index.php");
			exit();
		}else{
			
			mysqli_stmt_bind_param($stmt,"s",$username);
			mysqli_stmt_execute($stmt);
			$result=mysqli_stmt_get_result($stmt);
				if($row = mysqli_fetch_assoc($result)){
				$pwdCheck = password_verify($password,$row['pwdUsers']);
				if($password!=$row['password']){
				header("Location: index.php");
					exit();
				}else if($password==$row['password']){
					session_start();
					$_SESSION['id'] = $row['id'];
					$_SESSION['rank']=$row['rank'];
					$_SESSION['username'] = $row['username'];
					
					header("Location: index.php");
					exit();
				}else{
				header("Location: index.php");
					exit();
				}
			}else{
				header("Location: index.php");
			exit();
			}
			
		}
	}
	}
else{
header("Location: index.php");
	exit();
}
	
