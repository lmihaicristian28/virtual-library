<?php 
include '../db/db.php';
	
	error_reporting(0);
    if(isset($_POST['adauga_exemplar'])){

	$IdCarte=$_POST['IdCarte'];
	$cod_bare=$_POST['cod_bare'];
	$nr_exemplare=$_POST['nr_exemplare'];
	$eroare="";

	if(!empty($IdCarte) && !empty($cod_bare) && !empty($nr_exemplare)){
		if(mysqli_num_rows(mysqli_query($sql,"SELECT * FROM ExemplareCarti WHERE idCarte='$IdCarte'"))){
			$eroare="Exemplarul introdus există în baza de date!";
		}else{
			$sql="INSERT INTO ExemplareCarti SET idCarte='$IdCarte', codBare='$cod_bare', nr_exemplare='$nr_exemplare';";
			

			if(mysqli_query($db,$sql)){
			   	echo '<script>alert("Exemplarul a fost adăugat cu succes!")</script>';
			}  
		} 
	}else{
		$eroare="Toate câmpurile sunt obligatorii!!";
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
	<title>Adaugă exemplare | Admin - Biblioteca virtuală a Liceului Teoretic "Ioan Petruș" Otopeni</title>
</head>
<body class="fundal_admin">
	<div class="container_meniu">
		<div class="bara_meniu">
			<img src="../imagini/img1.jpg" style="width: 180px; margin-left: 80px; margin-top: 15px;"><br/>
			<h3 style="margin-top: 10px; margin-left: 30px; color: white; font-size: 25px;">BIBLIOTECĂ VIRTUALĂ</h3>
			<span style="float: right; color:white; margin-top: -80px; font-size: 25px">Bine ai venit, Admin! -<a href="login.php">Deconectare</a></span>
			<a style="float:right; margin-top: -40px; font-size:20px;" href="meniu.php">Înapoi la meniu</a>
		</div>
		<div class="form_adaugaexemplare">
			<div class="form_adaugaexemplare_container">
				<form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
					<h2 style="font-size:30px;">Adaugă exemplare</h2><br/>
					<span style="text-align:center; color:red; font-weight: bold;"><?php echo $eroare; ?></span><br/>
					<label style="color:black;" for="IdCarte">Cartea:</label><br/>
					<select class="carte" name="IdCarte">
						<option value="" disabled selected>Selectați cartea...</option>
						<?php
				    	//$db=mysqli_connect('localhost','root','','biblioteca');
				    	$sql="SELECT * FROM Carti ORDER BY titluCarte;";
				    	$qr=mysqli_query($db,$sql);
				    	while($rd=mysqli_fetch_row($qr))
				    		echo "<option value=".$rd[0].">".$rd[1]."</option>";
				    	?>
					</select><br/>
					<label style="color:black;" for="cod_bare">Cod Bare:</label><br/>
					<input type="text" name="cod_bare" placeholder="Introduceți codul de bare al cărții..."><br/>
					<label style="color:black;" for="IdCarte">Nr. Exemplare:</label><br/>
					<input type="text" name="nr_exemplare" placeholder="Introduceți nr. de exemplare dorite..."><br/><br/>
					<button class="adaugare_exemplar" type="submit" name="adauga_exemplar">Adaugă exemplarul</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>