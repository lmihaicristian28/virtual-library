<?php include ("../db/db.php"); session_start(); ?>

<!DOCTYPE html>
<html lang="ro">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="icon" type="image/x-icon" href="../imagini/carte.png">
	<title>Materiale - Biblioteca Virtuală - Lieceul Teoretic "Ioan Petruș" Otopeni</title>
	<style type="text/css">
			.pagina {
				list-style-type: none;
				padding: 10px 0;
				display: inline-flex;
				justify-content: space-between;
				box-sizing: border-box;
			}

			.pagina li {
				box-sizing: border-box;
				padding-right: 10px;
			}

			.pagina li a {
				box-sizing: border-box;
				background-color: blue;
				padding: 10px;
				text-decoration: none;
				font-size: 12px;
				font-weight: bold;
				color: white;
				border-radius: 4px;
			}

			.pagina li a:hover {
				background-color: skyblue;
			}

			.pagina .urmatoarea_pagina a, .pagina .pagina_precedenta a {
				text-transform: uppercase;
				font-size: 12px;
			}

			.pagina .pagina_curenta a {
				background-color: #136dd4;
				color: white;
			}
			
			.pagina .pagina_curenta a:hover {
				background-color: #136dd4;
			}
	</style>
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

	<div class="cautare_carte">
			<center>
				<form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
					<label style="color: white;" for="titlu_carte">Titlul cărții:&nbsp;<input type="text" name="titlu_carte" value="<?php if(isset($_POST['titlu_carte'])) echo $_POST['titlu_carte'];?>" placeholder="Căutare titlu carte..."></label>&nbsp;<button class="btn_cautare" type="submit" name="cauta_titlu_carte">Caută</button>&nbsp;&nbsp;
					<label style="color: white;" for="autor_carte">Autorul cărții:&nbsp;<select class="selectareautor" name="autor_carte"><option value="" disabled selected>Selectați autorul...</option><?php $sql="SELECT * FROM Autori ORDER BY numeAutor"; $r=mysqli_query($db,$sql); while($rd=mysqli_fetch_row($r)) {echo '<option value="'.$rd[1].'">'.$rd[1].'</option>';}?></select></label>&nbsp;<button class="btn_cautare" type="submit" name="cauta_autor_carte">Caută</button>&nbsp;&nbsp;
					<label style="color: white;" for="gen_carte">Genul cărții:&nbsp;<select class="selectaregen" name="gen_carte"><option value="" disabled selected>Selectați genul...</option><?php $sql="SELECT * FROM Genuri ORDER BY denGen"; $r=mysqli_query($db,$sql); while($rd=mysqli_fetch_row($r)) {echo '<option value="'.$rd[1].'">'.$rd[1].'</option>';}?></select></label>&nbsp;<button class="btn_cautare" type="submit" name="cauta_gen_carte">Caută</button>
				</form>
			</center>
	</div>

	<div class="materiale">
		<div class="container_materiale">
					<?php 
					if(isset($_POST['cauta_titlu_carte'])){
						$titlu_carte=$_POST['titlu_carte'];

						$sql="SELECT idCarte, imgCarte, titluCarte, numeAutor, denGen FROM Carti, Autori, Genuri WHERE Carti.idAutor=Autori.idAutor AND Carti.idGen=Genuri.idGen AND titluCarte='$titlu_carte'";

						$rez=mysqli_query($db,$sql);

						while($r=mysqli_fetch_assoc($rez)){
						    echo '<div class="carti_1">
									<div class="container_carti_1">
										<img class="img_carte" src="data:image/jpg;base64,'.base64_encode($r['imgCarte']).'" width="180" height="190"/><br/><br/>
										<a class="link_carte" style="font-size: 15px;" href="afisare_carte.php?id_carte='.$r['idCarte'].'">'.$r['titluCarte'].','.$r['numeAutor'].'</a>
									</div>
								  </div>';
						}
					}else if(isset($_POST['cauta_autor_carte'])){
						$autor_carte=$_POST['autor_carte'];

						$sql="SELECT idCarte, imgCarte, titluCarte, numeAutor FROM Carti, Autori, Genuri WHERE Carti.idAutor=Autori.idAutor AND Carti.idGen=Genuri.idGen AND numeAutor='$autor_carte'";

						$rez=mysqli_query($db,$sql);

						while($r=mysqli_fetch_assoc($rez)){
						    echo '<div class="carti_1">
									<div class="container_carti_1">
										<img class="img_carte" src="data:image/jpg;base64,'.base64_encode($r['imgCarte']).'" width="180" height="190"/><br/><br/>
										<a class="link_carte" style="font-size: 15px;" href="afisare_carte.php?id_carte='.$r['idCarte'].'">'.$r['titluCarte'].','.$r['numeAutor'].'</a>
									</div>
								  </div>';
						}
					}else if(isset($_POST['cauta_gen_carte'])){
						$gen_carte=$_POST['gen_carte'];

						$sql="SELECT idCarte, imgCarte, titluCarte, numeAutor FROM Carti, Autori, Genuri WHERE Carti.idAutor=Autori.idAutor AND Carti.idGen=Genuri.idGen AND denGen='$gen_carte'";

						$rez=mysqli_query($db,$sql);

						while($r=mysqli_fetch_assoc($rez)){
						    echo '<div class="carti_1">
									<div class="container_carti_1">
										<img class="img_carte" src="data:image/jpg;base64,'.base64_encode($r['imgCarte']).'" width="180" height="190"/><br/><br/>
										<a class="link_carte" style="font-size: 15px;" href="afisare_carte.php?id_carte='.$r['idCarte'].'">'.$r['titluCarte'].','.$r['numeAutor'].'</a>
									</div>
								  </div>';
						}
					}else{

						//Obține numărul total de pagini din fiecare tabelă
						$total_pagini=mysqli_num_rows(mysqli_query($db,"SELECT idCarte, imgCarte, titluCarte, numeAutor, denGen FROM Carti, Autori, Genuri WHERE Carti.idAutor=Autori.idAutor AND Carti.idGen=Genuri.idGen;"));

						//Verifică dacă pagina este specificată și verifică dacă pagina este un număr, altfel returnează numărul implicit de pagină care este egal cu 1
						$pagina=isset($_GET['pagina']) && is_numeric($_GET['pagina']) ? $_GET['pagina']:1;

						//Numărul rezultatelor din fiecare pagină
						$nr_rezultate_per_pagina=8;

						$pagina_calc=($pagina-1)*$nr_rezultate_per_pagina;

						$sql="SELECT idCarte, imgCarte, titluCarte, numeAutor, denGen FROM Carti, Autori, Genuri WHERE Carti.idAutor=Autori.idAutor AND Carti.idGen=Genuri.idGen ORDER BY titluCarte LIMIT ".$pagina_calc.",".$nr_rezultate_per_pagina;

						$rez=mysqli_query($db,$sql);

						while($r=mysqli_fetch_assoc($rez)){
						    echo '<div class="carti_1">
									<div class="container_carti_1">
										<img class="img_carte" src="data:image/jpg;base64,'.base64_encode($r['imgCarte']).'" width="180" height="190"/><br/><br/>
										<a class="link_carte" style="font-size: 15px;" href="afisare_carte.php?id_carte='.$r['idCarte'].'">'.$r['titluCarte'].','.$r['numeAutor'].'</a>
									</div>
								  </div>';
						}

						if(ceil($total_pagini/$nr_rezultate_per_pagina)>0):
						?>
						<br/><br/><br/><br/><br/>
						<center>
							<ul class="pagina">
								<?php if ($pagina > 1): ?>
									<li class="pagina_precedenta"><a href="materiale.php?pagina=<?php echo $pagina-1 ?>">Pagină precedentă</a></li>
									<?php endif; ?>

									<?php if ($pagina > 3): ?>
									<li class="inceput"><a href="materiale.php?pagina=1">1</a></li>
									<li class="puncte">...</li>
									<?php endif; ?>

									<?php if ($pagina-2 > 0): ?><li class="list_pagina"><a href="materiale.php?pagina=<?php echo $pagina-2 ?>"><?php echo $page-2 ?></a></li><?php endif; ?>
									<?php if ($pagina-1 > 0): ?><li class="list_pagina"><a href="materiale.php?pagina=<?php echo $pagina-1 ?>"><?php echo $pagina-1 ?></a></li><?php endif; ?>

									<li class="pagina_curenta"><a href="materiale.php?pagina=<?php echo $pagina ?>"><?php echo $pagina ?></a></li>

									<?php if ($pagina+1 < ceil($total_pagini / $nr_rezultate_per_pagina)+1): ?><li class="list_pagina"><a href="materiale.php?pagina=<?php echo $pagina+1 ?>"><?php echo $pagina+1 ?></a></li><?php endif; ?>
									<?php if ($pagina+2 < ceil($total_pagini / $nr_rezultate_per_pagina)+1): ?><li class="list_pagina"><a href="materiale.php?page=<?php echo $pagina+2 ?>"><?php echo $pagina+2 ?></a></li><?php endif; ?>

									<?php if ($pagina < ceil($total_pagini / $nr_rezultate_per_pagina)-2): ?>
									<li class="puncte">...</li>
									<li class="sfarsit"><a href="materiale.php?page=<?php echo ceil($total_pagini / $nr_rezultate_per_pagina) ?>"><?php echo ceil($total_pagini / $nr_rezultate_per_pagina) ?></a></li>
									<?php endif; ?>

									<?php if ($pagina < ceil($total_pagini / $nr_rezultate_per_pagina)): ?>
									<li class="urmatoarea_pagina"><a href="materiale.php?pagina=<?php echo $pagina+1 ?>">Următoarea pagină</a></li>
									<?php endif; ?>
								</ul>
							</center>
						<?php endif; ?>
						<?php mysqli_close($db);?>
			<?php }?>
		</div>
	</div>
	<?php
	include '../includeri/subsol.php';
	?>
</body>
</html>