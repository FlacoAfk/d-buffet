<?php

include('conexion.php');


$identificacion=$_POST["id"];
$nombre=$_POST["nom"];
$may= ucwords($nombre); 
$apellido=$_POST["ape"];
$may2= ucwords($apellido); 
$telefono=$_POST["tel"];
$email=$_POST["corre"];
$password1=$_POST["contra"];
$password2=$_POST["contra2"];

$opciones = ['cost' => 12,];

	if ($password1==$password2) {
		$seguridad=password_hash($password1, PASSWORD_DEFAULT, $opciones);
		$regis=mysqli_query($mysqli,"insert into user(id_user, nom_user, apell_user, tel_user , correo_user ,contra_user, Cod_clase_user) values('$identificacion', '$may', '$may2', '$telefono' ,'$email', '$seguridad', '2')") or die ("<script>alert('Error al enviar la informacion');  location='../index.php';</script>");
		if ($regis) {
			echo "<script>alert('Informacion enviada correctamente'); location='../index.php';</script>";
		}
		else{
			echo "<script>alert('Error al guardar la informacion'); location='../index.php';</script>";
		}
	}
	else{
		echo "<script>alert('Las contraseñas no coinciden');location='../index.php';</script>";
	}

?> 