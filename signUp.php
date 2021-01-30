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
    //also adding username to Korisnicki podaci radi konekcije
    $sql = "INSERT INTO `Podaci_o_Korisniku`(
        `username`, 
        `tel`,
        `email` 
        ) VALUES (
            '$sanitizedUsername', 
            '+381 00 0000000', 
            'oo@oo'
            )";
    if($result = mysqli_query($conn,$sql)){
    } else "Error " . mysqli_error($conn);
}else{
    echo "Duplicate user";
}
?>