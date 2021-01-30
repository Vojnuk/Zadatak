<?php
	include_once "server.php";

	session_start();

	$ID = $_SESSION["lastQueryId"];
?>

<!DOCTYPE html>

<html lang="sr">
	<header>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta title="Zadatak/Prijavite se">
		<meta charset="utf-8">
		<link rel="stylesheet" href="/style.css">
	</header>

	<body>
		<div class="centered-form" >
    	<div class="centered-form__box minimalWidth">    
			<div style="text-align: center;">
    			<h1 >Uspešno ste sačuvali podatke</h1>
				<p>Podaci su sačuvani pod Id brojem <span style="color: green;"><?php echo $ID ?></span>.</p>
			</div>
		</div>

	</body>
</html>