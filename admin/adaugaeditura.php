<?php
	include ("../db/db.php");
	
	error_reporting(0);
	if(isset($_POST['adauga_editura'])){
		$nume_editura=$_POST['nume_editura'];
		$reg_com=$_POST['reg_com'];
		$cui=$_POST['cui'];
		$adresa=$_POST['adresa'];
		$oras=$_POST['oras'];
		$tara=$_POST['tara'];
		$telefon=$_POST['telefon'];
		$eroare='';

		if(!empty($nume_editura) && !empty($reg_com) && !empty($cui) && !empty($adresa) && !empty($oras) && !empty($tara) && !empty($telefon)){
			if(mysqli_num_rows(mysqli_query($db,"SELECT * FROM Edituri WHERE denumire='$nume_editura'"))){
				$eroare='Editura introdusă există în baza de date!';
			}else{

				$sql="INSERT INTO Edituri VALUES ('$nume_editura','$reg_com','$cui','$adresa','$oras','$tara','$telefon');";

				if(mysqli_query($db,$sql)){
					echo '<script>alert("Editura a fost adăugată cu succes!")</script>';
				}
			}
		}else{
			$eroare='Toate câmpurile sunt obligatorii!!';
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
	<title>Adaugă editura | Admin - Biblioteca Virtuală a Liceului Teoretic "Ioan Petruș" Otopeni</title>
</head>
<body class="fundal_admin">
	<div class="container_meniu">
		<div class="bara_meniu">
			<img src="../imagini/img1.jpg" style="width: 180px; margin-left: 80px; margin-top: 15px;"><br/>
			<h3 style="margin-top: 10px; margin-left: 30px; color: white; font-size: 25px;">BIBLIOTECĂ VIRTUALĂ</h3>
			<span style="float: right; color:white; margin-top: -80px; font-size: 25px">Bine ai venit, Admin! -<a href="login.php">Deconectare</a></span>
			<a style="float:right; margin-top: -40px; font-size:20px;" href="meniu.php">Înapoi la meniu</a>
		</div>
		<div class="form_adaugaeditura">
			<div class="container_form_adaugaeditura">
				<form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
					<h2 style="font-size:30px;">Adaugă editura</h2><br/>
					<span style="text-align:center; color:red; font-weight: bold;"><?php echo $eroare; ?></span>
					<br/><br/>
					<label style="color: black;" for="nume_editura">Numele editurii:</label><br/>
					<input type="text" name="nume_editura" placeholder="Introduceți numele editurii..."/><br/>
					<label style="color: black;" for="reg_com">Registrul Comerțului:</label><br/>
					<input type="text" name="reg_com" placeholder="Introduceți nr. de la Registrul Comerțului..."/><br/>
					<label style="color: black;" for="cui">CUI:</label><br/>
					<input type="text" name="cui" placeholder="Introduceți codul unic de identificare..."/><br/>
					<label style="color: black;" for="adresa">Adresa:</label><br/>
					<input type="text" name="adresa" placeholder="Introduceți adresa editurii..."/><br/>
					<label style="color: black;" for="oras">Oraș:</label><br/>
					<input type="text" name="oras" placeholder="Introduceți orașul..."/><br/>
					<label style="color: black;" for="tara">Țara:</label><br/>
					<input type="text" name="tara" placeholder="Introduceți țara..."/><br/>
					<label style="color: black;" for="telefon">Telefon:</label><br/>
					<input type="text" name="telefon" placeholder="Introduceți nr. de telefon al editurii..."/><br/>
					<button class="adaugare_editura" type="submit" name="adauga_editura">Adaugă editura</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>