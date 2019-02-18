<?php
	
	$get_id=$_GET['post_id'];
	$comment="select * from comments where post_id='$get_id' order by 1 desc ";
	$run_comment=mysqli_query($con,$comment);
	while ($row=mysqli_fetch_array($run_comment)) {
		$comment=$row['comment'];
		$comment_name=$row['comment_author'];
		$comment_date=$row['date'];

		echo "
			<br>
			<div id='comments'>
			<h3><a href='my_profile.php?user_id=$user_id'>$comment_name</a></h3><span><i>Commented <i> on $comment_date</span>
			<p>$comment</p>
			</div>
		";
	}
?>