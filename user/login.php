<?php 
	include ("../db/db.php");
	session_start();

	error_reporting(0);
	if(isset($_POST['autentificare'])){

		$username=$_POST['username'];
		$parola=$_POST['parola'];
		$eroare='';

		if(!empty($username) && !empty($parola)){

			$sql="SELECT * FROM Cititori WHERE username='$username' AND parola='$parola' LIMIT 1;";
			$rezultat=mysqli_query($db,$sql);


			if(mysqli_num_rows($rezultat) != 0){
				//Procesul de autentificare
				$rand=mysqli_fetch_assoc($rezultat);
				$status_verificare=$rand['status_verificare'];

				if($status_verificare==1){
					$_SESSION['username']=$username;
					header("Location:index.php");
				}else{
					$eroare='Contul nu a fost verificat!';
				}
			}else{
				$eroare='Username-ul sau parola sunt invalide!';
			}
		}else{
			$eroare='Toate campurile sunt obligatorii!!';
		}
	}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="icon" type="image/x-icon" href="../imagini/carte.png">
	<title>Biblioteca Virtuală - Lieceul Teoretic "Ioan Petruș - Login</title>
</head>
<body class="fundal">
	<?php 
	include '../includeri/antet.php';
	include '../includeri/meniu.php';
	?>


	<div class="login">
		<div class="login_container">
			<div class="formlogin">
				<div id="container_form_login">
					<h2 class="titlulogin">Login</h2>
					<center>
						<span style="color:red; font-weight: bold;"><?php echo $eroare; ?></span>
					</center>
					<div class="formgroup_login">
					<form action="login.php" method="POST">
						<label for="username">Username:</label><br/>
						<input type="text" name="username" placeholder="Introduceți username-ul dvs."><br/>
						<label for="parola">Parola:</label><br/>
						<input type="password" name="parola" id="parola" placeholder="Introduceți parola dvs."><br>
						<input type="checkbox" onclick="ArataParola()">Arată parola<br/><br/>
						<input class="inputlogin" type="submit" name="autentificare" value="Autentificare"><br/><br/>
						<p style="margin-left: -40px;">Dacă nu aveți cont, puteți să vă înregistrați<a style="color: blue;" href="inregistrare.php">aici</a>!</p>
						<a style="color:blue; margin-left: 55px;" href="emailresetare.php">Ați uitat parola?</a>
					</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		function ArataParola(){
			var x = document.getElementById("parola");
			var y = document.getElementById("confparola");
			if(x.type==="password"){
				x.type="text";
				y.type="text";
			}else{
				x.type="password";
				y.type="password";
			}
		}
	</script>

	<?php
	include '../includeri/subsol.php';
	?>
</body>
</html>