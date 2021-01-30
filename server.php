<?php

/*
NE OTVARAJ ECHO, frontent onda ne dobija odgovarajucu poruku

*/

$dbhost = "localhost:3306";
$dbuser= "voj";
$dbpass = "heya";

// konekcija
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, 'mysql');
if(! $conn ){
   //echo 'Connection failure<br>';
}
 //else echo 'Connected successfully<br>';

// Return name of current default database
if ($result = mysqli_query($conn, "SELECT DATABASE()")) {
  $row = mysqli_fetch_row($result);
  //echo "<br> <b>Default database</b> is " . $row[0];
  mysqli_free_result($result);
}

// inicijalizacija baze i tabela
// mozemo pristupiti i sa TEST.Korisnicki_Nalozi ako mysqli_select_db pravi problem
$CreateDB = "CREATE DATABASE IF NOT EXISTS TEST"; 

$CreateUserAccounts = "CREATE TABLE IF NOT EXISTS `Korisnicki_Nalozi` ( 
  `username` VARCHAR(30) PRIMARY KEY, 
  `pass` VARCHAR(30) NOT NULL
  ) ";
$CreateUserData = " CREATE TABLE IF NOT EXISTS `Podaci_o_Korisniku` ( 
  `username` VARCHAR(30),
  `id` INT AUTO_INCREMENT UNIQUE,
  `firstName` VARCHAR(30) NULL , 
  `lastName` VARCHAR(30) NULL , 
  `doubleNum` DOUBLE NULL , 
  `tel` VARCHAR(20) NOT NULL , 
  `email` VARCHAR(30) NOT NULL , 
  `bio` TEXT NULL 
)AUTO_INCREMENT = 100;";

if (mysqli_query($conn, $CreateDB)) {
  //echo "<br> Database initialized succesfully";
} else {
   //echo "<br> <span style='color:red;'>Error:</span> creating database: " . mysqli_error($conn);
}
/*
// selecting database procedural style -- NE RADI
if(mysqli_select_db('TEST', $conn)){
  //echo "DB TEST selected";
} else {
  //echo "<br> <span style='color:red;'>Error:</span> Problem procedurally selecting DB TEST - " . mysqli_error($conn);
}
*/
// selecting database OO style
try {
  $conn->select_db("TEST");
  $res = $conn->query("SELECT DATABASE()");
  $row = $res->fetch_array() ?? '';
  //echo "<br> Selecting database " . $row[0] . " OO style";
  }catch(Exception $e){
  //echo $e->getMessage();
}

// Return name of current default database
if ($result = mysqli_query($conn, "SELECT DATABASE()")) {
  $row = mysqli_fetch_row($result);
  //echo "<br> <b>Current default database</b> is " . $row[0];
  mysqli_free_result($result);
} else {
  //echo "<br><span style='color:red;'>Error:</span> " . mysqli_error($conn);
}



// creating  tables
if(mysqli_query($conn, $CreateUserAccounts)) {
  //echo "<br><br> <b>UserAccounts</b> table initialized";
} else {
  //echo "<br><br> <span style='color:red;'>Error:</span> creating table: UserAccounts - " . mysqli_error($conn);
}

if(mysqli_query($conn, $CreateUserData)) {
  //echo "<br> <b>UserData</b> table initialized";
} else {
  //echo "<br> <span style='color:red;'>Error:</span> creating table: UserData - " . mysqli_error($conn);
}

?>