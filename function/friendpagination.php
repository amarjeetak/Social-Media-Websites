<?php
	$query="select * from users";
	$run=mysqli_query($con,$query);
	$total_post=mysqli_num_rows($run);
	$total_pages=ceil($total_post/$per_page);

	echo "

	<div id='pagination'>
		<center>
			<a href='friends.php?page=1'>First page</a>";

		for ($i=1; $i <$total_pages ; $i++) { 
		echo "<a href='friends.php?page=$i'>&nbsp$i</a>";
		}
		echo "<a href='friends.php?page=$total_pages' >&nbspLast page</a></center></div>";
?>