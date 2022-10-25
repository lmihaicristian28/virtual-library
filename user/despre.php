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
	<title>Biblioteca Virtuală - Lieceul Teoretic "Ioan Petruș - Despre noi</title>
</head>
<body class="fundal">
	<?php 
	include '../includeri/antet.php';
	?>

	<?php
	if(isset($_SESSION['username'])){
		echo '<div class="bara_user">
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

	<div class="despre_noi">
		<div class="despre_noi_container">
			<p>Biblioteca pune la dispoziție un fond de 11 681 de cărți care cuprind diverse domenii de interes atât pentru elevi, cât și pentru cadrele didactice:
				<ul style="list-style-type: circle;">
					<div class="list_container">
						<li>Literatura română</li>
					    <li>Literatura universală</li>
					    <li>Cărți de specialitate pentru cadrele didactice</li>
					    <li>Atlasuri școlare</li>
					    <li>Cărți cu povești</li>
					    <li>Dicționare</li>
					    <li>Enciclopedii ilustrate</li>
					    <li>Albume de artă</li>
					</div>
				</ul><br/><br/>
			Pentru elevii din clasele primare, punem la dispoziția lor cărți cu povești, poezii, volume de proză etc., iar pentru elevii din clasele gimnaziale, se poate efectua o solicitare de la bibliotecă operele literare studiate la disciplina "Limba și literatura română". De asemenea, sunt recomandate către elevi lectura suplimentară, la care Liceul dispune și de o sală de lectură unde elevii pot lectura cărțile.
		    </p>
		</div>
	</div>

	<?php
	include '../includeri/subsol.php';
	?>
</body>
</html>