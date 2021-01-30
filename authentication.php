<?php
include_once("server.php");

session_start();

$sanitizedUsername = htmlspecialchars($_POST["username"]); 
$sanitizedPass = htmlspecialchars($_POST["password"]); 
$sql = "SELECT username, pass FROM Korisnicki_Nalozi WHERE username='$sanitizedUsername' AND pass='$sanitizedPass'";


if($result = mysqli_query($conn,$sql)){
  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
  $active = $row['active'];
  $count = mysqli_num_rows($result);

  if($count == 1) {
    echo "User selected";
    $_SESSION["username"] = $sanitizedUsername;

  }else {
    echo "User not found";
  }
} else {
    echo "<br>Najverovatnije ti je los SQL";
}

?>