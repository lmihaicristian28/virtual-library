<?php 
include ("../db/db.php");

error_reporting(0);
if(isset($_POST['adauga_autor'])){

	$nume_autor=$_POST['nume_autor'];
	$data_nastere_autor=$_POST['data_nastere_autor'];
	$data_deces_autor=$_POST['data_deces_autor'];
	$eroare='';

	if(!empty($nume_autor) && !empty($data_nastere_autor) && !empty($data_deces_autor)){
		if(mysqli_num_rows(mysqli_query($db,"SELECT * FROM Autori WHERE numeAutor ='$nume_autor'"))){
			$eroare='Autorul introdus există în baza de date!';
		}else{
			$sql="INSERT INTO Autori (numeAutor, dataN, dataD) VALUES ('$nume_autor','$data_nastere_autor','$data_deces_autor');";

			if(mysqli_query($db,$sql)){
				echo '<script>alert("Autorul a fost adăugat cu succes!")</script>';
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
	<title>Adaugă autorul | Admin - Biblioteca Virtuală a Liceului Teoretic "Ioan Petruș" Otopeni</title>
</head>
<body class="fundal_admin">
	<div class="container_meniu">
		<div class="bara_meniu">
			<img src="../imagini/img1.jpg" style="width: 180px; margin-left: 80px; margin-top: 15px;"><br/>
			<h3 style="margin-top: 10px; margin-left: 30px; color: white; font-size: 25px;">BIBLIOTECĂ VIRTUALĂ</h3>
			<span style="float: right; color:white; margin-top: -80px; font-size: 25px">Bine ai venit, Admin! -<a href="login.php">Deconectare</a></span>
			<a style="float:right; margin-top: -40px; font-size:20px;" href="meniu.php">Înapoi la meniu</a>
		</div>
		<div class="form_adaugaautorul">
			<div class="form_adaugaautorul_container">
				<form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
					<h2 style="font-size: 30px;">Adaugă autorul</h2><br/>
					<span style="text-align:center; color:red; font-weight: bold;"><?php echo $eroare; ?></span>
					<br/>
					<label style="color: black;" for="nume_autor">Numele autorului:</label><br/>
					<input type="text" name="nume_autor" placeholder="Introduceți numele autorului..."/><br/>
					<label style="color: black;" for="data_nastere_autor">Data nașterii autorului:</label><br/>
					<input type="date" name="data_nastere_autor"/><br/>
					<label style="color: black;" for="data_deces_autor">Data decesului autorului:</label><br/>
					<input type="date" name="data_deces_autor"/><br/>
					<button class="adaugare_autor" type="submit" name="adauga_autor">Adaugă autorul</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>