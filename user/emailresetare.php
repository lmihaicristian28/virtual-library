<?php 
	include("../db/db.php");
	session_start();

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	require_once "PHPMailer-6.6.3/src/PHPMailer.php";
	require_once "PHPMailer-6.6.3/src/SMTP.php";
	require_once "PHPMailer-6.6.3/src/Exception.php";

	$eroare="";

	error_reporting(0);

	if(isset($_POST['trimite_mail'])){

		$email=$_POST['email'];
		$codv_resetare=md5(rand());

		if(!empty($email)){
			if(mysqli_num_rows(mysqli_query($db,"SELECT * FROM Cititori WHERE email='$email'"))>0){

				$sql="UPDATE Cititori SET codv='$codv_resetare' WHERE email='$email';";

				if(mysqli_query($db,$sql)){
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
				            $mail->Subject = 'Resetare parola';

				            $continutMail='Buna ziua, '.$nume.' '.$prenume.'!<br/>';
				            $continutMail.='Te rugăm să faci click pe link-ul următor pentru  a schimba parola ta de utilizator de pe Biblioteca Virtuală a Liceului Teoretic "Ioan Petruș" Otopeni: <br/> ';
				            $continutMail.="<a href='http://localhost/Licenta/user/resetare.php?codv_resetare=$codv_resetare'>Click Aici</a>";
				            $mail->Body = $continutMail;
				                    
				            if($mail->send()){
				                header('Location:contsucces.php');
				            }else{
				                $eroare="Mesajul de confirmare nu poate fi trimis. Eroare mail: {$mail->ErrorInfo}";
				            }
				}
			}else{
				$eroare="Adresa de email nu a fost găsită!!";
			}
		}else{
			$eroare="Câmpul trebuie completat!";
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
	<title>Resetare parolă - Biblioteca Virtuală a Liceului Teoretic "Ioan Petruș" Otopeni</title>
</head>
<body class="fundal">
	<?php 
	include '../includeri/antet.php';
	include '../includeri/meniu.php';
	?>

	<div class="reset">
		<div class="reset_container">
			<div class="formreset">
				<div id="container_form_reset">
					<center>
						<h2>Resetare parolă</h2>
						<span style="color:red; font-weight: bold;"><?php echo $eroare; ?></span>
						<form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
							<label for="email">E-mail:</label><br/>
							<input class="inputemail" type="mail" name="email" placeholder="Introduceți adresa dvs. de e-mail..."><br/>
							<button type="submit" name="trimite_mail" class="btn_trimitere">Trimite</button>
						</form>
					</center>
				</div>
			</div>
		</div>
	</div>
	

	<?php include '../includeri/subsol.php'?>
</body>
</html>