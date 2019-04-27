<?php
session_start();
include ('db.php');

if (isset($_POST['register'])) {

	$firstName=$_POST['firstName'];
	$lastName=$_POST['lastName'];
	$email=$_POST['email'];
	$dob=$_POST['dob'];
	$phone=$_POST['phone'];
	$password=$_POST['password'];
	$gender=$_POST['gender'];

	$fileName=$_FILES['photo']['name'];
	$file_ext=strtolower(end(explode('.', $fileName)));
	$expensions=array("jpeg","jpg","png");

	if (strlen($password)<6) {
		header('location:../register?pass6');
	}else{

		if (in_array($file_ext, $expensions)==false) {
			header('location:../register?imgtypeE');
		//echo "Photo Error";
		}else{
			$query="SELECT * FROM users WHERE email='".$_POST['email']."'";
			echo $query;
			$result=mysqli_query($con,$query);
			if(mysqli_num_rows($result)>1){

				header('location:../register?exist');
			}else{
				$name =str_replace(" ","_",$_FILES['photo'] ['name']);
				$temp=$_FILES['photo'] ['tmp_name'];
				move_uploaded_file($temp,"photo/".$name);
				$imagePath="photo/$name";

				$query="INSERT INTO users VALUES('','$firstName','$lastName','$email','$dob','$phone','$password','$gender','$imagePath','2')";
				$result=mysqli_query($con,$query);
				if ($result) {
					header('location:../register?success');
				}else{
					header('location:../register?error');
				}
			}
		}
	}
}
if (isset($_POST['update'])) {
	$firstName=$_POST['firstName'];
	$lastName=$_POST['lastName'];
	$email=$_POST['email'];
	$dob=$_POST['dob'];
	$phone=$_POST['phone'];
	//$password=$_POST['password'];
	$uid=$_SESSION['id'];
$imageCheck=$_FILES['newPhoto']['name'];
if ($imageCheck=='') {
	
		$query="UPDATE users SET firstName='$firstName',lastName='$lastName',email='$email',phone='$phone',dob='$dob' WHERE uid='$uid'";
		$result=mysqli_query($con,$query);
		if ($result) {
			header('location:../profile?updated');
			//echo "Updated without photo";
		}
}else{
		
		$fileName=$_FILES['newPhoto']['name'];
		$file_ext=strtolower(end(explode('.', $fileName)));
		$expensions=array("jpeg","jpg","png");
		$name =str_replace(" ","_",$_FILES['newPhoto'] ['name']);
		$temp=$_FILES['newPhoto'] ['tmp_name'];
		move_uploaded_file($temp,"photo/".$name);
		$imagePath="photo/$name";
		$query="UPDATE users SET firstName='$firstName',lastName='$lastName',email='$email',phone='$phone',dob='$dob',photo='$imagePath' WHERE uid='$uid'";
		$result=mysqli_query($con,$query);
		if ($result) {
			header('location:../profile?updated');
			//echo "Updated with photo";
		}
	}
}
if (isset($_POST['passUpdate'])) {
	$password=$_POST['password'];
	$uid=$_SESSION['id'];
	if ($password<6) {
		header('location:../profile?pass5');
	}else{
		$query="UPDATE users SET password='$password' WHERE uid='$uid'";
		$result=mysqli_query($con,$query);
		if ($result) {
			header('location:../profile?passUpdated');
			//echo "Updated without photo";
		}
	}
}
if (isset($_GET['status'])) {
	$status=$_GET['status'];
	$uid=$_GET['id'];
	$query="UPDATE users SET status='$status' WHERE uid='$uid'";
		$result=mysqli_query($con,$query);
		if ($result) {
			header('location:../admin/users?Schanged');
			//echo "Updated without photo";
		}
}if (isset($_GET['UDelete'])) {
	
	$uid=$_GET['id'];
	//echo $uid;
	$query="DELETE FROM users WHERE uid='$uid'";
		$result=mysqli_query($con,$query);
		if ($result) {
			header('location:../admin/users?deleted');
			//echo "Updated without photo";
		}
}
?>
