<?php 
include ("../db/db.php");
	session_start();
	if($_SESSION['autentificat'] != 1){
		header('Location: login_bibliotecar.php');
	}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Raport Cărți Împrumutate - Biblioteca Virtuală a Liceului Teoretic "Ioan Petruș" Otopeni</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="icon" type="image/x-icon" href="../imagini/carte.png">
	<style type="text/css">
		table, td{
			border: 1px solid black;
  			border-collapse: collapse;
		}

		td{
			padding: 2px 3px;
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
    <?php include '../includeri/antet.php';?>
	<div class="bara_deconectare">
			<span style="color:white; margin-bottom: -30px; font-size: 25px">Bine ai venit, Bibliotecar! -<a href="login_bibliotecar.php">Deconectare</a></span><br/>
	</div>
	<div class="meniu">
	  <div class="container">
		<ul>
			<li><a href="raport_cititori.php">Raport Cititori</a></li>
			<li><a href="raport_cartiimprumutate.php">Raport Cărți Împrumutate</a></li>
			<li><a href="raport_evidentacarti.php">Raport Evidență cărți</a></li>
			<li><a href="raport_stocuricarti.php">Raport Stocuri cărți</a></li>
		</ul>
	  </div>
    </div>

    <div class="cautare_raport">
    	<form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
    		<center>
	  			<label style="color: white;" for="data_imprumut">Data Împrumutului:&nbsp;<input type="date" name="data_imprumut" value="<?php if(isset($_POST['data_imprumut'])) echo $_POST['data_imprumut'];?>"></label>&nbsp;<button type="submit" class="btn_cautare" name="cautare_imprumut">Caută</button><br/>
	  			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="color: white;" for="data_restituire">Data Restituirii:&nbsp;<input type="date" name="data_restituire" value="<?php if(isset($_POST['data_restituire'])) echo $_POST['data_restituire'];?>"></label>&nbsp;<button type="submit" class="btn_cautare" name="cautare_restituire">Caută</button><br/>
	  			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="color: white;" for="titlu_carte">Titlu carte:&nbsp;<input type="text" name="titlu_carte" placeholder="Căutați cartea împrumutată..." value="<?php if(isset($_POST['titlu_carte'])) echo $_POST['titlu_carte'];?>"></label>&nbsp;<button type="submit" class="btn_cautare" name="cautare_carte">Caută</button><br/>
	  			<label style="color: white;" for="nume_cititor">Numele cititorului:&nbsp;<input type="text" name="nume_cititor" placeholder="Căutați cititorul..." value="<?php if(isset($_POST['nume_cititor'])) echo $_POST['nume_cititor'];?>"></label>&nbsp;<button type="submit" class="btn_cautare" name="cautare_cititor">Caută</button>
  			</center>
  		</form>
    </div>

    <div id="table">

    	<center>
    		<img src="../imagini/img1.jpg" width="210" height="120">
    	</center>

    	<br/><br/>

    	<h4 style="text-align:center; color:black; font-size:35px;">Raport Cărți Împrumutate</h4><br/><br/>
    	<?php
    		if(isset($_POST['cautare_imprumut'])){

	    		$data_imprumut=$_POST['data_imprumut'];

		    	$sql="SELECT nume, prenume , dataImpr, dataRest, titluCarte, numeAutor, ISBN, denumire, codBare FROM Imprumuturi, Cititori, Autori, Edituri, ExemplareCarti, Carti, ExemplareImprumutate WHERE Imprumuturi.idCititor=Cititori.idCititor AND Carti.idAutor=Autori.idAutor AND Carti.idEditura=Edituri.idEditura AND ExemplareCarti.idCarte=Carti.idCarte AND ExemplareImprumutate.idImprumut=Imprumuturi.idImprumut AND ExemplareImprumutate.idExemplC=ExemplareCarti.idExemplC AND dataImpr='$data_imprumut';";

		    		$r=mysqli_query($db,$sql);

			    	echo '
			    	<center>
			    	<table id="container_table" border="1" width=80% align="center" bgcolor="dodgerblue">
			    	<tr>
					<td>Nume</td><td>Prenume</td><td>Data Împrumutului</td><td>Data Restituirii</td>
			    	<td>Titlul Cărții</td><td>Autorul Cărții</td><td>ISBN</td>
			    	<td>Editura</td><td>Cod Bare</td>';

			    	if(mysqli_num_rows($r)>0){
					    while ($rs=mysqli_fetch_assoc($r)){
					    		echo '<tr>
					    		<td>'.$rs['nume'].'</td>
					    		<td>'.$rs['prenume'].'</td>
					    		<td>'.$rs['dataImpr'].'</td>
					    		<td>'.$rs['dataRest'].'</td>
					    		<td>'.$rs['titluCarte'].'</td>
					    		<td>'.$rs['numeAutor'].'</td>
					    		<td>'.$rs['ISBN'].'</td>
					    		<td>'.$rs['denumire'].'</td>
					    		<td>'.$rs['codBare'].'</td>
					    		</tr>';
					    }
					}else{
						echo '<p style="font-weight:bold; font-size:20px;">Niciun cititor nu a împrumutat la data de '.$data_imprumut.'  căutată!</p><br/>';
					}    
					    echo   '</table>
					    	   </center>';
			}else if(isset($_POST['cautare_restituire'])){

		    		$data_restituire=$_POST['data_restituire'];

			    	$sql="SELECT nume, prenume , dataImpr, dataRest, titluCarte, numeAutor, ISBN, denumire, codBare FROM Imprumuturi, Cititori, Autori, Edituri, ExemplareCarti, Carti, ExemplareImprumutate WHERE Imprumuturi.idCititor=Cititori.idCititor AND Carti.idAutor=Autori.idAutor AND Carti.idEditura=Edituri.idEditura AND ExemplareCarti.idCarte=Carti.idCarte AND ExemplareImprumutate.idImprumut=Imprumuturi.idImprumut AND ExemplareImprumutate.idExemplC=ExemplareCarti.idExemplC AND dataImpr='$data_restituire';";

			    	$r=mysqli_query($db,$sql);

				    	
			    	echo '<center>
					    	<table id="container_table" border="1" width=80% align="center" bgcolor="dodgerblue">
					    	<tr>
							<td>Nume</td><td>Prenume</td><td>Data Împrumutului</td><td>Data Restituirii</td>
					    	<td>Titlul Cărții</td><td>Autorul Cărții</td><td>ISBN</td>
					    	<td>Editura</td><td>Cod Bare</td>';

					if(mysqli_num_rows($r)>0){
					    while ($rs=mysqli_fetch_assoc($r)){
					    		echo '<tr>
					    		<td>'.$rs['nume'].'</td>
					    		<td>'.$rs['prenume'].'</td>
					    		<td>'.$rs['dataImpr'].'</td>
					    		<td>'.$rs['dataRest'].'</td>
					    		<td>'.$rs['titluCarte'].'</td>
					    		<td>'.$rs['numeAutor'].'</td>
					    		<td>'.$rs['ISBN'].'</td>
					    		<td>'.$rs['denumire'].'</td>
					    		<td>'.$rs['codBare'].'</td>
					    		</tr>';
					    	}
					}else{
						echo '<p style="font-weight:bold; font-size:20px;">Niciun cititor nu a restituit la data de '.$data_restituire.' !</p><br/>';
					}
					    echo 	'</table>
					    	   </center>';
			}else if(isset($_POST['cautare_carte'])){

				$titlu_carte=$_POST['titlu_carte'];

			    	$sql="SELECT nume, prenume , dataImpr, dataRest, titluCarte, numeAutor, ISBN, denumire, codBare FROM Imprumuturi, Cititori, Autori, Edituri, ExemplareCarti, Carti, ExemplareImprumutate WHERE Imprumuturi.idCititor=Cititori.idCititor AND Carti.idAutor=Autori.idAutor AND Carti.idEditura=Edituri.idEditura AND ExemplareCarti.idCarte=Carti.idCarte AND ExemplareImprumutate.idImprumut=Imprumuturi.idImprumut AND ExemplareImprumutate.idExemplC=ExemplareCarti.idExemplC AND titluCarte='titlu_carte';";

			    	$r=mysqli_query($db,$sql);

				    	
			    	echo '<center>
					    	<table id="container_table" border="1" width=80% align="center" bgcolor="dodgerblue">
					    	<tr>
							<td>Nume</td><td>Prenume</td><td>Data Împrumutului</td><td>Data Restituirii</td>
					    	<td>Titlul Cărții</td><td>Autorul Cărții</td><td>ISBN</td>
					    	<td>Editura</td><td>Cod Bare</td>';

					if(mysqli_num_rows($r)>0){
					    while ($rs=mysqli_fetch_assoc($r)){
					    		echo '<tr>
					    		<td>'.$rs['nume'].'</td>
					    		<td>'.$rs['prenume'].'</td>
					    		<td>'.$rs['dataImpr'].'</td>
					    		<td>'.$rs['dataRest'].'</td>
					    		<td>'.$rs['titluCarte'].'</td>
					    		<td>'.$rs['numeAutor'].'</td>
					    		<td>'.$rs['ISBN'].'</td>
					    		<td>'.$rs['denumire'].'</td>
					    		<td>'.$rs['codBare'].'</td>
					    		</tr>';
					    	}
					}else{
						echo '<p style="font-weight:bold; font-size:20px;">Nicio carte cu numele de '.$titlu_carte.' nu a fost împrumutată!</p><br/>';
					}
					    echo 	'</table>
					    	   </center>'; 	   
			}else if(isset($_POST['cautare_cititor'])){

				$nume_cititor=$_POST['nume_cititor'];

				$sql="SELECT nume, prenume , dataImpr, dataRest, titluCarte, numeAutor, ISBN, denumire, codBare FROM Imprumuturi, Cititori, Autori, Edituri, ExemplareCarti, Carti, ExemplareImprumutate WHERE Imprumuturi.idCititor=Cititori.idCititor AND Carti.idAutor=Autori.idAutor AND Carti.idEditura=Edituri.idEditura AND ExemplareCarti.idCarte=Carti.idCarte AND ExemplareImprumutate.idImprumut=Imprumuturi.idImprumut AND ExemplareImprumutate.idExemplC=ExemplareCarti.idExemplC AND nume='$nume_cititor'";

				$r=mysqli_query($db,$sql);

					echo '<center>
					    	<table id="container_table" border="1" width=80% align="center" bgcolor="dodgerblue">
					    	<tr>
							<td>Nume</td><td>Prenume</td><td>Data Împrumutului</td><td>Data Restituirii</td>
					    	<td>Titlul Cărții</td><td>Autorul Cărții</td><td>ISBN</td>
					    	<td>Editura</td><td>Cod Bare</td>';

					if(mysqli_num_rows($r)>0){
					    while ($rs=mysqli_fetch_assoc($r)){
					    		echo '<tr>
					    		<td>'.$rs['nume'].'</td>
					    		<td>'.$rs['prenume'].'</td>
					    		<td>'.$rs['dataImpr'].'</td>
					    		<td>'.$rs['dataRest'].'</td>
					    		<td>'.$rs['titluCarte'].'</td>
					    		<td>'.$rs['numeAutor'].'</td>
					    		<td>'.$rs['ISBN'].'</td>
					    		<td>'.$rs['denumire'].'</td>
					    		<td>'.$rs['codBare'].'</td>
					    		</tr>';
					    	}
					}else{
						echo '<p style="font-weight:bold; font-size:20px;">Niciun cititor cu numele de '.$nume_cititor.' nu a făcut împrumuturi de cărți!</p><br/>';
					}
					    echo 	'</table>
					    	   </center>';
			}else{

				$total_pagini=mysqli_num_rows(mysqli_query($db,"SELECT nume, prenume , dataImpr, dataRest, titluCarte, numeAutor, ISBN, denumire, codBare FROM Imprumuturi, Cititori, Autori, Edituri, ExemplareCarti, Carti, ExemplareImprumutate WHERE Imprumuturi.idCititor=Cititori.idCititor AND Carti.idAutor=Autori.idAutor AND Carti.idEditura=Edituri.idEditura AND ExemplareCarti.idCarte=Carti.idCarte AND ExemplareImprumutate.idImprumut=Imprumuturi.idImprumut AND ExemplareImprumutate.idExemplC=ExemplareCarti.idExemplC;"));

				//Verifică dacă pagina este specificată și verifică dacă pagina este un număr, altfel returnează numărul implicit de pagină care este egal cu 1
				$pagina=isset($_GET['pagina']) && is_numeric($_GET['pagina']) ? $_GET['pagina']:1;

				//Numărul rezultatelor din fiecare pagină
				$nr_rezultate_per_pagina=8;

				$pagina_calc=($pagina-1)*$nr_rezultate_per_pagina;

				$sql="SELECT nume, prenume , dataImpr, dataRest, titluCarte, numeAutor, ISBN, denumire, codBare FROM Imprumuturi, Cititori, Autori, Edituri, ExemplareCarti, Carti, ExemplareImprumutate WHERE Imprumuturi.idCititor=Cititori.idCititor AND Carti.idAutor=Autori.idAutor AND Carti.idEditura=Edituri.idEditura AND ExemplareCarti.idCarte=Carti.idCarte AND ExemplareImprumutate.idImprumut=Imprumuturi.idImprumut AND ExemplareImprumutate.idExemplC=ExemplareCarti.idExemplC ORDER BY nume LIMIT ".$pagina_calc.",".$nr_rezultate_per_pagina;

				$r=mysqli_query($db,$sql);

				echo '<center>
					    	<table id="container_table" border="1" width=80% align="center" bgcolor="dodgerblue">
					    	<tr>
							<td>Nume</td><td>Prenume</td><td>Data Împrumutului</td><td>Data Restituirii</td>
					    	<td>Titlul Cărții</td><td>Autorul Cărții</td><td>ISBN</td>
					    	<td>Editura</td><td>Cod Bare</td>';

				while ($rs=mysqli_fetch_assoc($r)){
					echo '<tr>
					<td>'.$rs['nume'].'</td>
					<td>'.$rs['prenume'].'</td>
					<td>'.$rs['dataImpr'].'</td>
					<td>'.$rs['dataRest'].'</td>
					<td>'.$rs['titluCarte'].'</td>
					<td>'.$rs['numeAutor'].'</td>
					<td>'.$rs['ISBN'].'</td>
					<td>'.$rs['denumire'].'</td>
					<td>'.$rs['codBare'].'</td>
					</tr>';
				}
    	?>
    	</table>
		</center>
    </div>
    <div class="cautare_pagina">
    	<?php if(ceil($total_pagini/$nr_rezultate_per_pagina)>0): ?>
		    	<center>
					<ul class="pagina">
					<?php if ($pagina > 1): ?>
					<li class="pagina_precedenta"><a href="raport_cartiimprumutate.php?pagina=<?php echo $pagina-1 ?>">Pagină precedentă</a></li>
					<?php endif; ?>

					<?php if ($pagina > 3): ?>
					<li class="inceput"><a href="raport_cartiimprumutate.php?pagina=1">1</a></li>
					<li class="puncte">...</li>
					<?php endif; ?>

					<?php if ($pagina-2 > 0): ?><li class="list_pagina"><a href="raport_cartiimprumutate.php?pagina=<?php echo $pagina-2 ?>"><?php echo $page-2 ?></a></li><?php endif; ?>
					<?php if ($pagina-1 > 0): ?><li class="list_pagina"><a href="raport_cartiimprumutate.php?pagina=<?php echo $pagina-1 ?>"><?php echo $pagina-1 ?></a></li><?php endif; ?>

					<li class="pagina_curenta"><a href="raport_cartiimprumutate.php?pagina=<?php echo $pagina ?>"><?php echo $pagina ?></a></li>

					<?php if ($pagina+1 < ceil($total_pagini / $nr_rezultate_per_pagina)+1): ?><li class="list_pagina"><a href="raport_cartiimprumutate.php?pagina=<?php echo $pagina+1 ?>"><?php echo $pagina+1 ?></a></li><?php endif; ?>
					<?php if ($pagina+2 < ceil($total_pagini / $nr_rezultate_per_pagina)+1): ?><li class="list_pagina"><a href="raport_cartiimprumutate.php?page=<?php echo $pagina+2 ?>"><?php echo $pagina+2 ?></a></li><?php endif; ?>

					<?php if ($pagina < ceil($total_pagini / $nr_rezultate_per_pagina)-2): ?>
					<li class="puncte">...</li>
					<li class="sfarsit"><a href="raport_cartiimprumutate.php?page=<?php echo ceil($total_pagini / $nr_rezultate_per_pagina) ?>"><?php echo ceil($total_pagini / $nr_rezultate_per_pagina) ?></a></li>
					<?php endif; ?>

					<?php if ($pagina < ceil($total_pagini / $nr_rezultate_per_pagina)): ?>
					<li class="urmatoarea_pagina"><a href="raport_cartiimprumutate.php?pagina=<?php echo $pagina+1 ?>">Următoarea pagină</a></li>
					<?php endif; ?>
					</ul>
				</center>
				<?php endif; ?>
			<?php mysqli_close($db);?>
		<?php } ?>
    </div>

    <div class="btnprintare">
    	<p align="center"><button onclick="PrinteazaRaportul('table');" class="btn_printare">Printați Raportul</button></p>
    </div>

    <?php include '../includeri/subsol.php'; ?>
    <script type="text/javascript">
		 function PrinteazaRaportul(element){
		   var restaurarePagina = document.body.innerHTML;
			var continutPrintare = document.getElementById(element).innerHTML;
			document.body.innerHTML = continutPrintare;
			window.print();
			document.body.innerHTML = restaurarePagina;
		}
    </script>
</body>
</html>