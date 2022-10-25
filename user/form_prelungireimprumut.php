<?php 
include ("../db/db.php");
session_start();
?>

<?php 
	if(isset($_POST['prelungeste_imprumut'])){
		$data_restituire=$_POST['data_restituire'];
		$data_imprumut=$_POST['data_imprumut'];
		$IdExemplar=$_POST['IdExemplar'];

		$sql="UPDATE ExemplareImprumutate SET dataRest='$data_restituire' WHERE idImprumut=(SELECT idImprumut FROM Imprumuturi WHERE dataImpr='$data_imprumut' AND idCititor=(SELECT idCititor FROM Cititori WHERE username='".$_SESSION['username']."')) AND idExemplC=(SELECT idExemplC FROM ExemplareCarti WHERE idExemplC='$IdExemplar');";

		if(mysqli_query($db,$sql))
			echo '<script>alert("Vă mulțumim! Împrumutul a fost prelungit cu succes!")</script>';
	}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="icon" type="image/x-icon" href="../imagini/carte.png">
	<title>Biblioteca Virtuală - Liceul Teoretic "Ioan Petruș" Otopeni - Formular de prelungire a împrumutului la domiciliu</title>
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

	<div class="prelungireimprumut">
		<div class="prelungireimprumut_container">
			<div class="form_prelungireimprumut">
				<div class="container_form_prelungire_imprumut">
					<h2 style="margin-left: -60px;">Formular de prelungire împrumut</h2><br/>
					<form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
						<label style="margin-left: -50px;" for="data_restituire">Alegeți data restituirii pentru a prelungi împrumutul:</label><br/>
						<input type="date" name="data_restituire" required/><br/>
						<label style="margin-left: -20px;" for="data_imprumut">Alegeți data la care ați făcut împrumutul:</label><br/>
						<input type="date" name="data_imprumut" required /><br/>
						<label style="margin-left: 15px;" for="IdExemplar">Alegeți exemplarul împrumutat:</label><br/>
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
						<input class="btn_prelungire" type="submit" name="prelungeste_imprumut" value="Prelungește">
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