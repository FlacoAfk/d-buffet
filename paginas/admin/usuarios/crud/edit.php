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
	<title>Datos de los usuarios</title>

	<!-- Bootstrap -->
	<link href="../bootstrap/bootstrap2/css/bootstrap.min.css" rel="stylesheet">
	<link href="../bootstrap/bootstrap2/css/bootstrap-datepicker.css" rel="stylesheet">
	<link href="../bootstrap/bootstrap2/css/style_nav.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<div class="content">
			<h2>Datos de los usuarios &raquo; Editar datos</h2>
			<hr />
			
			<?php
			// escaping, additionally removing everything that could be (html/javascript-) code
			$nik = mysqli_real_escape_string($mysqli,(strip_tags($_GET["nik"],ENT_QUOTES)));
			$sql = mysqli_query($mysqli, "SELECT * FROM user WHERE id_user='$nik'");
			if(mysqli_num_rows($sql) == 0){
				header("Location: index.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			if(isset($_POST['save'])){
				$id	     = mysqli_real_escape_string($mysqli,(strip_tags($_POST["id"],ENT_QUOTES)));//Escanpando caracteres 
				$nombres2	 = mysqli_real_escape_string($mysqli,(strip_tags($_POST["nombres"],ENT_QUOTES)));//Escanpando caracteres 

				$nombres= ucwords($nombres2);

				$apellidos2	 = mysqli_real_escape_string($mysqli,(strip_tags($_POST["apellidos"],ENT_QUOTES)));//Escanpando caracteres 

				$apellidos= ucwords($apellidos2);

				$telefono	 = mysqli_real_escape_string($mysqli,(strip_tags($_POST["telefono"],ENT_QUOTES)));//Escanpando caracteres 
				$correo	     = mysqli_real_escape_string($mysqli,(strip_tags($_POST["correo"],ENT_QUOTES)));//Escanpando caracteres 
				$mysqlitraseña	 = mysqli_real_escape_string($mysqli,(strip_tags($_POST["contraseña"],ENT_QUOTES)));//Escanpando caracteres 
				
				$opciones = ['cost' => 12,];
				$seguridad=password_hash($mysqlitraseña, PASSWORD_DEFAULT, $opciones);

				if (empty($_POST['contraseña'])) {

					$update = mysqli_query($mysqli, "UPDATE user SET id_user='$id', nom_user='$nombres', apell_user='$apellidos', tel_user='$telefono', correo_user='$correo' WHERE id_user='$nik'") or die(mysqli_error());
				}
				else{
					$update = mysqli_query($mysqli, "UPDATE user SET id_user='$id', nom_user='$nombres', apell_user='$apellidos', tel_user='$telefono', correo_user='$correo', contra_user='$seguridad' WHERE id_user='$nik'") or die(mysqli_error());
				}
				if($update){
					header("Location: edit.php?nik=".$nik."&pesan=sukses");
				}else{
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error, no se pudo guardar los datos.</div>';
				}
			}
			
			if(isset($_GET['pesan']) == 'sukses'){
				echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Los datos han sido guardados con éxito.</div>';
					if (isset($_GET['pesan'])) {
							sleep(2);
							echo "<script>location='index.php';</script>";
					}
			}
			?>
			<form class="form-horizontal" action="" method="post" onload="document.inicio.reset();">
				<div class="form-group">
					<label class="col-sm-3 control-label">N° Identidad</label>
					<div class="col-sm-4">
						<input type="number" name="id" value="<?php echo $row ['id_user']; ?>" class="form-control" placeholder="N° Identidad" required min="0">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Nombres</label>
					<div class="col-sm-4">
						<input type="text" name="nombres" value="<?php echo $row ['nom_user']; ?>" class="form-control" placeholder="Nombres" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Apellidos</label>
					<div class="col-sm-4">
						<input type="text" name="apellidos" value="<?php echo $row ['apell_user']; ?>" class="form-control" placeholder="Apellidos" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Telefono</label>
					<div class="col-sm-4">
						<input type="number" name="telefono" value="<?php echo $row ['tel_user']; ?>" class="form-control" placeholder="Telefono" required min="0">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Correo</label>
					<div class="col-sm-4">
						<input type="email" name="correo" value="<?php echo $row ['correo_user']; ?>" class="form-control" placeholder="Correo" required>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Contraseña</label>
					<div class="col-sm-4">
						<input type="text" name="contraseña" class="form-control" placeholder="Contraseña" minlength="6">
					</div>
				</div>
			
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="save" class="btn btn-sm btn-primary" value="Guardar datos">
						<a href="index.php" class="btn btn-sm btn-danger">Cancelar</a>
					</div>
				</div>
			</form>
		</div>
	</div>
	<br><br>
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