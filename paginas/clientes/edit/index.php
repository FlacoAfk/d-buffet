<?php 
session_start();
include('../../../php/conexion.php');
$sesion=$_SESSION['id_user'];
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style type="text/css">
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}

input[type=number] { -moz-appearance:textfield; }
</style>
<!-- Bootstrap -->
	<link href="../bootstrap/bootstrap2/css/bootstrap.min.css" rel="stylesheet">
	<link href="../bootstrap/bootstrap2/css/bootstrap-datepicker.css" rel="stylesheet">
	<link href="../bootstrap/bootstrap2/css/style_nav.css" rel="stylesheet">
</head>
<body>
	<div class="container">
	<div class="content">
			<h2>Editar datos &raquo; <?php echo $_SESSION['nom_user']." ".$_SESSION['apell_user']; ?></h2>
		<div class="row py-4"></div>
			 	 	<?php 
			 	 	$sql2=mysqli_query($mysqli, "SELECT * FROM user WHERE id_user='$sesion'");
			 	 	if ($row2=mysqli_fetch_array($sql2)):
			 	 	 ?>
			 	 <form action="" method="POST" onload="document.inicio.reset();">
			 	 <h4>Actualizar Informacion</h4>
		  			<div class="form-group">
		   			 <label for="1">Modificar Id</label>
		    		 <input type="number" class="form-control" id="1" name="id" value="<?php echo $row2['id_user']; ?>" required>
		  			</div>
		  			<div class="form-group">
		   			 <label for="2">Modificar Nombres</label>
		    		 <input type="text" class="form-control" id="2" name="nom" value="<?php echo $row2['nom_user']; ?>" required>
		  			</div>
		  			<div class="form-group">
		   			 <label for="3">Modificar Apellidos</label>
		    		 <input type="text" class="form-control" id="3" name="apell" value="<?php echo $row2['apell_user']; ?>" required>
		  			</div>		  			
		  			<div class="form-group">
		   			 <label for="4">Modificar Telefono</label>
		    		 <input type="number" class="form-control" id="4" name="tel" value="<?php echo $row2['tel_user']; ?>" required>
		  			</div>
		  			<div class="form-group">
		   			 <label for="5">Modificar Correo</label>
		    		 <input type="email" class="form-control" id="5" aria-describedby="emailHelp" value="<?php echo $row2['correo_user']; ?>" name="cor" required>
		  			</div>		  			<?php endif; ?>
		 			<div class="form-group">
		   			 <label for="exampleInputPassword">Contraseña Actual</label>
		   			 <input type="password" minlength="6" class="form-control" id="exampleInputPassword"class="form-control" id="exampleInputPassword1" name="pass1" placeholder="Ingrese, para modificar" required>
		 			</div>
		  				<button type="submit" name="btn1" class="btn btn-outline-primary btn-block">Guardar</button>
			 	  </form>

			<?php 
				if (isset($_POST['btn1'])) {
					$id=$_POST['id'];
					$nombre=ucwords($_POST['nom']);
					$apellido=ucwords($_POST['apell']);
					$telefono=$_POST['tel'];
					$correo=$_POST['cor'];
					/* verify password */
					$pass_act=$_POST['pass1'];
					$sql=mysqli_query($mysqli,"SELECT * FROM user WHERE id_user='$sesion'");
					if($row=mysqli_fetch_array($sql)){
						if (password_verify($pass_act,$row['contra_user'])) {
							$update = mysqli_query($mysqli, "UPDATE user SET id_user='$id', nom_user='$nombre', apell_user='$apellido', tel_user='$telefono', correo_user='$correo' WHERE id_user='$sesion'") or die(mysqli_error());
							if ($update) {
								$_SESSION['nom_user']=$nombre;
								echo "<script>alert('Se realizaron los cambios con exito, recarga la pagina para guardar cambios.');location='index.php';</script>";
							}
							else{
								echo "<script>alert('Error al modificar los datos.');location='index.php';</script>";
							}
						}
						else{
							echo "<script>alert('La contraseña no coincide con la ya ingresada.');location='index.php';</script>";
						}
					}
					else{
						echo "<script>alert('Error al conectar a la base de datos.');location='index.php';</script>";
					}
				}
				 ?>
						<form action="" style="margin-top: 50px" method="POST" onload="document.inicio.reset();">
						  <h4>Actualizar Contraseña</h4>
		 					<div class="form-group">
		   					 <label for="exampleInputPassword1">Contraseña Actual</label>
		   					 <input type="password" minlength="6" class="form-control" id="exampleInputPassword1" placeholder="Ingrese, para modificar" name="pass2" required>
		 					</div>
							<div class="form-group">
		   					 <label for="exampleInputPassword2">Contraseña Nueva</label>
		   					 <input type="password" minlength="6" class="form-control" id="exampleInputPassword2" name="pass3" required>
		 					</div>
							<div class="form-group">
		   					 <label for="exampleInputPassword3">Confirmar Contraseña</label>
		   					 <input type="password" minlength="6" class="form-control" id="exampleInputPassword3" name="pass4" required>
		 					</div>
		  						<button type="submit" name="btn2" class="btn btn-outline-primary btn-block">Guardar</button>
						</form>
					<?php 
						if (isset($_POST['btn2'])) {
							$pass1=$_POST['pass2'];
							$pass2=$_POST['pass3'];
							$pass3=$_POST['pass4'];
							/* verify password */
							$sql=mysqli_query($mysqli,"SELECT * FROM user WHERE id_user='$sesion'");
							if($row=mysqli_fetch_array($sql)){
								if (password_verify($pass1,$row['contra_user'])) {
									if ($pass2==$pass3) {
										$opciones = ['cost' => 12,];
										$seguridad=password_hash($pass3, PASSWORD_DEFAULT, $opciones);
										$update = mysqli_query($mysqli, "UPDATE user SET contra_user='$seguridad' WHERE id_user='$sesion'") or die(mysqli_error());
										if ($update) {
											echo "<script>alert('Se cambio la contraseña con exito.');location='index.php';</script>";
										}
										else{
											echo "<script>alert('Error al modificar la contraseña.');location='index.php';</script>";
										}
									}
									else{
										echo "<script>alert('Las dos contraseñas no coinciden.');location='index.php';</script>";
									}
								}
								else{
									echo "<script>alert('La contraseña no coincide con la ya ingresada.');location='index.php';</script>";
								}
							}
							else{
								echo "<script>alert('Error al conectar a la base de datos.');location='index.php';</script>";
							}
						}
					 ?></div></div><br><br>
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