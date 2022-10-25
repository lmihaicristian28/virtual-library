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
	<title>Biblioteca Virtuală - Lieceul Teoretic "Ioan Petruș - Contact</title>
</head>
<body class="fundal">
	<?php 
	include '../includeri/antet.php';
	?>

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
		}else{
			include '../includeri/meniu.php';
		}
	?>

	<div class="contact">
		<div class="container_contact">
			<p><b>Adresa:</b> Str. 23 August, nr. 4, Otopeni 075100, Ilfov, Etaj 2 </p>
			<p><b>Telefon:</b> 021 351.88.84 <br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;021 351.22.78 </p>
			<p><b>Fax:</b> 021 351.22.78 </p>
			<p><b>E-mail:</b><a style="color: red;" href="mailto:liceulotopeni@yahoo.com">liceulotopeni@yahoo.com </a></p>
			<p><b>Site:</b><a style="color: red;" href="https://www.liceulotopeni.ro">www.liceulotopeni.ro</a></p>
			<div class="harta">
				<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d11373.104452848349!2d26.070854!3d44.5504525!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xc0d3ef18eea2f280!2sLiceul%20Teoretic%20Ioan%20Petru%C5%9F!5e0!3m2!1sro!2sro!4v1647208477831!5m2!1sro!2sro" width="630" height="315" scrolling="no" allowfullscreen="" loading="lazy"></iframe>
			</div>
		</div>
	</div>

	<?php
	include '../includeri/subsol.php';
	?>
</body>
</html>