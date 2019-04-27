<?php
session_start();
include('db.php');
date_default_timezone_set('Asia/Dhaka');
if (isset($_POST['post'])) {
	$story_title=$_POST['story_title'];
	$story_body=$_POST['story_body'];
	$tags=$_POST['tags'];
	$caption=$_POST['caption'];
	$section=$_POST['section'];
	$uid=$_SESSION['id'];
	$datetime=date('m/d/Y h:i:s a', time());
	$photo=$_FILES['image']['name'];
	$file_ext=strtolower(end(explode('.', $photo)));
	$expensions=array("jpeg","jpg","png");

	if (in_array($file_ext, $expensions)==false) {
		header('location:../index?imgtypeE');
		//echo "Photo Error";
	}else{
		$name =str_replace(" ","_",$_FILES['image'] ['name']);
		$temp=$_FILES['image'] ['tmp_name'];
		move_uploaded_file($temp,"photo/".$name);
		$imagePath="photo/$name";
		$query="INSERT INTO story VALUES('','$story_title','$story_body','$tags','$imagePath','$caption','$uid','1','$datetime','$section')";
		$result=mysqli_query($con,$query);
		if ($result) {
			header('location:../index?success');
				//echo "Done";
		}else{
			header('location:../index?error');
				//echo "Error";
		}

	}
}
if (isset($_POST['update'])) {
	$section=$_POST['section'];
	//$story_title=$_POST['story_title'];
	
	$story_title = mysqli_real_escape_string($con, $_POST['story_title']);
	//$story_body = mysqli_real_escape_string($con, $_POST['story_body']);
	$story_body=$_POST['story_body'];
	$tags=$_POST['tags'];
	$caption=$_POST['caption'];
	
	$sid=$_POST['sid'];
	$datetime=date('m/d/Y h:i:s a', time());
	$photoCheck=$_FILES['image']['name'];

	
	if ($photoCheck=='') {
		$query="UPDATE story SET `title`='$story_title', `body`='$story_body',
		tags='$tags',caption='$caption', section='$section',`datetime`='$datetime' WHERE sid='".$_POST['sid']."' ";
		$result=mysqli_query($con,$query);
		header('location:../profile?postUp');
		//echo "Not Selected";
	}else{
		
		$photo=$_FILES['image']['name'];
		$file_ext=strtolower(end(explode('.', $photo)));
		$expensions=array("jpeg","jpg","png");

		if (in_array($file_ext, $expensions)==false) {
			header('location:../post_edit?imgtypeE');
		//echo "Photo Error";
		}else{
			$name =str_replace(" ","_",$_FILES['image'] ['name']);
			$temp=$_FILES['image'] ['tmp_name'];
			move_uploaded_file($temp,"photo/".$name);
			$imagePath="photo/$name";
			$query="UPDATE story SET `title`='$story_title', `body`='$story_body',
			tags='$tags',caption='$caption',section='$section',`datetime`='$datetime',image='$imagePath' WHERE sid='".$_POST['sid']."' ";
//echo $query;
			$result=mysqli_query($con,$query);
			header('location:../profile?postUp');
			//echo "Selected";
		}
	}


}
if (isset($_GET['DPostId'])) {
	$query="DELETE FROM story WHERE sid='".$_GET['DPostId']."'";
	$result=mysqli_query($con,$query);
	if (result) {
		header('location:../profile?deleted');
	}else{
		header('location:../profile?error');
	}
}
if (isset($_POST['block'])) {
	
	$id=$_POST['id'];

	$query="UPDATE story SET s_status='0' WHERE sid='$id' ";
	$result=mysqli_query($con,$query);
	if ($result) {
		header('location:../admin/story?blocked');
	}
}
if (isset($_POST['unblock'])) {
	
	$id=$_POST['id'];

	$query="UPDATE story SET s_status='1' WHERE sid='$id' ";
	$result=mysqli_query($con,$query);
	if ($result) {
		header('location:../admin/story?unblocked');
	}
}
if (isset($_POST['delete'])) {
	
	$id=$_POST['id'];

	$query="DELETE FROM story WHERE sid='$id' ";
	$result=mysqli_query($con,$query);
	if ($result) {
		header('location:../admin/story?deleted');
	}
}
?>