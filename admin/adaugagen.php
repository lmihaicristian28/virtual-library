<?php
include ("../db/db.php");

	error_reporting(0);
	if(isset($_POST['adauga_gen'])){

	$denumire_gen=$_POST['denumire_gen'];

		if(!empty($denumire_gen)){
			if(mysqli_num_rows(mysqli_query($db,"SELECT * FROM Genuri WHERE denGen='$denumire_gen'"))){
				$sql="INSERT INTO Genuri (denGen) VALUES ('$denumire_gen');";

				if(mysqli_query($db,$sql)){
					echo '<script>alert("Genul de carte a fost adăugat cu succes!")</script>';
				}
			}else{
				$eroare="Genul de carte introdus există în baza de date!";
			}
		}else{
			$eroare='Câmpul este obligatoriu!!';
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
		<div class="form_adaugagenul">
			<div class="container_form_adaugagenul">
				<form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
					<h2 style="font-size:30px;">Adaugă genul</h2><br/>
					<span style="text-align:center; color:red; font-weight: bold;"><?php echo $eroare; ?></span><br/>
					<label style="color: black;" for="denumire_gen">Genul de carte:</label><br/>
					<input type="text" name="denumire_gen" placeholder="Introduceți genul cărții..."/><br/><br/>
					<button class="adaugare_gen" type="submit" name="adauga_gen">Adaugă genul</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>