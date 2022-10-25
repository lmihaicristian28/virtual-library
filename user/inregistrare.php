<?php 
	session_start();
	require ("../db/db.php");

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	require_once "PHPMailer-6.6.3/src/PHPMailer.php";
	require_once "PHPMailer-6.6.3/src/SMTP.php";
	require_once "PHPMailer-6.6.3/src/Exception.php";

	$eroare="";

	error_reporting(0);
	if(isset($_POST['inregistrare'])){

		$nume=$_POST['nume'];
		$prenume=$_POST['prenume'];
		$datanasterii=$_POST['datanasterii'];
		$adresa=$_POST['adresa'];
		$telefon=$_POST['telefon'];
		$cnp=$_POST['cnp'];
		$email=$_POST['email'];
		$seriebuletin=$_POST['seriebuletin'];
		$nrbuletin=$_POST['nrbuletin'];
		$nrpermis=$_POST['nrpermis'];
		$username=$_POST['username'];
		$parola=$_POST['parola'];
		$confparola=$_POST['confparola'];
		$codv=md5(rand());

		if(!empty($nume) && !empty($prenume) && !empty($datanasterii) && !empty($adresa) && !empty($_POST['IdOras']) && !empty($_POST['IdJudet']) && !empty($telefon) && !empty($cnp) && !empty($email) && !empty($seriebuletin) && !empty($nrbuletin) && !empty($nrpermis) && !empty($username) && !empty($parola)){

			$sql1="SELECT * FROM Cititori WHERE email='$email' OR username='$username';";

			if(mysqli_num_rows(mysqli_query($db,$sql1))>0){
				$eroare="Adresa de mail sau username-ul există deja într-un cont!!";
			}else{
				if($parola==$confparola){

					$sql2="INSERT INTO Cititori(idCititor,nume,prenume,dataN,adresa,telefon,cnp,email,serieCI,nrBuletin,nrPermis,username,parola,idOras,idJudet,codv) VALUES ('','$nume','$prenume','$datanasterii','$adresa','$telefon','$cnp','$email','$seriebuletin','$nrbuletin','$nrpermis','$username','$parola','".$_POST['IdOras']."','".$_POST['IdJudet']."','$codv');";

					if(mysqli_query($db,$sql2)){
						$mail = new PHPMailer(true);
						//Setările serverului de mail 
			            $mail->SMTPDebug = SMTP::DEBUG_SERVER;             
			            $mail->isSMTP();                                           
			            $mail->Host = 'smtp.gmail.com';                     
			            $mail->SMTPAuth = true;                                  
			            $mail->Username = 'mlapugeanu@gmail.com';                     
			            $mail->Password = 'wkrikfivqzlzxzlb';                              
			            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;          
			            $mail->Port = 465;                                   
			            //Trimitere mail
			            $mail->setFrom('mlapugeanu@gmail.com','Biblioteca Virtuala - Liceul Teoretic "Ioan Petrus"');
			            $mail->addAddress($email);

			            $mail->isHTML(true);                                  
			            $mail->Subject = 'Confirmare inregistrare cont';

			            $continutMail='Buna ziua, '.$nume.' '.$prenume.'!<br/>';
			            $continutMail.='Te rugăm să faci click pe link-ul următor pentru a confirma adresa de mail și pentru a activa contul tau de utilizator de pe Biblioteca Virtuală a Liceului Teoretic "Ioan Petruș" Otopeni: <br/> ';
			            $continutMail.="<a href='http://localhost/Licenta/user/verificare.php?codv=$codv'>Click Aici</a>";
			            $mail->Body = $continutMail;
			                    
			            if($mail->send()){
			                header('Location:contsucces.php');
			            }else{
			                $eroare="Mesajul de confirmare nu poate fi trimis. Eroare mail: {$mail->ErrorInfo}";
			            }
					}else{
						$eroare="Ups! Ceva s-a întâmplat la trimiterea mail-ului de confirmare.";
					}
				}else{
					$eroare="Parola și Confirmarea parolei nu corespund!!";
				}
			}
			if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
				$eroare="Adresa de mail este invalidă!!";
			}
			if(!preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $parola)) {
				$eroare= "Parola trebuie să aibă cel puțin 8 caractere și trebuie să conțină un număr, o literă mare, literă mică,
				literă mare și caractere speciale";
			}
			if(strlen($cnp)!=13){
				$eroare="CNP-ul trebuie să aibă 13 caractere!";
			}
			if(strlen($telefon)!=10){
				$eroare="Numărul de telefon trebuie să aibă 10 caractere!";
			}
			if(strlen($seriebuletin)>2){
				$eroare="Seria buletinului trebuie să aibă 2 caractere!";
			}
			if(!preg_match('/^[A-Za-z][A-Za-z0-9]{5,31}$/', $username)){
				$eroare="Username-ul este invalid!";
			}
		}else{
			$eroare="Toate câmpurile sunt obligatorii!!";
		}
		mysqli_close($db);
	}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="icon" type="image/x-icon" href="../imagini/carte.png">
	<title>Biblioteca Virtuală - Lieceul Teoretic "Ioan Petruș" Otopeni - Înregistrare cont</title>
</head>
<body class="fundal">
	<?php 
	include '../includeri/antet.php';
	include '../includeri/meniu.php';
	?>

	<div class="inregistrare">
		<div class="inregistrare_container">
			<div class="form">
				<div id="container_form_autent">
					<center>
					<h2 class="titluautent">Înregistrare cont</h2>
					</center>
					<center>
						<span style="color:red; font-weight: bold;"><?php echo $eroare; ?></span>
					</center>
					<div class="formgroup">
						<form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
							<label for="nume">Nume:</label><br/>
							<input type="text" name="nume" placeholder="Introduceți numele dvs." value="<?php if(isset($_POST['inregistrare'])) echo $_POST['nume'];?>"><br/>
							<label for="prenume">Prenume:</label><br/>
							<input type="text" name="prenume" placeholder="Introduceți prenumele dvs." value="<?php if(isset($_POST['inregistrare'])) echo $_POST['prenume'];?>"><br/>
							<label for="datanasterii">Data nașterii:</label><br/>
							<input type="date" name="datanasterii" placeholder="Introduceți data nașterii dvs." value="<?php if(isset($_POST['inregistrare'])) echo $_POST['datanasterii'];?>"><br/>
							<label for="adresa">Adresa:</label><br/>
							<input type="text" name="adresa" placeholder="Introduceți strada și numărul" value="<?php if(isset($_POST['inregistrare'])) echo $_POST['adresa'];?>"><br/>
							<label for="IdJudet">Județ:</label><br/>
							<select class="selectarejudet" name="IdJudet" id="judet">
								<option value="" disabled selected>Selectați județul de domiciliu...</option>
								<?php 
									$sql="SELECT * FROM Judete ORDER BY numejudet;";
									$rez=mysqli_query($db,$sql);
									while($rd=mysqli_fetch_array($rez)){
								?>
								<option value="<?php echo $rd['idJudet'];?>"><?php echo $rd['numejudet'];?></option>
								<?php }?>
							</select><br/>
							<label for="IdOras">Oraș:</label><br/>
							<select class="selectareoras" name="IdOras" id="oras">
								<option value="" disabled selected>Selectați orașul de domiciliu...</option>
							</select><br/>
							<label for="telefon">Telefon:</label><br/>
							<input type="text" name="telefon" placeholder="Introduceți numărul dvs. de telefon" value="<?php if(isset($_POST['inregistrare'])) echo $_POST['telefon'];?>"><br/>
							<label for="cnp">CNP:</label><br/>
							<input type="text" name="cnp" placeholder="Introduceți cnp-ul dvs." value="<?php if(isset($_POST['inregistrare'])) echo $_POST['cnp'];?>"><br/>
							<label for="email">E-mail:</label><br/>
							<input class="inputemail" type="email" name="email" placeholder="Introduceți e-mail-ul dvs." value="<?php if(isset($_POST['inregistrare'])) echo $_POST['email'];?>"><br/>
							<label for="seriebuletin">Serie CI/BI</label><br/>
							<input type="text" name="seriebuletin" placeholder="Introduceți seria buletinului dvs." value="<?php if(isset($_POST['inregistrare'])) echo $_POST['seriebuletin'];?>"><br/>
							<label for="nrbuletin">Nr. buletinului:</label><br/>
							<input class="inputnrbuletin" type="text" name="nrbuletin" placeholder="Introduceți numărul buletinului dvs." value="<?php if(isset($_POST['inregistrare'])) echo $_POST['nrbuletin'];?>"><br/>
							<label for="nrpermis">Nr. permisului:</label><br/>
							<input type="text" name="nrpermis" placeholder="Introduceți numărul permisului dvs." value="<?php if(isset($_POST['inregistrare'])) echo $_POST['nrpermis'];?>"><br/>
							<label for="username">Username:</label><br/>
							<input type="text" name="username" placeholder="Alegeți username-ul pe care doriți să-l utilizați" value="<?php if(isset($_POST['inregistrare'])) echo $_POST['username'];?>"><br/>
							<label for="parola">Parola:</label><br/>
							<input type="password" name="parola" placeholder="Alegeți parola dvs." value="<?php if(isset($_POST['inregistrare'])) echo $_POST['parola'];?>" id="parola"><br/>
							<label for="confparola">Confirmare parolă:</label><br/>
							<input type="password" name="confparola" placeholder="Confirmați parola dvs." value="<?php if(isset($_POST['inregistrare'])) echo $_POST['confparola'];?>" id="confparola"><br/>
							<input style="margin-left: -140px;" type="checkbox" onclick="ArataParola()">Arată parola<br/><br/>
							<center>
							<input class="inputinregistrare" type="submit" name="inregistrare" value="Înregistrare">
							</center><br/>
							<p style="margin-left: -20px;">Dacă aveți cont, puteți să vă logați<a style="color: blue;" href="login.php">aici</a>!</p>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		function ArataParola(){
			var x = document.getElementById("parola");
			var y = document.getElementById("confparola");
			if(x.type==="password"){
				x.type="text";
				y.type="text";
			}else{
				x.type="password";
				y.type="password";
			}
		}
	</script>

	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
                $('#judet').on('change', function() {
                    var IdJudet = this.value;
                    $.ajax({
                        url: "orase.php",
                        type: "POST",
                        data: {
                            IdJudet: IdJudet
                        },
                        cache: false,
                        success: function(result) {
                            $("#oras").html(result);
                        }
                    });
                });
            });
	</script>
	<?php
	include '../includeri/subsol.php';
	?>
</body>
</html>