<?php

session_start();
	if($_SESSION['user_ids'] == "" )
	{
	header("location:Logout.php");
	}
	 
	 
	else{
		$user_ids = $_SESSION["user_ids"]; 
		$staff_depart = $_SESSION["staff_depart"]; 
		 
	}
 
?>