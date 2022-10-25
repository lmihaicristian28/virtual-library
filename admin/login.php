<?php 
	session_start();

	$_SESSION['autentificat'] = 0;

	if(isset($_POST['logare'])){
		$username = htmlspecialchars($_POST['username_admin']);
		$parola = htmlspecialchars($_POST['parola_admin']);

		if($username == 'admin' && $parola == 'admin'){
			$_SESSION['autentificat'] = 1;
			header('Location: meniu.php');
		}else{
			echo '
				<div class="avertizare">
					<h2>Ups!</h2>
					<p>Username-ul sau parola sunt greșite! Mai încercați din nou!<p>
				</div>
			';
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
	<title>Autentificare | Admin - Biblioteca Virtuală a Liceului Teoretic "Ioan Petruș" Otopeni</title>
</head>
<body class="fundal_admin">
	<div class="logo_admin">
		<img src="../imagini/img1.jpg" alt="Logo Liceu" width="220" height="130">
	</div>
		<div class="formlogin_admin">
			<div class="formlogin_admin_container"></div>
				<img style="margin-left: 345px;" src="../imagini/admin.png" width="150" height="120">
				<h2 style="text-align: center; margin-top: 5px;">Autentificare Admin</h2>
					<div class="formlogin_admin_group">
			   			<form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
				   			<label for="username_admin">Username:</label><br/>
				   			<input type="text" name="username_admin" placeholder="Introduceți username-ul dvs."><br/>
				   			<label for="parola_admin">Parola:</label><br/>
				   			<input type="password" name="parola_admin" placeholder="Introduceți parola dvs."><br/>
				   			<input class="btn_login_admin" type="submit" name="logare" value="Autentificare">
			       		</form>
			        </div>
			</div>
		</div>
</body>
</html>