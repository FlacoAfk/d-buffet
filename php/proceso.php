 <?php
 
 session_start();

 $usuario=$_POST["usuario"];
 $contrasena=$_POST["contraseña"];
 include("conexion.php");
$proceso = $mysqli -> query("SELECT * FROM user WHERE correo_user='$usuario'") or die ("<script>alert('No se pudo validar la informacion');  location='../index.php';</script>");

if($resultado = mysqli_fetch_array($proceso)){

	$seguridad=password_verify($contrasena, $resultado['contra_user']);

	if ($seguridad == true) {


		if ($resultado['Cod_clase_user']=== "2") {
		$_SESSION['correo_user']=$usuario;
		$_SESSION['nom_user']=$resultado['nom_user'];
		$_SESSION['apell_user']=$resultado['apell_user'];
		$_SESSION['Cod_clase_user']="2";
		$_SESSION['tel_user']=$resultado['tel_user'];
		$_SESSION['Cod_clase_user']=$resultado['Cod_clase_user'];
		$_SESSION['id_user']=$resultado['id_user'];
		echo "<script>alert('Bienvenido Señor(a) ".$resultado['nom_user']." ".$resultado['apell_user']."'); location='../index.php';</script>";
		}
		elseif ($resultado['Cod_clase_user']=== "1") {
		
		$_SESSION['correo_user']=$usuario;
		$_SESSION['nom_user']=$resultado['nom_user'];
		$_SESSION['apell_user']=$resultado['apell_user'];
		$_SESSION['Cod_clase_user']="1";
		$_SESSION['tel_user']=$resultado['tel_user'];
		$_SESSION['Cod_clase_user']=$resultado['Cod_clase_user'];
		$_SESSION['id_user']=$resultado['id_user'];
		echo "<script>alert('Bienvenido Señor(a) ".$resultado['nom_user']." ".$resultado['apell_user']." (Administrador)'); location='../index.php';</script>";

		}

		else{
			
		echo "<script>alert('Error al procesar la informacion'); location='../index.php';</script>";
		}
	}
	else{
		echo "<script>alert('Contraseña u correo no son validos'); location='../index.php';</script>";
	}
}
else{
	echo "<script>alert('Contraseña u correo no son validos'); location='../index.php';</script>";
}
?>