<?php
	include('../../../include/db.php');	
	// $fn = trim($_POST['updatefn']);
	// $ln = trim($_POST['updateln']);		
	// $name = $fn.' '.$ln;
	// $email = trim($_POST['email']);		
	// $mobile = trim($_POST['updatemobile']);
	// $permanant = trim($_POST['updatepermanant']);
	// $temporary = trim($_POST['updatetemporary']);
	// if(strlen($fn) > 0 && strlen($ln) > 0 && strlen($mobile) > 0 && strlen($email) > 0 && strlen($permanant) > 0 && strlen($temporary) > 0){		
	// 	mysqli_query($con,"UPDATE persons SET Name='$name', Mobile='$mobile', Permanant_Address='$permanant', Temporary_Address='$temporary' WHERE Email='$email' ");
	// 	if(mysqli_error($con)==""){
	// 		echo '<p style="color: #4F8A10;font-weight: bold;">Person Updated Successfully!</p>';
	// 	}
	// 	else{
	// 		echo '<p style="color: #D8000C;font-weight: bold;">Something Went Wrong, Try Again.</p>';
	// 	}
	// }
	// else{
	// 	echo '<p style="color: #D8000C;font-weight: bold;">Please Fill All The Details.</p>';
	// }	
	
	  $id = trim($_POST['id']);
	  $amount = trim($_POST['amount']);
	  $firstname = trim($_POST['firstname']);		
	  $Lastname = trim($_POST['Lastname']);
	  $surname = trim($_POST['surname']);		
	  //$villagename = trim($_POST['villagename']);

	  $village_name = (empty($_POST['villageid']))?trim($_POST['villagename']):$_POST['villageid'];
	
 	if(strlen($amount) > 0 && strlen($firstname) > 0 && strlen($Lastname) > 0 && strlen($surname) > 0 && strlen($village_name) > 0){	
		
		//echo $_POST['villageid'];
		if(empty($_POST['villageid']))
		{
			mysqli_query($con, "INSERT INTO location(Village_Name) VALUES('$village_name')");
			$last_id = mysqli_insert_id($con);
		}
		else
		{
			$last_id = $_POST['villageid'];
		}

		mysqli_query($con,"UPDATE `persons` SET `Amount`='$amount',`First_Name`='$firstname',`Last_Name`='$Lastname',`Surname`='$surname',`Village_Name`= $last_id WHERE `ID`=$id;");
		if(mysqli_error($con)==""){
			echo '<p style="color: #4F8A10;font-weight: bold;">Success</p>';
		}
		else{
			echo '<p style="color: #D8000C;font-weight: bold;">Something Went Wrong, Try Again.</p>';
		}
	}
	else{
		echo '<p style="color: #D8000C;font-weight: bold;">Please Fill All The Details.</p>';
	}	
?>