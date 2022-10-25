<?php
include ("../db/db.php");

	error_reporting(0);
	if(isset($_POST['sterge'])){
	   	if(!empty($_POST['IdCarte'])){
		   $sql="DELETE FROM Carti WHERE idCarte='".$_POST['IdCarte']."';";

		   if(mysqli_query($db,$sql)){
		   	echo '<script>alert("Cartea a fost ștearsă cu succes!")</script>';
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
	<title>Șterge cartea | Admin - Biblioteca virtuală a Liceului Teoretic "Ioan Petruș" Otopeni</title>
</head>
<body class="fundal_admin">
	<div class="container_meniu">
		<div class="bara_meniu">
			<img src="../imagini/img1.jpg" style="width: 180px; margin-left: 80px; margin-top: 15px;"><br/>
			<h3 style="margin-top: 10px; margin-left: 30px; color: white; font-size: 25px;">BIBLIOTECĂ VIRTUALĂ</h3>
			<span style="float: right; color:white; margin-top: -80px; font-size: 25px">Bine ai venit, Admin! -<a href="login.php">Deconectare</a></span>
			<a style="float:right; margin-top: -40px; font-size:20px;" href="meniu.php">Înapoi la meniu</a>
		</div>
		<div class="form_stergecartea">
			<div class="form_container_stergecartea">
				<form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
					<h2 style="font-size:30px;">Șterge cartea</h2>
					<span style="text-align:center; color:red; font-weight: bold;"><?php echo $eroare; ?></span><br/>
					<label style="color:black;" for="IdCarte">Id Carte:</label><br/>
					<select class="carte" name="IdCarte">
						<option value="" disabled selected>Selectați ID-ul cărții...</option>
						<?php
				    	//$db=mysqli_connect('localhost','root','','biblioteca');
				    	$sql="SELECT idCarte FROM Carti ORDER BY idCarte ASC;";
				    	$qr=mysqli_query($db,$sql);
				    	while($rd=mysqli_fetch_row($qr))
				    		echo "<option value=".$rd[0].">".$rd[0]."</option>";
				    	?>
					</select><br/>
					<button class="stergere_carte" type="submit" name="sterge">Șterge cartea</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>