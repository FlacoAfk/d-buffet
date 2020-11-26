<?php
include("../../../../php/conexion.php");
include("../../../../php/seguridad.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>

<style type="text/css">
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}

input[type=number] { -moz-appearance:textfield; }
</style>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Crud</title>

	<!-- Bootstrap -->
	<link href="../bootstrap/bootstrap2/css/bootstrap.min.css" rel="stylesheet">
	<link href="../bootstrap/bootstrap2/css/bootstrap-datepicker.css" rel="stylesheet">
	<link href="../bootstrap/bootstrap2/css/style_nav.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<div class="content">
			<h2>Datos de los usuarios &raquo; Agregar datos</h2>
			<hr />

			<?php
			if(isset($_POST['add'])){
				$id	     = mysqli_real_escape_string($mysqli,(strip_tags($_POST["id"],ENT_QUOTES)));//Escanpando caracteres 
				$nombres2	 = mysqli_real_escape_string($mysqli,(strip_tags($_POST["nombres"],ENT_QUOTES)));//Escanpando caracteres 

				$nombres=ucwords($nombres2);

				$apellidos2	 = mysqli_real_escape_string($mysqli,(strip_tags($_POST["apellidos"],ENT_QUOTES)));//Escanpando caracteres 

				$apellidos=ucwords($apellidos2);

				$telefono	 = mysqli_real_escape_string($mysqli,(strip_tags($_POST["telefono"],ENT_QUOTES)));//Escanpando caracteres 
				$correo	     = mysqli_real_escape_string($mysqli,(strip_tags($_POST["correo"],ENT_QUOTES)));//Escanpando caracteres 
				$mysqlitraseña	 = mysqli_real_escape_string($mysqli,(strip_tags($_POST["contraseña"],ENT_QUOTES)));//Escanpando caracteres 
				
				$opciones = ['cost' => 12,];
				$seguridad=password_hash($mysqlitraseña, PASSWORD_DEFAULT, $opciones);

				$cek = mysqli_query($mysqli, "SELECT * FROM user WHERE id_user='$id'");
				if(mysqli_num_rows($cek) == 0){
						$insert = mysqli_query($mysqli, "INSERT INTO user(id_user, nom_user, apell_user, tel_user, contra_user, correo_user, Cod_clase_user) VALUES('$id','$nombres', '$apellidos', '$telefono', '$seguridad', '$correo', '2')") or die(mysqli_error());
						if($insert){
							echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Bien hecho! Los datos han sido guardados con éxito.</div>';
						}else{
							echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. No se pudo guardar los datos !</div>';
						}
					 
				}else{
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. código exite!</div>';
				}
			}
			?>

			<form class="form-horizontal" action="" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label">Identificacion</label>
					<div class="col-sm-4">
						<input type="number" name="id" class="form-control" placeholder="Identificacion" required min="0">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Nombres</label>
					<div class="col-sm-4">
						<input type="text" name="nombres" class="form-control" placeholder="Nombres" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Apellidos</label>
					<div class="col-sm-4">
						<input type="text" name="apellidos" class="form-control" placeholder="Apellidos" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Telefono</label>
					<div class="col-sm-4">
						<input type="number" name="telefono" class="form-control" placeholder="Telefono" min="0" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Correo</label>
					<div class="col-sm-4">
						<input type="email" name="correo" class="form-control" placeholder="Correo" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Contraseña</label>
					<div class="col-sm-4">
						<input type="password" name="contraseña" class="form-control" placeholder="Contraseña" minlength="6" required>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="add" class="btn btn-sm btn-primary" value="Guardar datos">
						<a href="add.php" class="btn btn-sm btn-danger">Cancelar</a>
					</div>
				</div>
			</form>
		</div>
	</div>
	<br>
	<br>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="../bootstrap/bootstrap2/jquery/jquery.js"></script>
	<script src="../bootstrap/bootstrap2/js/bootstrap.min.js"></script>
	<script src="../bootstrap/bootstrap2/js/bootstrap.js"></script>
	<script src="../bootstrap/bootstrap2/js/bootstrap.min.js"></script>
	<script>
	$('.date').datepicker({
		format: 'dd-mm-yyyy',
	})
	</script>
</body>
</html>
