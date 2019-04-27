<?php
session_start();
include('../db/db.php');

if (isset($_POST['add_admin'])) {
	$name=$_POST['name'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$cpassword=$_POST['cpassword'];
	if ($password<>$cpassword) {
		header('location:../admin/add_admin?passNot');
	}else{
		$query="SELECT * FROM admins WHERE email='$email'";
		$result=mysqli_query($con,$query);
		if(mysqli_num_rows($result)>0){
			header('location:../admin/add_admin?exist');
		}else{
			$query="INSERT INTO admins VALUES('','$name','$email','$password','2')";
			$result=mysqli_query($con,$query);
			if ($query) {
				header('location:../admin/administrative?success');
				//echo "Success";
			}else{
				header('location:../admin/administrative?error');
				//echo "Error";
			}
		}
	}
}
if (isset($_POST['update_admin'])) {
	$name=$_POST['name'];
	$email=$_POST['email'];
	$id=$_POST['id'];
	$password=$_POST['password'];
	$cpassword=$_POST['cpassword'];
	if ($password<>$cpassword) {
		header('location:../admin/add_admin?passNot');
	}else{
		$query="SELECT * FROM admins WHERE email='$email' AND aid<>'$id'";
		$result=mysqli_query($con,$query);
		if(mysqli_num_rows($result)>0){
			header('location:../admin/add_admin?exist');
		}else{
			$query="UPDATE admins SET name='$name',email='$email',password='$password' WHERE aid='$id'";
			$result=mysqli_query($con,$query);
			if ($query) {
				header('location:../admin/administrative?updated');
				//echo "Success";
			}else{
				header('location:../admin/administrative?error');
				//echo "Error";
			}
		}
	}

}
if (isset($_GET['status'])) {
	$status=$_GET['status'];
	$aid=$_GET['id'];
	$query="UPDATE admins SET status='$status' WHERE aid='$aid'";
		$result=mysqli_query($con,$query);
		if ($result) {
			header('location:../admin/administrative?Schanged');
			//echo "Updated without photo";
		}
}if (isset($_GET['ADelete'])) {
	
	$aid=$_GET['id'];
	//echo $uid;
	$query="DELETE FROM admins WHERE aid='$aid'";
		$result=mysqli_query($con,$query);
		if ($result) {
			header('location:../admin/administrative?deleted');
			//echo "Updated without photo";
		}
}

?>