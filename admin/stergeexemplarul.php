<?php
include ("../db/db.php");
	
	error_reporting(0);
	if(isset($_POST['sterge_exemplarul'])){

	   	$IdExemplar=$_POST['IdExemplar'];

	   	if(!empty($IdExemplar)){

	   	   $sql="DELETE FROM ExemplareCarti WHERE idExemplC='$IdExemplar';";
	   

		   if(mysqli_query($db,$sql)){
		   	echo '<script>alert("Exemplarul de carte a fost șters cu succes!")</script>';
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
	<title>Șterge exemplarul | Admin - Biblioteca virtuală a Liceului Teoretic "Ioan Petruș" Otopeni</title>
</head>
<body class="fundal_admin">
	<div class="container_meniu">
		<div class="bara_meniu">
			<img src="../imagini/img1.jpg" style="width: 180px; margin-left: 80px; margin-top: 15px;"><br/>
			<h3 style="margin-top: 10px; margin-left: 30px; color: white; font-size: 25px;">BIBLIOTECĂ VIRTUALĂ</h3>
			<span style="float: right; color:white; margin-top: -80px; font-size: 25px">Bine ai venit, Admin! -<a href="login.php">Deconectare</a></span>
			<a style="float:right; margin-top: -40px; font-size:20px;" href="meniu.php">Înapoi la meniu</a>
		</div>
		<div class="form_stergeexemplarul">
			<div class="form_container_stergeexemplarul">
				<form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
					<h2 style="font-size:30px;">Șterge exemplarul</h2>
					<span style="text-align:center; color:red; font-weight: bold;"><?php echo $eroare; ?></span><br/>
					<label style="color:black;" for="IdExemplar">Id Exemplar:</label><br/>
					<select class="selectareexemplar" name="IdExemplar">
						<option value="" disabled selected>Selectați id-ul exemplarului...</option>
						<?php
				    	//$db=mysqli_connect('localhost','root','','biblioteca');
				    	$sql="SELECT idExemplC FROM ExemplareCarti ORDER BY idExemplC ASC;";
				    	$qr=mysqli_query($db,$sql);
				    	while($rd=mysqli_fetch_row($qr))
				    		echo '<option value='.$rd[0].'>'.$rd[0].'</option>';
				    	?>
					</select><br/>
					<button class="stergere_exemplar" type="submit" name="sterge_exemplarul">Șterge exemplarul</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>