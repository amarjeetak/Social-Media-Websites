<?php
session_start();
include("db/db.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="loginstyle.css">
</head>
<body>
	<div class="loginform">
		
		<h1>Login Here</h1>
		<form method="post" action="login.php" autocomplete="off">
			<p>User Name</p>
			<input type="text" name="user_name" placeholder="Enter Your User Name">
			<p>Password</p>
			<input type="Password" name="user_pass" placeholder="Enter Your Password">
			<input type="submit" name="submit" value="Login"><br>
			<a href="#">Lost Your Password ?</a><br>
			<a href="signup.php">Don't Have Account ?</a>
		</form>

	</div>
</body>
</html>
<?php

if (isset($_SESSION['email'])) {
	global $con;
	echo "<script>window.open('index.php','_self')</script>";
}
else
{
	if (isset($_POST['submit'])) {
		$email=$_POST['user_name'];
		$user_pass=$_POST['user_pass'];

		$query="select * from users where user_email='$email' and user_pass='$user_pass' and status='verified' ";
		$run=mysqli_query($con,$query);
		if(mysqli_num_rows($run)==1)
		{
			$_SESSION['email']=$email;
			
			echo "<script>window.open('index.php','_self')</script>";
		}
		else
		{
			echo "<script>alert('Incorrect Username Or Password Please Try Again')";
			exit();
		}
	}
}

?>