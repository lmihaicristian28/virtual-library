<?php 
include ("../db/db.php");
session_start();
?>

<?php 

if(isset($_POST['rezerva_imprumut'])){

	$data_imprumut=$_POST['data_imprumut'];
	$data_restituire=$_POST['data_restituire'];
	$IdExemplar=$_POST['IdExemplar'];

	$sql1="INSERT INTO Imprumuturi (idImprumut,dataImpr,idCititor) VALUES (NULL,'$data_imprumut',(SELECT idCititor FROM Cititori WHERE username='".$_SESSION['username']."'))";
	$sql2="INSERT INTO ExemplareImprumutate (IdImprumut,idExemplC,dataRest) VALUES ((SELECT idImprumut FROM Imprumuturi WHERE dataImpr='$data_imprumut'),'$IdExemplar','$data_restituire');";
	$sql3="UPDATE ExemplareCarti SET nr_exemplare=nr_exemplare-1 WHERE idExemplC='$IdExemplar';";


	if(mysqli_query($db,$sql1) && mysqli_query($db,$sql2) && mysqli_query($db,$sql3))
		echo '<script>alert("Vă mulțumim! Împrumutul dvs. a fost rezervat!")</script>';
}

?>

<!DOCTYPE html>
<html lang="ro">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="icon" type="image/x-icon" href="../imagini/carte.png">
	<title>Biblioteca Virtuală - Liceul Teoretic "Ioan Petruș" Otopeni - Formular de rezervare a împrumutului la domiciliu</title>
</head>
<body class="fundal">
	<?php 
	include '../includeri/antet.php';
	?>

	<?php
		if(isset($_SESSION['username']))
		echo
		'<div class="bara_user">
			<span style="color:white; margin-bottom: -30px; font-size: 25px">Bine ai venit, '.$_SESSION['username'].'!</span>
		</div>
		<div class="meniu">
			<div class="container">
				<ul>
					<li><a href="index.php">Acasă</a></li>
					<li><a href="despre.php">Despre Noi</a></li>
					<li><a href="materiale.php">Materiale</a></li>
					<li><a href="contact.php">Contact</a></li>
					<li><a href="imprumuturiefectuate.php">Împrumuturi efectuate</a></li>
					<li><a href="profil.php">Profil</a></li>
					<li><a href="optiuni.php">Opțiuni</a></li>
					<li><a href="logout.php">Log Out</a></li>
				</ul>
			</div>
		</div>';
	?>

	<div class="imprumut">
		<div class="imprumut_container">
			<div class="form_imprumut">
				<div class="container_form_imprumut">
					<h2 style="margin-left: -50px;">Formular de rezervare împrumut</h2><br/>
					<form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
						<label for="data_imprumut">Alegeți data împrumutului:</label><br/>
						<input type="date" name="data_imprumut" required /><br/>
						<label for="exemplar_carte">Selectați exemplarul dorit:</label><br/>
						<select class="selectareexemplar" name="IdExemplar" required>
							<option value="" disabled selected>Selectați exemplarul...</option>
								<?php
						    	//$db=mysqli_connect('localhost','root','','biblioteca');
						    	$sql="SELECT idExemplC, titluCarte FROM ExemplareCarti INNER JOIN Carti ON ExemplareCarti.idCarte=Carti.idCarte ORDER BY titluCarte;";
						    	$qr=mysqli_query($db,$sql);
						    	while($rd=mysqli_fetch_row($qr))
						    		echo "<option value=".$rd[0].">".$rd[1]."</option>";
						    	?>
						</select><br/>
						<label for="data_restituire">Alegeți data restituirii:</label><br/>
						<input type="date" name="data_restituire" required/><br/><br/>
						<input class="btn_rezervare" type="submit" name="rezerva_imprumut" value="Rezervă">
					</form>
				</div>
			</div>
		</div>
	</div>

	<?php
	include '../includeri/subsol.php';
	?>
</body>
</html>