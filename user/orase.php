<?php 
	require ("../db/db.php");
	$output='';
	$sql="SELECT * FROM Orase WHERE idJudet='".$_POST['IdJudet']."';";
	$rez=mysqli_query($db,$sql);
	$output .='<option value="" disabled selected>Selectați orașul de domiciliu...</option>';
	while ($rd=mysqli_fetch_array($rez)){
		$output .='<option value="'.$rd['idOras'].'">'.$rd['numeoras']."</option>";
	}
	echo $output;
?>