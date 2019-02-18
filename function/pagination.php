<?php
	$query="select * from posts";
	$run=mysqli_query($con,$query);
	$total_post=mysqli_num_rows($run);
	$total_pages=ceil($total_post/$per_page);

	echo "

	<div id='pagination'>
		<center>
			<a href='index.php?page=1'>First page</a>";

		for ($i=1; $i <$total_pages ; $i++) { 
		echo "<a href='index.php?page=$i'>&nbsp$i</a>";
		}
		echo "<a href='index.php?page=$total_pages' >&nbspLast page</a></center></div>";
?>