<?php
	session_start();

	$cod = $_SESSION['Cod_clase_user'];
	$sesion = $_SESSION['correo_user'];
	$nombre=  $_SESSION['nom_user']." ".$_SESSION['apell_user'];

	if (isset($cod) && isset($sesion)) {

		if ($cod=="2") {
		}
		else{
			echo "<script>alert('Usted no esta autorizado');</script>";
			session_destroy();
			echo "<script>location='../../index.php'</script>";
			die();
		}
	}
	else{
		echo "<script>alert('Usted no esta autorizado');</script>";
			session_destroy();
			echo "<script>location='../../../../index.php'</script>";
			die();
	}
?>