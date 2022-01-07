<?php
	$con = mysqli_connect("127.0.0.1","root","");
	if($con==NULL){
		echo "Error establishing database connection.";
	}
	else{
		mysqli_select_db($con, "address_book");
	}
?>