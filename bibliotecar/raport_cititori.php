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
	<title>Raport Cititori - Biblioteca Virtuală a Liceului Teoretic "Ioan Petruș"</title>
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
	    		<label style="color: white;" for="nume_cititor">Nume cititor:&nbsp;<input type="text" name="nume_cititor" placeholder="Căutați numele cititorului..." value="<?php if(isset($_POST['nume_cititor'])) echo $_POST['nume_cititor'];?>"></label>&nbsp;<button type="submit" class="btn_cautare" name="cautare_cititor">Caută</button><br/>
	    		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="color: white;" for="oras_cititor">Oraș:&nbsp;<select class="selectareoras" name="oras_cititor"><option value="" disabled selected>Selectați orașul...</option>
	    		<?php $sql="SELECT * FROM Orase ORDER BY numeoras"; $r=mysqli_query($db,$sql); while($rd=mysqli_fetch_row($r)){ echo '<option value="'.$rd[1].'">'.$rd[1].'</option>';} ?></select></label>&nbsp;<button type="submit" class="btn_cautare" name="cautare_oras_cititor">Caută</button>
    		</center>
    	</form>
    </div>
    <div id="table">

    		<center>
	    		<img src="../imagini/img1.jpg" width="210" height="120">
	    	</center>

	    	<br/><br/>

	    	<h4 style="text-align:center; color:black; font-size:35px;">Raport Cititori</h4><br/><br/>
	    	<?php

	    	if(isset($_POST['cautare_cititor'])){

	    		$nume=$_POST['nume_cititor'];

		    	$sql="SELECT idCititor, nume, prenume, dataN, adresa, telefon, cnp, email, serieCI, nrBuletin, nrPermis, numeoras, numejudet FROM Cititori, Orase, Judete WHERE Orase.idJudet=Judete.idJudet AND Cititori.idOras=Orase.idOras AND nume='$nume' ORDER BY idCititor;";

		    	$r=mysqli_query($db,$sql);

		    	echo '
		    	<center>
		    	<table id="container_table" width=60% bgcolor="dodgerblue">
		    	<tr>
		    	<td>Id Cititor</td><td>Nume</td><td>Prenume</td><td>Data Nașterii</td>
		    	<td>Adresa</td><td>Telefon</td><td>CNP</td>
		    	<td>E-mail</td><td>Serie Buletin</td><td>Nr. Buletin</td>
		    	<td>Nr. Permis</td><td>Oraș</td><td>Județ</td>
		    	</tr>';

		    	if(mysqli_num_rows($r)>0){
			    	while ($rs=mysqli_fetch_assoc($r)){
			    		echo '<tr>
			    		<td>'.$rs['idCititor'].'</td>
			    		<td>'.$rs['nume'].'</td>
			    		<td>'.$rs['prenume'].'</td>
			    		<td>'.$rs['dataN'].'</td>
			    		<td>'.$rs['adresa'].'</td>
			    		<td>'.$rs['telefon'].'</td>
			    		<td>'.$rs['cnp'].'</td>
			    		<td>'.$rs['email'].'</td>
			    		<td>'.$rs['serieCI'].'</td>
			    		<td>'.$rs['nrBuletin'].'</td>
			    		<td>'.$rs['nrPermis'].'</td>
			    		<td>'.$rs['numeoras'].'</td>
			    		<td>'.$rs['numejudet'].'</td>
			    		</tr>';
			    	}
			    }else{
			    	echo '<p style="font-weight:bold; font-size: 20px;">Cititorul cu numele '.$nume.' nu există în baza de date!!</p><br/>';
			    }

			    	echo '</table>
			    	</center>';

		    }else if(isset($_POST['cautare_oras_cititor'])){

		    	$oras=$_POST['oras_cititor'];

		    	$sql="SELECT idCititor, nume, prenume, dataN, adresa, telefon, cnp, email, serieCI, nrBuletin, nrPermis, numeoras, numejudet FROM Cititori, Orase, Judete WHERE Orase.idJudet=Judete.idJudet AND Cititori.idOras=Orase.idOras AND numeoras='$oras' ORDER BY idCititor;";

		    	$r=mysqli_query($db,$sql);

		    	echo '
		    	<center>
		    	<table id="container_table" width=60% bgcolor="dodgerblue">
		    	<tr>
		    	<td>Id Cititor</td><td>Nume</td><td>Prenume</td><td>Data Nașterii</td>
		    	<td>Adresa</td><td>Telefon</td><td>CNP</td>
		    	<td>E-mail</td><td>Serie Buletin</td><td>Nr. Buletin</td>
		    	<td>Nr. Permis</td><td>Oraș</td><td>Județ</td>
		    	</tr>';

		    	if(mysqli_num_rows($r)>0){
			    	while ($rs=mysqli_fetch_assoc($r)){
			    		echo '<tr>
			    		<td>'.$rs['idCititor'].'</td>
			    		<td>'.$rs['nume'].'</td>
			    		<td>'.$rs['prenume'].'</td>
			    		<td>'.$rs['dataN'].'</td>
			    		<td>'.$rs['adresa'].'</td>
			    		<td>'.$rs['telefon'].'</td>
			    		<td>'.$rs['cnp'].'</td>
			    		<td>'.$rs['email'].'</td>
			    		<td>'.$rs['serieCI'].'</td>
			    		<td>'.$rs['nrBuletin'].'</td>
			    		<td>'.$rs['nrPermis'].'</td>
			    		<td>'.$rs['numeoras'].'</td>
			    		<td>'.$rs['numejudet'].'</td>
			    		</tr>';
			    	}
			    }else{
			    	echo '<p style="font-weight:bold; font-size: 20px;">Cititorul din orașul '.$oras.' nu există în baza de date!!</p><br/>';
			    }

			    	echo '</table>
			    	</center>';

		    }else{
		    	$total_pagini=mysqli_num_rows(mysqli_query($db,"SELECT idCititor, nume, prenume, dataN, adresa, telefon, cnp, email, serieCI, nrBuletin, nrPermis, numeoras, numejudet FROM cititori, orase, judete WHERE orase.idJudet=judete.idJudet AND cititori.idOras=orase.idOras"));

				//Verifică dacă pagina este specificată și verifică dacă pagina este un număr, altfel returnează numărul implicit de pagină care este egal cu 1
				$pagina=isset($_GET['pagina']) && is_numeric($_GET['pagina']) ? $_GET['pagina']:1;

				//Numărul rezultatelor din fiecare pagină
				$nr_rezultate_per_pagina=8;

				$pagina_calc=($pagina-1)*$nr_rezultate_per_pagina;

				$sql="SELECT idCititor, nume, prenume, dataN, adresa, telefon, cnp, email, serieCI, nrBuletin, nrPermis, numeoras, numejudet FROM cititori, orase, judete WHERE orase.idJudet=judete.idJudet AND cititori.idOras=orase.idOras ORDER BY nume LIMIT ".$pagina_calc.",".$nr_rezultate_per_pagina;

				$r=mysqli_query($db,$sql);

				echo '
		    	<center>
		    	<table id="container_table" width=60% bgcolor="dodgerblue">
		    	<tr>
		    	<td>Id Cititor</td><td>Nume</td><td>Prenume</td><td>Data Nașterii</td>
		    	<td>Adresa</td><td>Telefon</td><td>CNP</td>
		    	<td>E-mail</td><td>Serie Buletin</td><td>Nr. Buletin</td>
		    	<td>Nr. Permis</td><td>Oraș</td><td>Județ</td>
		    	</tr>';

		    	while ($rs=mysqli_fetch_assoc($r)){
			    		echo '<tr>
			    		<td>'.$rs['idCititor'].'</td>
			    		<td>'.$rs['nume'].'</td>
			    		<td>'.$rs['prenume'].'</td>
			    		<td>'.$rs['dataN'].'</td>
			    		<td>'.$rs['adresa'].'</td>
			    		<td>'.$rs['telefon'].'</td>
			    		<td>'.$rs['cnp'].'</td>
			    		<td>'.$rs['email'].'</td>
			    		<td>'.$rs['serieCI'].'</td>
			    		<td>'.$rs['nrBuletin'].'</td>
			    		<td>'.$rs['nrPermis'].'</td>
			    		<td>'.$rs['numeoras'].'</td>
			    		<td>'.$rs['numejudet'].'</td>
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
					<li class="pagina_precedenta"><a href="raport_cititori.php?pagina=<?php echo $pagina-1 ?>">Pagină precedentă</a></li>
					<?php endif; ?>

					<?php if ($pagina > 3): ?>
					<li class="inceput"><a href="raport_cititori.php?pagina=1">1</a></li>
					<li class="puncte">...</li>
					<?php endif; ?>

					<?php if ($pagina-2 > 0): ?><li class="list_pagina"><a href="raport_cititori.php?pagina=<?php echo $pagina-2 ?>"><?php echo $page-2 ?></a></li><?php endif; ?>
					<?php if ($pagina-1 > 0): ?><li class="list_pagina"><a href="raport_cititori.php?pagina=<?php echo $pagina-1 ?>"><?php echo $pagina-1 ?></a></li><?php endif; ?>

					<li class="pagina_curenta"><a href="raport_cititori.php?pagina=<?php echo $pagina ?>"><?php echo $pagina ?></a></li>

					<?php if ($pagina+1 < ceil($total_pagini / $nr_rezultate_per_pagina)+1): ?><li class="list_pagina"><a href="raport_cititori.php?pagina=<?php echo $pagina+1 ?>"><?php echo $pagina+1 ?></a></li><?php endif; ?>
					<?php if ($pagina+2 < ceil($total_pagini / $nr_rezultate_per_pagina)+1): ?><li class="list_pagina"><a href="raport_cititori.php?page=<?php echo $pagina+2 ?>"><?php echo $pagina+2 ?></a></li><?php endif; ?>

					<?php if ($pagina < ceil($total_pagini / $nr_rezultate_per_pagina)-2): ?>
					<li class="puncte">...</li>
					<li class="sfarsit"><a href="raport_cititori.php?page=<?php echo ceil($total_pagini / $nr_rezultate_per_pagina) ?>"><?php echo ceil($total_pagini / $nr_rezultate_per_pagina) ?></a></li>
					<?php endif; ?>

					<?php if ($pagina < ceil($total_pagini / $nr_rezultate_per_pagina)): ?>
					<li class="urmatoarea_pagina"><a href="raport_cititori.php?pagina=<?php echo $pagina+1 ?>">Următoarea pagină</a></li>
					<?php endif; ?>
					</ul>
				</center>
			<?php endif; ?>
		<?php mysqli_close($db);?>
	<?php }?>
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