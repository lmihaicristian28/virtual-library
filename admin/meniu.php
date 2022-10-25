<?php 
	session_start();
	if($_SESSION['autentificat'] != 1){
		header('Location: login.php');
	}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="icon" type="image/x-icon" href="../imagini/carte.png">
	<title>Meniu | Admin - Biblioteca Virtuală a Liceului Teoretic "Ioan Petruș"</title>
</head>
<body class="fundal_admin">
	<div class="container_meniu">
		<div class="bara_meniu">
			<img src="../imagini/img1.jpg" style="width: 180px; margin-left: 80px; margin-top: 15px;"><br/>
			<h3 style="margin-top: 10px; margin-left: 30px; color: white; font-size: 25px;">BIBLIOTECĂ VIRTUALĂ</h3>
			<span style="float: right; color:white; margin-top: -80px; font-size: 25px">Bine ai venit, Admin! -<a href="login.php">Deconectare</a></span><br/>
		</div>
		<div class="panou_de_control">
			<br/>
			<p class="titlu_meniu">Meniu</p><br/>
			<div class="panou_de_control_group">
			    <div class="adaugacartea">
				  <div class="container_adaugacartea">
					<a href="adaugacartea.php">Adaugă cartea</a>
				  </div>
			    </div><br/>
			    <div class="stergecartea">
				  <div class="container_stergecartea">
					<a href="stergecartea.php">Șterge cartea</a>
				  </div>
			    </div><br/>
			    <div class="modificacartea">
				  <div class="container_modificacartea">
					<a href="modificacartea.php">Modifică cartea</a>
				  </div>
			    </div><br/>
			    <div class="adaugaexemplare">
				  <div class="container_adaugaexemplare">
					<a href="adaugaexemplare.php">Adaugă exemplare</a>
				  </div>
			    </div><br/>
			    <div class="stergecititorul">
				  <div class="container_stergecititorul">
					<a href="stergecititorul.php">Șterge cititorul</a>
				  </div>
			    </div><br/>
			    <div class="adaugaautorul">
				  <div class="container_adaugaautorul">
					<a href="adaugaautorul.php">Adaugă autorul</a>
				  </div>
			    </div><br/>
			    <div class="adaugaeditura">
				  <div class="container_adaugaeditura">
					<a href="adaugaeditura.php">Adaugă editura</a>
				  </div>
			    </div><br/>
			    <div class="adaugagenul">
				  <div class="container_adaugagenul">
					<a href="adaugagen.php">Adaugă genul</a>
				  </div>
			    </div><br/>
			    <div class="stergeexemplarul">
				  <div class="container_stergeexemplarul">
					<a href="stergeexemplarul.php">Șterge exemplarul</a>
				  </div>
			    </div>
		    </div>
		</div>
	</div>
</body>
</html>