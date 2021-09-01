<?php
	include('../../../include/db.php');

	$amount = trim($_POST['amount']);
	$fn = trim($_POST['fn']);
	$ln = trim($_POST['ln']);
	$surname = trim($_POST['surname']);
	$village_name = trim($_POST['village-name']);

	if(strlen($amount) > 0 && strlen($fn) > 0 && strlen($ln) > 0 && strlen($surname) > 0 && strlen($village_name) > 0)
	{
		//if person is already added
		/*$check = mysqli_query($con, "SELECT * FROM persons WHERE Email='$email' ");
		if(mysqli_num_rows($check)==1)
		{
			echo '<p style="color: #9F6000;font-weight: bold;">This person is already added.</p>';
		}
		else
		{*/
			mysqli_query($con, "INSERT INTO persons(Amount, First_Name, Last_Name,Surname , 	Village_Name) VALUES('$amount','$fn','$ln','$surname','$village_name') ");
			if(mysqli_error($con)=="")
			{
				echo '<p style="color: #4F8A10;font-weight: bold;">Information Added Successfully!</p>';
			}
			else
			{
				echo '<p style="color: #D8000C;font-weight: bold;">Something Went Wrong, Try Again.</p>';
			}
		//}
	}
	else
	{
		echo '<p style="color: #D8000C;font-weight: bold;">Please fill all the details.</p>';
	}
?>