<?php

session_start();
include_once 'dbh.php';


?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<?php
if(isset($_SESSION['id'])){
$sql="SELECT * FROM user WHERE id=".$_SESSION['id'];
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0){
$row=mysqli_fetch_assoc($result);
	$id=$_SESSION['id'];
	$sqlImg="SELECT * FROM profileimg WHERE userid='$id'";
	$resultImg=mysqli_query($conn,$sqlImg);
	$rowImg=mysqli_fetch_assoc($resultImg);
		echo "<div class='user-container'>";
		if($rowImg['status']==0){
		echo "<img src='uploads/profile".$id.".jpg'>";
		}else{
			echo "<img src='uploads/profiledefault.jpg'>";
		}
		echo "<p>".$row['username']."</p>";
		echo"</div>";
	
}
}
if(isset($_SESSION['id'])){
	
		echo "You are logged in as ". $_SESSION['username']."</br>";
		if(isset($_SESSION['rank'])){
			if($_SESSION['rank']==1){
			echo "USER WITH HIGH RANK";
			}
		}

	echo"<form action='upload.php' method='POST' enctype='multipart/form-data'>
<input type='file' name='file'>
<button type='submit' name='submit'>Upload</button>
</form>";
	echo"<form action ='logout.php' method='POST'>
<button type='submit' name='submitLogout'>Logout</button>
</form>";
		
	
}else{
	echo "You are not Logged in";
	echo"<form action ='login.php' method='POST'>
	<input type='text' name='uid'>
	<input type='password' name='pwd'>
<button type='submit' name='submitLogin'>Login</button>
</form>";
	echo"<form action='signup.php' method='POST'>
         <input type='text' name='first' placeholder='firstname'>
		 <input type='text' name='last' placeholder='lastname'>
		 <input type='text' name='uid' placeholder='username'>
		 <input type='email' name='mail' placeholder='mail'>
		 <input type='password' name='pwd' placeholder='password'>
		 <button type='submit' name='submitSignup'>Register</button>
		 </form>";
}

?>


</body>

</html>