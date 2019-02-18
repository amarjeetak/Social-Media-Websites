<?php
include("db/db.php");
?>
<?php
function registration()
{
	global $con;
	if (isset($_POST['signup'])) {
		# code...
		$name=$_POST['user_name'];
		$email=$_POST['user_email'];
		$Country=$_POST['Country'];
		$Gender=$_POST['Gender'];
		$dob=$_POST['dob'];
		$user_pass=$_POST['user_pass'];
		$conf_pass=$_POST['conf_pass'];
		$status="verified";
		$posts="no";
		$relation="----";
		$desc="Welcome to Manit Web";
		$verifycode=mt_rand(1000,9999);
		if (strlen($user_pass)<8) {
			echo "<script>alert('Password should be minimum of 8 character')</script>";
			exit();
		}
		else if ($user_pass!=$conf_pass) {
			echo "<script>alert('Password does not match')</script>";
			exit();
		}
		else
		{
			$check_email="select * from users where user_email ='$email' ";
			$run_email=mysqli_query($con,$check_email);
			if(mysqli_num_rows($run_email)==1)
			{
				echo "<script>alert('Email Already Exist Please Try Again')</script>";
				echo "<script>window.open('signup.php','_self')</script>";
				exit();
			}
			else
			{
				$query="insert into users (user_name,user_email,desc_user,relation,user_pass,user_country,user_gender,user_img,user_reg_date,status,verifycode,posts,dob)values('$name','$email','$desc','$relation','$user_pass','$Country','$Gender','userdefault_img.png',NOW(),'$status','$verifycode','$posts','$dob')";
			
				$run=mysqli_query($con,$query);
				if($run)
				{
					echo "<script>alert('Sucessfully Registered  Congrutulation $name')</script>";
				}
				else
				{
					echo "<script>alert('Registration Failed  Please Try Again')</script>";
				}
			}

		}
		
	}
	//echo "Hi Amarjeet";
}


function insertpost()
{
	if (isset($_POST['post'])) {
		global $con;
		global $user_id;
		$content=addslashes($_POST['content']);
		if ($content=='') {
			echo "<script>alert('Please write something first to post')</script>";
			
			exit();
		}
		else
		{
			$insert="insert into posts (user_id,post_content,post_date) values('$user_id','$content',NOW()) ";
			$run=mysqli_query($con,$insert);
			if ($run) {
				//echo "<script>alert('Post Posted sucessfully')</script>";
				$update="update users set posts='yes' where user_id='$user_id' ";
				$run_update=mysqli_query($con,$update);
			
				echo "<meta http-equiv='refresh' content='0'>";
			}
		}
	}
}

function getposts()
{
	global $con;
	global $per_page;
	$per_page=4;
	if (isset($_GET['page'])) {
		$page=$_GET['page'];

	}
	else
	{
		$page=1;
	}
	
	$start_from=($page-1)*$per_page;
	$getposts="select * from posts order by 1 desc limit $start_from,$per_page";
	$run=mysqli_query($con,$getposts);
	while ($row=mysqli_fetch_array($run)) {
		$post_id=$row['post_id'];
		$user_id=$row['user_id'];
		$content=substr($row['post_content'],0,70);
		$post_date=$row['post_date'];

		//getting user details who send this posts
		$user="select * from users where user_id='$user_id' and posts='yes' ";
		$run_user=mysqli_query($con,$user);
		$row_user=mysqli_fetch_array($run_user);
		$user_name=$row_user['user_name'];
		$user_img=$row_user['user_img'];

		//display the posts 

		echo "<div id='post'>
		<p><img src='images/$user_img' width='80px' height='80px'></p>
		<h3><a href='profile.php?user_id=$user_id'>$user_name</a>
		&nbsp <small style='color:black;'>Updated a post on $post_date</small></h3>
		<p style='color:white;'>$content</p>
		<a href='single.php?post_id=$post_id' style='float:right;'><button>Comment</button></a>
		</div></br></br>";

	}
	include("pagination.php");
}

function singlepost()
{
	if (isset($_GET['post_id'])) {
		global $con;

		$post_id=$_GET['post_id'];

		$post="select * from posts where post_id='$post_id' ";
		$run_post=mysqli_query($con,$post);
		$row=mysqli_fetch_array($run_post);

		$user_id=$row['user_id'];
		$post_content=$row['post_content'];
		$post_date=$row['post_date'];
	
		//user who send comment
		$user="select * from users where user_id='$user_id' and posts='yes' ";
		$run_user=mysqli_query($con,$user);
		$run_row=mysqli_fetch_array($run_user);

		$user_name=$run_row['user_name'];
		$user_img=$run_row['user_img'];


		$user_comment=$_SESSION['email'];
		$comment="select * from users where user_email='$user_comment' ";
		$run_comment=mysqli_query($con,$comment);
		$run_comment_row=mysqli_fetch_array($run_comment);

		$user_comm_id=$run_comment_row['user_id'];
		$user_comm_name=$run_comment_row['user_name'];

		echo "
		<div id='post'>
			<p><img src='images/$user_img' width='80' height='80'></p>
		<h3><a href='my_profile.php?user_id=$user_id'>$user_name</a>
		&nbsp <small style='color:black;'>Posted on $post_date</small></h3>
		<p style='color:white;'>$post_content</p>
		
		</div></br></br>";
		include("comment.php");
		echo "<br>
		<form id='reply' method='post'>
			<textarea cols='40' rows='3' name='comment' placeholder='Reply...'></textarea>
			<br>
			<p style='text-align:center;'><input type='submit' name='reply' value='Reply' /></p>

		</form>";
			if (isset($_POST['reply'])) {
				$reply=$_POST['comment'];
				$insert="insert into comments (post_id,user_id,comment,comment_author,date)values('$post_id','$user_comm_id','$reply','$user_comm_name',NOW())";
				$run=mysqli_query($con,$insert);
				if($run)
				{
					//echo "<script>alert('Reply posted sucessfully')</script>";
					echo "<script>window.open('single.php?post_id=$post_id','_self')</script>";
					echo "<meta http-equiv='refresh' content='0'>";
				}
			}

	}
}

function myposts()
{
	global $con;
	global $per_page;
	$user_id=$_GET['user_id'];
	$per_page=4;
	if (isset($_GET['page'])) {
		$page=$_GET['page'];

	}
	else
	{
		$page=1;
	}
	
	$start_from=($page-1)*$per_page;
	$getposts="select * from posts,users where  users.user_id=posts.user_id and posts.user_id='$user_id' order by 1 desc limit $start_from,$per_page";
	$run=mysqli_query($con,$getposts);
	if (mysqli_num_rows($run)==0) {
		echo "<h1 style='text-align:center;color:white;'>No Post is posted </h1>";
	}
	else
	{
	while ($row=mysqli_fetch_array($run)) {
		$post_id=$row['post_id'];
		
		$content=substr($row['post_content'],0,70);
		$post_date=$row['post_date'];

		
		$user_name=$row['user_name'];
		$user_img=$row['user_img'];

		//display the posts 

		echo "<div id='post'>
		<p><img src='images/$user_img' width='80px' height='80px'></p>
		<h3><a href='my_profile.php?user_id=$user_id'>$user_name</a>
		&nbsp <small style='color:black;'>Updated a post on $post_date</small></h3>
		<p style='color:white;'>$content</p>
		
		
		<a href='single.php?post_id=$post_id' style='float:right;'><button>Comment</button></a>
		<a href='delete.php?delete&post_id=$post_id' style='float:right;'><button>Delete</button></a>
		<a href='edit.php?edit&post_id=$post_id' style='float:right;'><button>Edit</button></a>

		</div></br></br>";

	}
}
	include("mypostpagination.php");
}


function updatepost()
{
	if (isset($_POST['update'])) {
		global $con;
		global $post_id;
		$user_id=$_SESSION['user_id'];
		
		$content=addslashes($_POST['content']);
			$update="update posts set post_content='$content' where post_id='$post_id' ";
			$run=mysqli_query($con,$update);
			if ($run) {
				echo "<script>alert('Post updated sucessfully')</script>";
		
				echo "<script>window.open('my_post.php?user_id=$user_id','_self')</script>";
				echo "<meta http-equiv='refresh' content='0'>";
			}
		
	}
}


function friends()
{
	global $con;
	global $per_page;
	$per_page=4;
	if (isset($_GET['page'])) {
		$page=$_GET['page'];

	}
	else
	{
		$page=1;
	}
	$us_id=$_SESSION['user_id'];
	$start_from=($page-1)*$per_page;
	$getposts="select * from users where user_id <>'$us_id' order by user_name limit $start_from,$per_page";
	$run=mysqli_query($con,$getposts);
	while ($row=mysqli_fetch_array($run)) {
		
		
		$user_name=$row['user_name'];
		$user_id=$row['user_id'];
		$user_img=$row['user_img'];
		$user_email=$row['user_email'];
		$user_desc=$row['desc_user'];
		$user_reg_date=$row['user_reg_date'];
		//display the posts 

		echo "<div id='post'>
		<p><img src='images/$user_img' width='80px' height='80px'></p>
		<h3><a href='profile.php?user_id=$user_id'>$user_name</a>
		&nbsp <small style='color:black;'>Joined  on $user_reg_date</small></h3>
		<p style='color:black ; font-family:bold; font-size:18px;'>$user_email</p>
		<p style='color:white;'>$user_desc</p>
		<a href='send_message.php?u_id=$user_id' style='float:right;'><button>Send Message</button></a>
		</div></br></br>";

	}
	include("friendpagination.php");
}

function insertmessage()
{
	if (isset($_POST['post'])) {
		global $con;
		global $user_id;
		$content=addslashes($_POST['content']);
		$reciever_id=$_POST['reciever_id'];
		if ($content=='') {
			echo "<script>alert('Please write something first to send')</script>";
			
			exit();
		}
		else
		{
			$insert="insert into message (sender,reciever,msg_subject,reply,status,msg_date) values('$user_id','$reciever_id','$content','no_reply','unread',NOW()) ";
			$run=mysqli_query($con,$insert);
			if ($run) {
				echo "<script>alert('Message is sucessfully send')</script>";
				//$update="update users set posts='yes' where user_id='$user_id' ";
				//$run_update=mysqli_query($con,$update);
			
				echo "<meta http-equiv='refresh' content='0'>";
			}
		}
	}
}


function getmessage()
{
	global $con;

	if (isset($_GET['msg_id'])) {
					$msg_id=$_GET['msg_id'];
					$send_name=$_GET['send_name'];
					$message="select * from message where msg_id=$msg_id ";
					$run_message=mysqli_query($con,$message);
					$row_message=mysqli_fetch_array($run_message);
					$message=$row_message['msg_subject'];
					echo " 
					<br><p style='margin-left:80px;font-weight:bolder;font-size:24px;color:white;'>Message : send by $send_name</p><br><div id='post'>
							<textarea style='color:white; background:orange; padding-left:10px;'cols='57' rows='4' disabled>$message</textarea>
					</div>
					";
					echo"
					<form method='post' action='my_message.php'  id='f'>
				<textarea cols='50'  rows='5'  placeholder='Enter something to Reply ....'  name='reply_content' style='margin-left:250px;'></textarea><br><br>
				<input type='hidden' name='msg_id' value='$msg_id'>
				<input type='submit' name='reply'  value='Reply'style='margin-left:420px;'>
			</form>";
			$check="select * from message where msg_id='$msg_id' and status='unread' ";
			$run_check=mysqli_query($con,$check);
			$count=mysqli_num_rows($run_check);
			if ($count) {
				# code...
			
				$update="update message set status='read' where msg_id='$msg_id' ";
				$run=mysqli_query($con,$update);
				if ($run) {
					echo "<meta http-equiv='refresh' content='0'>";
				}
			}
			}
}


?>