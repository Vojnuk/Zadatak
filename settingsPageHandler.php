<?php
	include_once "server.php";

	session_start();
	
	$username = $_SESSION["username"];
	$firstName = $_POST["firstName"];
	$lastName = $_POST["lastName"];
	$double = doubleval($_POST["double"]);
	$tel = $_POST["tel"];
	$email = $_POST["email"];
	$bio = $_POST["bio"];

	$data = "INSERT INTO Podaci_o_Korisniku (
		username,
		id,
		firstName,
		lastName,	
		doubleNum,
		tel,	
		email,	
		bio
	) VALUES (
		'$username',
		null,
		'$firstName',
		'$lastName',
		'$double',
		'$tel',
		'$email',
		'$bio'
	)";
	
	
	if(mysqli_query($conn, $data)){
	  //echo "<br><span style='color:green;'>Data added </span>  ";
	  $ID = mysqli_insert_id($conn);
	  $_SESSION["lastQueryId"] = $ID;
	  header('Location: successPage.php');
	} else {
	  echo "<br><span style='color:red;'>Error:</span> while adding data - " . $data . mysqli_error($conn);
	}


?>