<?php 
	include("../db/db.php");
	session_start();
?>

<!DOCTYPE html>
<html lang="ro">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="icon" type="image/x-icon" href="../imagini/carte.png">
	<title>Împrumuturi efectuate - Biblioteca Virtuală a Liceului Teoretic "Ioan Petruș" Otopeni</title>
	<style type="text/css">
		table, td{
			border: 1px solid black;
  			border-collapse: collapse;
		}

		td{
			padding: 2px 3px;
			font-size: 20px;
			color: white;
		}

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
		include ("../includeri/antet.php");
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
					<li><a href="imprumuturiefectuate.php">Împrumuturi</a></li>
					<li><a href="profil.php">Profil</a></li>
					<li><a href="optiuni.php">Opțiuni Împrumut</a></li>
					<li><a href="logout.php">Log Out</a></li>
				</ul>
			</div>
		</div>';
	?>

	<center>
		<div class="cautare_imprumut">
			<form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
				<label style="color:white;" for="data_imprumut">Data împrumutului: &nbsp;<input type="date" name="data_imprumut" value="<?php if(isset($_POST['data_imprumut'])) echo $_POST['data_imprumut']?>"></label>&nbsp;
				<button class="btn_cautare" name="cauta_data_imprumut">Caută</button><br/>
				<label style="color:white;" for="data_restituire">Data restituirii: &nbsp;<input type="date" name="data_restituire" value="<?php if(isset($_POST['data_restituire'])) echo $_POST['data_restituire']?>"></label>&nbsp;
				<button class="btn_cautare" name="cauta_data_restituire">Caută</button><br/>
				<label style="color:white;" for="titlu_carte">Titlul cărții: &nbsp;<input type="text" name="titlu_carte" value="<?php if(isset($_POST['titlu_carte'])) echo $_POST['titlu_carte']?>" placeholder="Introduceți titlul cărții..."></label>&nbsp;
				<button class="btn_cautare" name="cauta_titlu_carte">Caută</button>
			</form>
		</div>
	</center>
	<div class="imprumuturi_efectuate">
		<div class="container_imprumuturi_efectuate">
			<center>
				<h2 style="color:white;">Situația împrumuturilor de cărți</h2><br/>
				<table id="container_table" width=80% bgcolor="dodgerblue">
		    	<tr>
				<td>Data Împrumutului</td>
				<td>Data Restituirii</td>
		    	<td>Titlul Cărții</td>
		    	<td>Autorul Cărții</td>
		    	<td>ISBN</td>
		    	<td>Editura</td>
		    	<td>Cod Bare</td>
		    	<?php 
		    	if(isset($_POST['cauta_data_imprumut'])){

		    		$username=$_SESSION['username'];

		    		$data_imprumut=$_POST['data_imprumut'];

		    		$sql="SELECT dataImpr, dataRest, titluCarte, numeAutor, ISBN, denumire, codBare FROM Imprumuturi, Cititori, Autori, Edituri, ExemplareCarti, Carti, ExemplareImprumutate WHERE Imprumuturi.idCititor=Cititori.idCititor AND Carti.idAutor=Autori.idAutor AND Carti.idEditura=Edituri.idEditura AND ExemplareCarti.idCarte=Carti.idCarte AND ExemplareImprumutate.idImprumut=Imprumuturi.idImprumut AND ExemplareImprumutate.idExemplC=ExemplareCarti.idExemplC AND username='$username' AND dataImpr='$data_imprumut'";

		    		$r=mysqli_query($db,$sql);

		    		while($rd=mysqli_fetch_assoc($r)){
		    			echo '<tr>
		    					<td>'.$rd['dataImpr'].'</td>
					    		<td>'.$rd['dataRest'].'</td>
					    		<td>'.$rd['titluCarte'].'</td>
					    		<td>'.$rd['numeAutor'].'</td>
					    		<td>'.$rd['ISBN'].'</td>
					    		<td>'.$rd['denumire'].'</td>
					    		<td>'.$rd['codBare'].'</td>
					    	</tr>
					    	</table>';
		    		}

		    	}else if(isset($_POST['cauta_data_restituire'])){

		    		$username=$_SESSION['username'];

		    		$data_restituire=$_POST['data_restituire'];

		    		$sql="SELECT dataImpr, dataRest, titluCarte, numeAutor, ISBN, denumire, codBare FROM Imprumuturi, Cititori, Autori, Edituri, ExemplareCarti, Carti, ExemplareImprumutate WHERE Imprumuturi.idCititor=Cititori.idCititor AND Carti.idAutor=Autori.idAutor AND Carti.idEditura=Edituri.idEditura AND ExemplareCarti.idCarte=Carti.idCarte AND ExemplareImprumutate.idImprumut=Imprumuturi.idImprumut AND ExemplareImprumutate.idExemplC=ExemplareCarti.idExemplC AND username='$username' AND dataRest='$data_restituire'";

		    		$r=mysqli_query($db,$sql);

		    		while($rd=mysqli_fetch_assoc($r)){
		    			echo '<tr>
		    					<td>'.$rd['dataImpr'].'</td>
					    		<td>'.$rd['dataRest'].'</td>
					    		<td>'.$rd['titluCarte'].'</td>
					    		<td>'.$rd['numeAutor'].'</td>
					    		<td>'.$rd['ISBN'].'</td>
					    		<td>'.$rd['denumire'].'</td>
					    		<td>'.$rd['codBare'].'</td>
					    	</tr>
					    	</table>';
		    		}
		    	}else if(isset($_POST['cauta_titlu_carte'])){

		    		$username=$_SESSION['username'];

		    		$titlu_carte=$_POST['titlu_carte'];

		    		$sql="SELECT dataImpr, dataRest, titluCarte, numeAutor, ISBN, denumire, codBare FROM Imprumuturi, Cititori, Autori, Edituri, ExemplareCarti, Carti, ExemplareImprumutate WHERE Imprumuturi.idCititor=Cititori.idCititor AND Carti.idAutor=Autori.idAutor AND Carti.idEditura=Edituri.idEditura AND ExemplareCarti.idCarte=Carti.idCarte AND ExemplareImprumutate.idImprumut=Imprumuturi.idImprumut AND ExemplareImprumutate.idExemplC=ExemplareCarti.idExemplC AND username='$username' AND titluCarte='$titlu_carte'";
		    		$r=mysqli_query($db,$sql);

		    		while($rd=mysqli_fetch_assoc($r)){
		    			echo '<tr>
		    					<td>'.$rd['dataImpr'].'</td>
					    		<td>'.$rd['dataRest'].'</td>
					    		<td>'.$rd['titluCarte'].'</td>
					    		<td>'.$rd['numeAutor'].'</td>
					    		<td>'.$rd['ISBN'].'</td>
					    		<td>'.$rd['denumire'].'</td>
					    		<td>'.$rd['codBare'].'</td>
					    	</tr>
					    	</table>';
		    		}	
		    	}else{

		    	$username=$_SESSION['username'];

		    	//Obține numărul total de pagini din fiecare tabelă
				$total_pagini=mysqli_num_rows(mysqli_query($db,"SELECT dataImpr, dataRest, titluCarte, numeAutor, ISBN, denumire, codBare FROM Imprumuturi, Cititori, Autori, Edituri, ExemplareCarti, Carti, ExemplareImprumutate WHERE Imprumuturi.idCititor=Cititori.idCititor AND Carti.idAutor=Autori.idAutor AND Carti.idEditura=Edituri.idEditura AND ExemplareCarti.idCarte=Carti.idCarte AND ExemplareImprumutate.idImprumut=Imprumuturi.idImprumut AND ExemplareImprumutate.idExemplC=ExemplareCarti.idExemplC"));

				//Verifică dacă pagina este specificată și verifică dacă pagina este un număr, altfel returnează numărul implicit de pagină care este egal cu 1
				$pagina=isset($_GET['pagina']) && is_numeric($_GET['pagina']) ? $_GET['pagina']:1;

				//Numărul rezultatelor din fiecare pagină
				$nr_rezultate_per_pagina=8;

				$pagina_calc=($pagina-1)*$nr_rezultate_per_pagina;

		    	$sql="SELECT dataImpr, dataRest, titluCarte, numeAutor, ISBN, denumire, codBare FROM Imprumuturi, Cititori, Autori, Edituri, ExemplareCarti, Carti, ExemplareImprumutate WHERE Imprumuturi.idCititor=Cititori.idCititor AND Carti.idAutor=Autori.idAutor AND Carti.idEditura=Edituri.idEditura AND ExemplareCarti.idCarte=Carti.idCarte AND ExemplareImprumutate.idImprumut=Imprumuturi.idImprumut AND ExemplareImprumutate.idExemplC=ExemplareCarti.idExemplC AND username='$username' LIMIT ".$pagina_calc.",".$nr_rezultate_per_pagina;;

				$r=mysqli_query($db,$sql);

		    		while($rd=mysqli_fetch_assoc($r)){
		    			echo '<tr>
		    					<td>'.$rd['dataImpr'].'</td>
					    		<td>'.$rd['dataRest'].'</td>
					    		<td>'.$rd['titluCarte'].'</td>
					    		<td>'.$rd['numeAutor'].'</td>
					    		<td>'.$rd['ISBN'].'</td>
					    		<td>'.$rd['denumire'].'</td>
					    		<td>'.$rd['codBare'].'</td>
					    	</tr>';
		    		}
		    	?>
		    	</table>
		    <br/><br/>
			</center>
			<?php if(ceil($total_pagini/$nr_rezultate_per_pagina)>0): ?>
		    	<center>
					<ul class="pagina">
					<?php if ($pagina > 1): ?>
					<li class="pagina_precedenta"><a href="imprumuturiefectuate.php?pagina=<?php echo $pagina-1 ?>">Pagină precedentă</a></li>
					<?php endif; ?>

					<?php if ($pagina > 3): ?>
					<li class="inceput"><a href="imprumuturiefectuate.php?pagina=1">1</a></li>
					<li class="puncte">...</li>
					<?php endif; ?>

					<?php if ($pagina-2 > 0): ?><li class="list_pagina"><a href="imprumuturiefectuate.php?pagina=<?php echo $pagina-2 ?>"><?php echo $page-2 ?></a></li><?php endif; ?>
					<?php if ($pagina-1 > 0): ?><li class="list_pagina"><a href="imprumuturiefectuate.php?pagina=<?php echo $pagina-1 ?>"><?php echo $pagina-1 ?></a></li><?php endif; ?>

					<li class="pagina_curenta"><a href="imprumuturiefectuate.php?pagina=<?php echo $pagina ?>"><?php echo $pagina ?></a></li>

					<?php if ($pagina+1 < ceil($total_pagini / $nr_rezultate_per_pagina)+1): ?><li class="list_pagina"><a href="imprumuturiefectuate.php?pagina=<?php echo $pagina+1 ?>"><?php echo $pagina+1 ?></a></li><?php endif; ?>
					<?php if ($pagina+2 < ceil($total_pagini / $nr_rezultate_per_pagina)+1): ?><li class="list_pagina"><a href="imprumuturiefectuate.php?page=<?php echo $pagina+2 ?>"><?php echo $pagina+2 ?></a></li><?php endif; ?>

					<?php if ($pagina < ceil($total_pagini / $nr_rezultate_per_pagina)-2): ?>
					<li class="puncte">...</li>
					<li class="sfarsit"><a href="imprumuturiefectuate.php?page=<?php echo ceil($total_pagini / $nr_rezultate_per_pagina) ?>"><?php echo ceil($total_pagini / $nr_rezultate_per_pagina) ?></a></li>
					<?php endif; ?>

					<?php if ($pagina < ceil($total_pagini / $nr_rezultate_per_pagina)): ?>
					<li class="urmatoarea_pagina"><a href="imprumuturiefectuate.php?pagina=<?php echo $pagina+1 ?>">Următoarea pagină</a></li>
					<?php endif; ?>
					</ul>
				</center>
			<?php endif; ?>
		<?php mysqli_close($db);?>
	<?php }?>
		</div>
	</div>

	<?php 
		include ("../includeri/subsol.php");
	?>
</body>
</html>