<?php
include('../../../include/db.php');

$id = trim($_POST['id']);
$village = trim($_POST['village']);
$district = trim($_POST['district']);
$taluka = trim($_POST['taluka']);

if(strlen($id) > 0 && strlen($village) > 0 && strlen($district) > 0 && strlen($taluka))
{
	mysqli_query($con,"UPDATE `location` SET `Village_Name` = '$village', `Taluka_Name` = '$taluka', `District_Name` = '$district' WHERE `ID` = $id;");
	if(mysqli_error($con) == "")
	{
		echo '<p class="text-center" style="color: #4F8A10;font-weight: bold;">Village details successfully updated.</p>';
	}
	else
	{
		echo '<p class="text-center" style="color: #D8000C;font-weight: bold;">Something Went Wrong, Try Again.</p>';
	}
}
else
{
	echo '<p class="text-center"  style="color: #D8000C;font-weight: bold;">Please fill all the details.</p>';
}
?>