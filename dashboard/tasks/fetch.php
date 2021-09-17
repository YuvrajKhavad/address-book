<?php
	include('../../include/db.php');
	$row = mysqli_fetch_array(mysqli_query($con, "SELECT count(*) FROM persons"));
	echo $personsCount = $row[0];
?>