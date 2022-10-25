<?php 
	include ("../db/db.php");
	session_start();
?>


<!DOCTYPE html>
<html lang="ro">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="icon" type="image/x-icon" href="../imagini/carte.png">
	<title>Opțiuni - Biblioteca Virtuală a Liceului Teoretic "Ioan Petruș" Otopeni</title>
</head>
<body class="fundal">
	<?php include ("../includeri/antet.php");?>

	<?php 
		if(isset($_SESSION['username'])){
			echo '
			<div class="bara_user">
				<span style="color:white; margin-bottom: -30px; font-size: 25px">Bine ai venit, '.$_SESSION['username'].'!</span>
			</div>
			<div class="meniu">
				<div class="container">
					<ul>
						<li><a href="index.php">Acasă</a></li>
						<li><a href="despre.php">Despre Noi</a></li>
						<li><a href="materiale.php">Materiale</a></li>
						<li><a href="contact.php">Contact</a></li>
						<li><a href="imprumuturiefectuate.php">Împrumuturi</a></li>
						<li><a href="profil.php">Profil</a></li>
						<li><a href="optiuni.php">Opțiuni Împrumut</a></li>
						<li><a href="logout.php">Log Out</a></li>
					</ul>
				</div>
			</div>';
		}
	?>

	<div style="background-color: rgba(0, 0, 255, 0.6); padding-bottom:40px;">
		<br/><br/><br/>
		<center>
			<div class="optiune_prelungire">
				<div class="container_optiune_prelungire">
					<a href="form_prelungireimprumut.php">Prelungire împrumut</a>
				</div>
			</div><br/>
			<div class="optiune_anulare">
				<div class="container_optiune_anulare">
					<a href="form_anulareimprumut.php">Anulare împrumut</a>
				</div>
			</div><br/>
		</center>
	</div>


	<?php include ("../includeri/subsol.php");?>
</body>
</html>