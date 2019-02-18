<?php
include("function/function.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="signupstyle.css">
</head>
<body>
	<div class="loginform">
		
		<h1>SignUp Here</h1>
		<form  method="post" action="signup.php" autocomplete="off">
			<p> Name</p>
			<input type="text" name="user_name" placeholder="Enter Your Name">
			<p>Email</p>
			<input type="text" name="user_email" placeholder="Enter Your Email ">
			<p>Country</p>
			
			<select name="Country">
				<option>Choose Country</option>
				<option>India</option>
				<option>Pakistan</option>
				<option>Afganistan</option>
			</select>
			<p></p>
			<p>Gender</p>
			<select name="Gender">
				<option>Choose Gender</option>
				<option>Male</option>
				<option>Female</option>
				<option>Other</option>
			</select>
			<p>D.O.B</p>
			<input type="date" name="dob" >
			<p>Password</p>
			<input type="Password" name="user_pass" placeholder="Enter Your Password">
			<p> Confirm Password</p>
			<input type="Password" name="conf_pass" placeholder="Confirm Your Password">
			
			<input type="submit" name="signup" value="SignUp"><br>
			<a href="login.php"><p text-align="center">Login</p></a>
		</form>
		<?php registration();?>
	</div>
</body>
</html>
