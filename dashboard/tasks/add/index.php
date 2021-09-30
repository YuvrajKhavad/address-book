<?php
	include('../../../include/db.php');

	$amount = trim($_POST['amount']);
	$fn = trim($_POST['fn']);
	$ln = trim($_POST['ln']);
	$surname = trim($_POST['surname']);
	$village_name = trim($_POST['village-name']);

	if(strlen($amount) > 0 && strlen($fn) > 0 && strlen($ln) > 0 && strlen($surname) > 0 && strlen($village_name) > 0)
	{
		mysqli_query($con, "INSERT INTO location(Village_Name) VALUES('$village_name')");
		$last_id = mysqli_insert_id($con);
		mysqli_query($con, "INSERT INTO persons(Amount, First_Name, Last_Name,Surname , Village_Name) VALUES('$amount','$fn','$ln','$surname','$last_id') ");
		if(mysqli_error($con)=="")
		{
			echo '<p style="color: #4F8A10;font-weight: bold;">Information Added Successfully!</p>';
		}
		else
		{
			echo '<p style="color: #D8000C;font-weight: bold;">Something Went Wrong, Try Again.</p>';
		}

	}
	else
	{
		echo '<p style="color: #D8000C;font-weight: bold;">Please fill all the details.</p>';
	}
?>