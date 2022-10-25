<?php 
include ("../db/db.php");

	error_reporting(0);
	if(isset($_POST['adauga'])){

		$titlu_carte=$_POST['titlu_carte'];
		$isbn=$_POST['isbn_carte'];
		$cota_carte=$_POST['cota_carte'];
		$nrinv_carte=$_POST['nrinv_carte'];
		$pret_carte=$_POST['pret_carte'];
		$eroare='';

		if(!empty($titlu_carte) && !empty($_POST['IdAutor']) && !empty($isbn) && !empty($cota_carte) && !empty($nrinv_carte) && !empty($_POST['IdEditura']) && !empty($pret_carte) && !empty($_POST['IdGen']) && !empty($_POST['IdStoc']) && !empty($_FILES['imgcarte']['tmp_name']) && file_exists($_FILES['imgcarte']['tmp_name'])){
			if(mysqli_num_rows(mysqli_query($db,"SELECT * FROM Carti WHERE titluCarte='$titlu_carte'"))){
				$eroare='Cartea introdusă există în baza de date! Introduceți o altă carte!';
			}else{
				$img_carte=addslashes(file_get_contents($_FILES['imgcarte']['tmp_name']));

				$sql="INSERT INTO Carti SET titluCarte='$titlu_carte', idAutor='".$_POST['IdAutor']."', ISBN='$isbn',
				cota='$cota_carte',nrInv='$nrinv_carte',idEditura='".$_POST['IdEditura']."',pret='$pret_carte',idGen='".$_POST['IdGen']."', idStoc='".$_POST['IdStoc']."', imgCarte='$imgcarte';";

				if(mysqli_query($db,$sql)){
					echo '<script>alert("Cartea a fost adăugată cu succes")</script>';
				}
			}
		}else{
				$eroare='Toate câmpurile sunt obligatorii!!';
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
	<title>Adaugă cartea | Admin - Biblioteca virtuală a Liceului Teoretic "Ioan Petruș" Otopeni</title>
</head>
<body class="fundal_admin">
	<div class="container_meniu">
		<div class="bara_meniu">
			<img src="../imagini/img1.jpg" style="width: 180px; margin-left: 80px; margin-top: 15px;"><br/>
			<h3 style="margin-top: 10px; margin-left: 30px; color: white; font-size: 25px;">BIBLIOTECĂ VIRTUALĂ</h3>
			<span style="float: right; color:white; margin-top: -80px; font-size: 25px">Bine ai venit, Admin! -<a href="login.php">Deconectare</a></span>
			<a style="float:right; margin-top: -40px; font-size:20px;" href="meniu.php">Înapoi la meniu</a>
		</div>
		<div class="form_adaugacartea">
			<div class="form_container_adaugacartea">
				<form action="<?php $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
					<h2 style="font-size: 30px;">Adaugă cartea</h2><br/>
					<span style="text-align:center; color:red; font-weight: bold;"><?php echo $eroare; ?></span>
					<br/><br/>
				    <label style="color: black;" for="titlu_carte">Titlul cărții:</label><br/>
					<input type="text" name="titlu_carte" placeholder="Introduceți titlul cărții..."/><br/>
					<label style="color: black;" for="autor_carte">Autorul cărții:</label><br/>
					<select class="autor" name="IdAutor">
						<option value="" disabled selected>Selectați autorul cărții...</option>
						<?php
				    	//$db=mysqli_connect('localhost','root','','biblioteca');
				    	$sql="SELECT * FROM Autori ORDER BY numeAutor;";
				    	$qr=mysqli_query($db,$sql);
				    	while($rd=mysqli_fetch_row($qr))
				    		echo "<option value=".$rd[0].">".$rd[1]."</option>";
				    	?>
					</select><br/>
					<label style="color: black;" for="isbn_carte">ISBN:</label><br/>
					<input type="text" name="isbn_carte" placeholder="Introduceți ISBN-ul cărții..." maxlength="13"/><br/>
					<label style="color: black;" for="cota_carte">Cota cărții:</label><br/>
					<input type="text" name="cota_carte" placeholder="Introduceți cota cărții..."/><br/>
					<label style="color: black;" for="nrinv_carte">Nr. de inventar:</label><br/>
					<input type="text" name="nrinv_carte" placeholder="Introduceți nr. de inventar al cărții..."/><br/>
					<label style="color: black;" for="editura_carte">Editura:</label><br/>
					<select class="editura" name="IdEditura">
						<option value="" disabled selected>Selectați editura cărții...</option>
						<?php
				    	//$db=mysqli_connect('localhost','root','','biblioteca');
				    	$sql="SELECT * FROM Edituri ORDER BY denumire;";
				    	$qr=mysqli_query($db,$sql);
				    	while($rd=mysqli_fetch_row($qr))
				    		echo "<option value=".$rd[0].">".$rd[1]."</option>";
				    	?>
					</select><br/>
					<label style="color: black;" for="pret_carte">Prețul cărții:</label><br/>
				    <input type="text" name="pret_carte" placeholder="Introduceți prețul cărții..."/><br/>
				    <label style="color: black;" for="gen_carte">Genul cărții:</label><br/>
				    <select class="gen" name="IdGen">
				    	<option value="" disabled selected>Selectați genul cărții...</option>
				    	<?php
				    	//$db=mysqli_connect('localhost','root','','biblioteca');
				    	$sql="SELECT * FROM Genuri ORDER BY denGen;";
				    	$qr=mysqli_query($db,$sql);
				    	while($rd=mysqli_fetch_row($qr))
				    		echo "<option value=".$rd[0].">".$rd[1]."</option>";
				    	?>
				    </select><br/>
				    <label style="color:black" for="stoc">Stoc:</label><br/>
				    <select class="stoc" name="IdStoc">
				    	<option value="" disabled selected>Selectați stocul cărții...</option>
				    	<?php
				    	//$db=mysqli_connect('localhost','root','','biblioteca');
				    	$sql="SELECT * FROM Stocuri ORDER BY den_stoc;";
				    	$qr=mysqli_query($db,$sql);
				    	while($rd=mysqli_fetch_row($qr))
				    		echo "<option value=".$rd[0].">".$rd[1]."</option>";
				    	?>
				    </select><br/>
				    <label style="color:black;" for="imgcarte">Coperta cărții:</label><br/>
				    <div class="incarcare_coperta">
				    <input type="file" name="imgcarte" class="fisier_incarcare" id="fisier">
				    <button class="btn_incarcare_fisier" type="button">Alegeți o imagine a coperții</button>&nbsp;
				    <span class="eticheta_fisier"></span>
					</div><br/><br/>
				    <button class="adaugare_carte" type="submit" name="adauga">Adaugă cartea</button>
				</form>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		Array.prototype.forEach.call(
  		document.querySelectorAll(".btn_incarcare_fisier"),
  		function(button) {
	    const hiddenInput = button.parentElement.querySelector(
	      ".fisier_incarcare"
	    );
	    const label = button.parentElement.querySelector(".eticheta_fisier");
	    const defaultLabelText = "Niciun fișier selectat";

	    // Setare text implicit pentru tag-ul <label>
	    label.textContent = defaultLabelText;
	    label.title = defaultLabelText;

	    button.addEventListener("click", function() {
	      hiddenInput.click();
	    });

	    hiddenInput.addEventListener("change", function() {
	      const filenameList = Array.prototype.map.call(hiddenInput.files, function(
	        file
	      ) {
	        return file.name;
	      });

	      label.textContent = filenameList.join(", ") || defaultLabelText;
	      label.title = label.textContent;
	    });
  	}
);
	</script>
</body>
</html>