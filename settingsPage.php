<?php
	// vecina koda i redirekcija ide u settingsPageHandler.php jer redirekcija
	// ide direct na success stranu sa login strane ako se Header(Location) nalazi ovde
	include_once 'server.php';
	session_start();
	$username = $_SESSION["username"];
	// ovime hvatamo najnoviji id Podataka o Korisniku, 
	$dataId = "SELECT MAX(id) FROM `Podaci_o_Korisniku` WHERE `username`='$username'";
	$id;
	if($result = mysqli_query($conn,$dataId)){
		while($row = mysqli_fetch_assoc($result)) {
			$id = $row["MAX(id)"];
		}
		
	} else echo "<br>Error for id query: " . mysqli_error($conn);
	
	// kako bismo kombinacijom id i username dobili najnovije (tj. zadnje sacuvane) firstName i lastName
	$sql = "SELECT `firstName`, `lastName` FROM `Podaci_o_Korisniku` WHERE `username`='$username' AND `id`='$id'";
	if($result = mysqli_query($conn,$sql)){
		
		while($row = mysqli_fetch_assoc($result)) {
			$first = $row["firstName"];
			$last = $row["lastName"];
			
		}
		
	} else echo "<br>Error for fullname query: " . mysqli_error($conn);

	$user = $first . " " . $last;

?>

<!DOCTYPE html>

<html lang="sr">
	<header>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta title="Podešavanja">
		<meta charset="utf-8">
        <link rel="stylesheet" href="/style.css">
        <script src="/settingsPage.js"></script>
	</header>

	<body>
        
		<div class="container">
			<p class="user" style="color: darkblue;"><?php echo $user ?></p>
			<div class="header">
				
				<h1>Podešavanje profila</h1>
				
			</div>
			<div class="centered-form__box minimalWidth">
				
				<form id="settingsForm" action="settingsPageHandler.php" method="post">
					<label for="firstName">Ime:</label>
					<input name="firstName" type="text" value="<?php htmlspecialchars($_POST["firstName"]) ?>">

					<label for="lastName">Prezime:</label>
					<input name="lastName" type="text" value="<?php htmlspecialchars($_POST["lastName"]) ?>">

					<label for="double">DOUBLE format broja:</label>
					<input name="double" type="text" value="<?php htmlspecialchars($_POST["double"]) ?>" placeholder="2.22">
					
        	        <label for="tel">Broj telefona (format: +381 64 1234567): <span style="color: red;">*</span></label>
					<input id="tel" name="tel" type="tel" placeholder="+381 64 1234567" pattern="^\+\d{3} \d{2} (\d{7})" value="<?php htmlspecialchars($_POST["tel"]) ?>" required>
					
        	        <label for="email" >Mejl adresa: <span style="color: red;">*</span></label>
					<input id="email" name="email" type="email" placeholder="nikola@gmail.com" value="<?php htmlspecialchars($_POST["email"]) ?>" required>

					<label for="bio" >Bio:</label>
					<textarea id="bio" name="bio" value="<?php htmlspecialchars($_POST["bio"]) ?>"></textarea>
	
					<button style="margin: auto;">Sačuvaj podešavanja</button>
				</form>
			</div>
		</div>

	</body>
</html>