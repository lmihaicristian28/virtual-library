<?php
include ("../db/db.php");

	error_reporting(0);
	if(isset($_POST['sterge_cititorul'])){

	   $IdCititor=$_POST['IdCititor'];

	   	if(!empty($IdCititor)){

	   		$sql="DELETE FROM Cititori WHERE idCititor='$IdCititor';";

			if(mysqli_query($db,$sql)){
			   echo '<script>alert("Cititorul a fost șters cu succes!")</script>';
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
	<title>Șterge cititorul | Admin - Biblioteca virtuală a Liceului Teoretic "Ioan Petruș" Otopeni</title>
</head>
<body class="fundal_admin">
	<div class="container_meniu">
		<div class="bara_meniu">
			<img src="../imagini/img1.jpg" style="width: 180px; margin-left: 80px; margin-top: 15px;"><br/>
			<h3 style="margin-top: 10px; margin-left: 30px; color: white; font-size: 25px;">BIBLIOTECĂ VIRTUALĂ</h3>
			<span style="float: right; color:white; margin-top: -80px; font-size: 25px">Bine ai venit, Admin! -<a href="login.php">Deconectare</a></span>
			<a style="float:right; margin-top: -40px; font-size:20px;" href="meniu.php">Înapoi la meniu</a>
		</div>
		<div class="form_stergecititorul">
			<div class="form_stergecititorul_container">
				<form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
					<h2 style="font-size:30px;">Șterge cititorul</h2>
					<span style="text-align:center; color:red; font-weight: bold;"><?php echo $eroare; ?></span><br/>
					<label style="color:black;" for="IdCititor">Id Cititor:</label><br/>
					<select class="select_cititor" name="IdCititor">
						<option value="" disabled selected>Selectați id-ul cititorului...</option>
						<?php
				    	//$db=mysqli_connect('localhost','root','','biblioteca');
				    	$sql="SELECT idCititor FROM Cititori ORDER BY idCititor ASC;";
				    	$qr=mysqli_query($db,$sql);
				    	while($rd=mysqli_fetch_row($qr))
				    		echo '<option value='.$rd[0].'>'.$rd[0].'</option>';
				    	?>
					</select><br/>
					<button class="stergere_cititor" type="submit" name="sterge_cititorul">Șterge cititorul</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>