<?php
session_start();
include("db/db.php");
?>

<?php
	global $con;
	$post_id=$_GET['post_id'];
	$user_id=$_SESSION['user_id'];
	echo $post_id;
	$query1="delete from posts where post_id='$post_id' ";
	$run=mysqli_query($con,$query1);
	$query2="delete from comments where post_id='$post_id' ";
	$run1=mysqli_query($con,$query2);
	if ($run) {
		# code...
		echo "<script>alert('Post deletion is sucessfully')</script>";
		echo "<script>window.open('my_post.php?user_id=$user_id','_self')</script>";
		exit();
	}
	else
	{
		echo "<script>alert('Sorry Please Try Again')</script>";
		echo "<script>window.open('my_post.php?user_id=$user_id','_self')</script>";
		exit();
	}


?>