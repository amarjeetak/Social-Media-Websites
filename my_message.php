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
					<li><a href='my_profile.php'>Change Profile</a></li>
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
			<p align="center" style="font-size: 20px;font-family: sans MS;font-weight: bolder;">
				<a href="my_message.php?Inbox">My inbox  </a>&nbsp||&nbsp
				<a href="my_message.php?sent">Sent</a>
			</p>
			<?php
				if (isset($_GET['sent'])) {
					include("sent.php");
				}
			?>
			<?php
				if (isset($_GET['Inbox'])) {?>
				<table width="800" style="align:center;">
					<tr style="text-align: center; font-weight: bolder;">
						<td>Message</td>
						<td>Sender</td>
						<td>Date</td>
						<td>Reply</td>
					</tr>
					<?php

						$get_message="select * from message where reciever='$user_id' order by 1 desc ";
						$run_msg=mysqli_query($con,$get_message);
						while($row_msg=mysqli_fetch_array($run_msg))
						{


						$message=substr($row_msg['msg_subject'],0,30);
						$sender=$row_msg['sender'];
						$msg_id=$row_msg['msg_id'];
						$msg_date=$row_msg['msg_date'];
						$msg_reply=$row_msg['reply'];
						$sender_query="select * from users where user_id='$sender' ";
						$run_send=mysqli_query($con,$sender_query);
						$row_send=mysqli_fetch_array($run_send);
						$send_name=$row_send['user_name'];
						echo "
						<tr><td align='center'><a href='my_message.php?Inbox&msg_id=$msg_id&send_name=$send_name'>$message</a></td>
						<td align='center'><a href='profile.php?user_id=$sender'>$send_name</a></td>
						<td align='center'>$msg_date</td>
						<td align='center'>$msg_reply</td></tr>

						";
					}
						
					

					?>
				</table>	
			<?php	}?>
			
			<?php


				getmessage();
				if (isset($_POST['reply'])) {
		$content=addslashes($_POST['reply_content']);
		$msg_id=$_POST['msg_id'];
		if ($content=='') {
			echo "<script>alert('Please write something first to reply')</script>";
			
			exit();
		}
		else
		{
			$insert="update message set reply='$content' where msg_id='$msg_id' ";
			$run=mysqli_query($con,$insert);
			if ($run) {
				echo "<script>window.open('my_message.php?Inbox','_self')</script>";
				//$update="update users set posts='yes' where user_id='$user_id' ";
				//$run_update=mysqli_query($con,$update);
			
				//echo "<meta http-equiv='refresh' content='0'>";
			}
		}
	}


			?>
		</div>
		<div id="right">
			
		</div>
	
		
</div>

</body>
</html>