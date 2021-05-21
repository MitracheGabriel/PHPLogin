<?php
include_once 'dbh.php';
$first=$_POST['first'];
$last=$_POST['last'];
$uid=$_POST['uid'];
$mail=$_POST['mail'];
$pwd=$_POST['pwd'];

$sql="INSERT INTO user (first,last,username,mail,password) VALUES ('$first','$last','$uid','$mail','$pwd')";
mysqli_query($conn,$sql);

$sql="SELECT * FROM user WHERE mail='$mail'";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0){
	while($row=mysqli_fetch_assoc($result)){
		$userid=$row['id'];
		$sql="INSERT INTO profileimg (userid,status) VALUES ('$userid',1)";
		mysqli_query($conn,$sql);
		header("Location: index.php");

	}
}else{
	echo"Error";
}
