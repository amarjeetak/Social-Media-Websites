
<?php

	$query="select * from posts where user_id='$user_id' ";
	$run=mysqli_query($con,$query);
	$total_post=mysqli_num_rows($run);
	$total_pages=ceil($total_post/$per_page);

	echo "

	<div id='pagination'>
		<center>
			<a href='my_post.php?page=1&user_id=$user_id'>First page</a>";

		for ($i=1; $i <$total_pages ; $i++) { 
		echo "<a href='my_post.php?page=$i&user_id=$user_id'>&nbsp$i</a>";
		}
		echo "<a href='my_post.php?page=$total_pages&user_id=$user_id' >&nbspLast page</a></center></div>";
?>