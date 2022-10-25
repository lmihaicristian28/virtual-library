<?php 
include ("../db/db.php");
session_start();

	if(isset($_POST['rezervare_imprumut'])){
		if(isset($_SESSION['username'])){
		header('Location:form_imprumut.php');
		}else{
			header('Location:login.php');
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
	<?php 
		$idcarte=$_GET['id_carte'];

		$sql="SELECT titluCarte, numeAutor FROM Carti, Autori WHERE idCarte='$idcarte' AND Carti.idAutor=Autori.idAutor";
		$q=mysqli_query($db,$sql);

		while($rd=mysqli_fetch_assoc($q))
			echo '<title>'.$rd['titluCarte'].', '.$rd['numeAutor'].' - Biblioteca Virtuală a Liceului Teoretic "Ioan Petruș" Otopeni</title>';
	?>
</head>
<body class="fundal">
	<?php 
	include '../includeri/antet.php';
	?>

	<?php 
		if(isset($_SESSION['username'])){
			echo '
			<div class="bara_user">
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
		}else{
			include '../includeri/meniu.php';
		}
	?>

	<div class="afisare_carte">
		<div class="container_afisare_carte">
			<?php 
				$idcarte=$_GET['id_carte'];

				$sql="SELECT * FROM Carti, Autori, Edituri, Stocuri, Genuri WHERE idCarte='$idcarte' AND Carti.idAutor=Autori.idAutor AND Carti.idStoc=Stocuri.idStoc AND Carti.idEditura=Edituri.idEditura AND Carti.idGen=Genuri.idGen;";
				$qr=mysqli_query($db,$sql);

				$sql2="SELECT nr_exemplare FROM ExemplareCarti WHERE idCarte='$idcarte'";
				$qr2=mysqli_query($db,$sql2);

				$sql3="SELECT * FROM Stocuri WHERE den_stoc='Stoc epuizat';";

				if(mysqli_num_rows($qr)>0){
					if(mysqli_num_rows($qr2)>0){
						while($rd=mysqli_fetch_assoc($qr)){
							while($rd2=mysqli_fetch_assoc($qr2)){
								echo '<div class="carti_2">
										<div class="container_carti_2">
											<img class="img_carte" src="data:image/jpg;base64,'.base64_encode($rd['imgCarte']).'" width="290" height="390"/>
										</div>
									</div>
									<div class="detalii_carte">
										<div class="continut_detalii_carte">
											<p>Titlul cărții: '.$rd['titluCarte'].'</p>
											<p>Autorul cărții: '.$rd['numeAutor'].'</p>
											<p>Dispnobilitate stoc: '.$rd['den_stoc'].'</p>
											<p>ISBN: '.$rd['ISBN'].'</p>
											<p>Editura: '.$rd['denumire'].'</p>
											<p>Cota: '.$rd['cota'].'</p>
											<p>Nr. inventar: '.$rd['nrInv'].'</p>
											<p>Genul: '.$rd['denGen'].'</p>
											<p>Nr. exemplare: '.$rd2['nr_exemplare'].'</p>
											<form action="'.$_SERVER['PHP_SELF'].'" method="POST">
											<button class="btn_rezervare" type="submit" name="rezervare_imprumut">Rezervă împrumutul</button>
											</form>
										</div>
									</div>';
							}
						}
					}
				}
			?>
		</div>
	</div>

	<?php
	include '../includeri/subsol.php';
	?>
</body>
</html>