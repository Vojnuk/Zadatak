<?php

include_once("server.php");

session_start();

$sanitizedUsername = htmlspecialchars($_POST["username"]); 
$sanitizedPass = htmlspecialchars($_POST["password"]); 
$sql = "INSERT INTO `Korisnicki_Nalozi`(
    `username`, 
    `pass`
    ) VALUES (
        '$sanitizedUsername',
        '$sanitizedPass'
        )";


if($result = mysqli_query($conn,$sql)){
    echo "User added";
    $_SESSION["username"] = $sanitizedUsername;
}else{
    echo "Duplicate user";
}
?>