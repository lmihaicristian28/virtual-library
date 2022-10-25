<?php 
	session_start();

	$_SESSION['autentificat'] = 0;

	if(isset($_POST['autentificare'])){
		$username = htmlspecialchars($_POST['username_bibliotecar']);
		$parola = htmlspecialchars($_POST['parola_bibliotecar']);

		if($username == 'bibliotecar' && $parola == 'bibliotecar'){
			$_SESSION['autentificat'] = 1;
			header('Location: raport_cititori.php');
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
	<title>Autentificare | Bibliotecar - Biblioteca Virtuală a Liceului Teoretic "Ioan Petruș" Otopeni</title>
</head>
<body class="fundal_admin">
	<div class="logo_bibliotecar">
		<img src="../imagini/img1.jpg" alt="Logo Liceu" width="220" height="130">
	</div>
		<div class="formlogin_bibliotecar">
			<div class="formlogin_bibliotecar_container"></div>
				<img style="margin-left: 345px;" src="../imagini/admin.png" width="150" height="120">
				<h2 style="text-align: center; margin-top: 5px;">Autentificare Bibliotecar</h2>
					<div class="formlogin_bibliotecar_group">
			   			<form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
				   			<label for="username_bibliotecar">Username:</label><br/>
				   			<input type="text" name="username_bibliotecar" placeholder="Introduceți username-ul dvs."><br/>
				   			<label for="parola_bibliotecar">Parola:</label><br/>
				   			<input type="password" name="parola_bibliotecar" placeholder="Introduceți parola dvs."><br/>
				   			<input class="btn_login_bibliotecar" type="submit" name="autentificare" value="Autentificare">
			       		</form>
			        </div>
			</div>
		</div>
</body>
</html>