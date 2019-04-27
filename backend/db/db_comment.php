<?php
session_start();
include('db.php');
date_default_timezone_set('Asia/Dhaka');
if (isset($_POST['comm'])) {
	$comment=$_POST['comment_body'];
	$post_id=$_POST['post_id'];
	$uid=$_SESSION['id'];
	$datetime=date('m/d/Y h:i:s a', time());

	$query="INSERT INTO comment VALUES('','$comment','$post_id','$datetime','$uid','1')";
	$result=mysqli_query($con,$query);
		if ($result) {
			header('location:../index?commented');
				//echo "Done";
		}else{
			header('location:../index?error');
				//echo "Error";
		}

}
if (isset($_POST['commDelete'])) {
	$id=$_POST['id'];

	$query="DELETE FROM comment WHERE cid='$id' ";
	$result=mysqli_query($con,$query);
	if ($result) {
		header('location:../admin/story?Cdeleted');
	}
}
?>