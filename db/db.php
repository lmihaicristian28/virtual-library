<?php 
$db=mysqli_connect('localhost','root','','biblioteca');
if(!$db){
	die("Ups! Probleme de conexiune la baza de date MySQL!".mysqli_error());
}
?>