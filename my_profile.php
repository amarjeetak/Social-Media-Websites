<!DOCTYPE html>
<?php
session_start();
include("db/db.php");
include("function/function.php");
?>
<html>
<head>
	<title></title>
	 <meta name="viewport" content="width=device-width, initial-scale=1">
	  
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="maincontent">
	<div id="header">
		<div id="logo">
			MANIT SOCIAL NETWORKING WEBSITE
		</div>
	</div>
	<div class="navbar">
		<?php
		if (isset($_SESSION['email'])) {
			# code...
		
				$email=$_SESSION['email'];
				$user="select * from users where user_email='$email' ";
				$run=mysqli_query($con,$user);
				$row=mysqli_fetch_array($run);
				$user_id=$row['user_id'];
				$user_name=$row['user_name'];
				$desc=$row['desc_user'];
				$user_img=$row['user_img'];
				$user_dob=$row['dob'];
				$_SESSION['user_id']=$user_id;
				//to count the number of posts that user has posted
				$post_query="select * from posts where user_id='$user_id' ";
				$run_posts=mysqli_query($con,$post_query);
				$count_posts=mysqli_num_rows($run_posts);

				//to count the number of unread messages
				$msg_query="select * from message where reciever='$user_id' and status='unread' order by 1 desc ";
				$run_msg=mysqli_query($con,$msg_query);
				$count_msg=mysqli_num_rows($run_msg);
	echo "<ul>
			<li><a href='index.php'>Home</a></li>
			<li><a href='my_profile.php'>Profile</a>
				<ul>
					<li><a href='myprofile.php?user_id=$user_id'>Change Profile</a></li>
					<li><a href='changepassword.php'>Change Password</a></li>
					<li><a href='logout.php'>Log Out</a></li>
				</ul>
			</li>
			<li><a href='#'>Blog</a>
				<ul>
					<li><a href='my_message.php?Inbox&user_id=$user_id'>Message ($count_msg)</a></li>
					<li><a href='my_post.php?user_id=$user_id'>Posts ($count_posts)</a></li>
					<li><a href='#'>Friends</a></li>
				</ul>
			</li>
			<li><a href='friends.php'>All Friends</a></li>
			<li><a href='#'>Contact</a></li>
		
		
			<form method='post' action='#' id='searchbox'>
				<input type='text' name='search' placeholder='Seach...'' />
				<input type='submit' name='search' value='Search'>
			</form>
			</ul>
	</div>
	
		<div id='left'>
			
				<center>
					<img src='images/$user_img'  />
				</center>
				<div id='user_details'>
					<p><center><h2>$user_name</h2></center>
					<center><strong>$desc</strong></center></p>
					</br>
					
				</div>";
			}
			else {
				# code...
				echo "<script>alert('Login First')</script>";
				echo "<script>window.open('login.php','_self')</script>";
			}
			?>
		
		
		</div>
		
		<div id="content">
		
		
			<div class="loginform">
				
					

				

				<h1>My Profile </h1>
		<form  method="post" action="" enctype="multipart/form-data" autocomplete="off">
			<p> Name</p>
			<input type="text" name="user_name" value="<?php echo $user_name; ?>">
			<p>Email</p>
			<input type="text" name="user_email" value="<?php echo $email; ?>">
			
			<p>Status </p>
			<input type="text" name="user_desc" value="<?php echo $desc; ?>">


			<p>D.O.B</p>
			<input type="date" name="dob" value="<?php echo $user_dob; ?>" disabled>
				
			<p> Change Image</p>
			<input type="file" name="user_img">
			
			<input type="submit" name="update" value="Update Profile"><br>
		
		</form>
		<?php
		global $con;

			if (isset($_POST['update'])) {
				$user_name=$_POST['user_name'];
				$user_email=$_POST['user_email'];
				$user_desc=$_POST['user_desc'];
				$u_dob=$_POST['dob'];

				$img=$_FILES['user_img']['name'];
				
				$user_temp_img=$_FILES['user_img']['tmp_name'];
				if ($img=='') {
					$img=$user_temp_img=$user_img;
				}
				$query="update users set user_name='$user_name',user_email='$user_email',desc_user='$user_desc',user_img='$img' where user_id='$user_id' ";
				$run=mysqli_query($con,$query);
				if ($run) {
					move_uploaded_file($user_temp_img,"images/$img");
					echo "<script>alert('Profile Updated sucessfully')</script>";
					echo "<script>window.open('my_profile.php','_self')</script>";
				}
				else
				{
					echo "<script>alert('something went wrong')</script>";
				}


			}

		?>
			</div>
		</div>
		
		<div id="right">

		</div>
	
		
</div>

</body>
</html>