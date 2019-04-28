<?php
include('db.php');
session_start();
	if (isset($_POST['a_login'])) {
	
	 $email = mysqli_real_escape_string($con, $_POST['email']);
	 $password = mysqli_real_escape_string($con, $_POST['password']);
		
	$result = mysqli_query($con, "SELECT * FROM admins  WHERE email = '" . $email. "' and password = '" . $password. "'");
		if ($row = mysqli_fetch_array($result)) {
		$_SESSION['email']=$email;
		//$_SESSION['password']=$password;
		$_SESSION['name']=$row['name'];
		$_SESSION['id']=$row['aid'];
		$_SESSION['status']=$row['status'];
		$_SESSION['ad_login']=TRUE;
		
		header('location:../admin/index?success');
		}else {
		header('location:../admin/login/login?error');
	}
	
}

?>