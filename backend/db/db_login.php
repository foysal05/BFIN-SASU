<?php
include('db.php');
session_start();
	if (isset($_POST['login'])) {
	
	 $email = mysqli_real_escape_string($con, $_POST['email']);
	 $password = mysqli_real_escape_string($con, $_POST['password']);
	
	
	$result = mysqli_query($con, "SELECT * FROM admins  WHERE email = '" . $email. "' and password = '" . $password. "'");
	
	$result2 = mysqli_query($con, "SELECT * FROM users  WHERE email = '" . $email. "' and password = '" . $password. "'");
	
	if ($row = mysqli_fetch_array($result)) {
		$_SESSION['email']=$email;
		//$_SESSION['password']=$password;
		$_SESSION['name']=$row['name'];
		
		$_SESSION['id']=$row['aid'];
		$_SESSION['status']=$row['status'];
		$_SESSION['ad_login']=TRUE;
		
		header('location:../admin/index?success');
		}else if($row = mysqli_fetch_array($result2)) {
		$_SESSION['email']=$email;
		$_SESSION['name']=$row['firstName'];
		$_SESSION['lastName']=$row['lastName'];
		$_SESSION['id']=$row['uid'];
		$_SESSION['status']=$row['status'];
		if ($row['status']==0) {
			header('location:../deactivate');
		}else{
		$_SESSION['login']=TRUE;
		header('location:../index?success');
		}
		
		
	}else {
		
		header('location:../login?error');
	}
	
}

?>