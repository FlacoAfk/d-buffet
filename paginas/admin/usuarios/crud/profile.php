<?php
include("../../../../php/conexion.php");
include("../../../../php/seguridad.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Datos de los usuarios</title>

	<!-- Bootstrap -->
	<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="../bootstrap/css/style_nav.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<div class="content">
			<h2>Datos de los usuarios &raquo; Perfil</h2>
			<hr />
			
			<?php
			$nik = mysqli_real_escape_string($mysqli,(strip_tags($_GET["nik"],ENT_QUOTES)));
			
			$sql = mysqli_query($mysqli, "SELECT * FROM user WHERE id_user='$nik'");
			if(mysqli_num_rows($sql) == 0){
				header("Location: index.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			
			if(isset($_GET['aksi']) == 'delete'){
				$delete = mysqli_query($mysqli, "DELETE FROM user WHERE id_user='$nik'");
				if($delete){
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"">&times;</button>Se ha eliminado correctamente.</div>';
						if (!empty($delete)) {
							sleep(2);
							echo "<script>location='index.php';</script>";
						}

				}else{
					echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error, no se pudo eliminar los datos.</div>';
				}
			}
			?>
			
			<table class="table table-striped table-condensed">
				<tr>
					<th width="20%">Identidad</th>
					<td><?php echo $row['id_user']; ?></td>
				</tr>
				<tr>
					<th>Nombre</th>
					<td><?php echo $row['nom_user']; ?></td>
				</tr>
				<tr>
					<th>Apellido</th>
					<td><?php echo $row['apell_user']; ?></td>
				</tr>
				<tr>
					<th>Teléfono</th>
					<td><?php echo $row['tel_user']; ?></td>
				</tr>
				<tr>
					<th>Correo</th>
					<td><?php echo $row['correo_user']; ?></td>
				</tr>
				<tr>
					<th>Clase</th>
					<td>
						<?php 
							if ($row['Cod_clase_user']==1) {
								echo "Admin";
							} else if ($row['Cod_clase_user']==2){
								echo "Cliente";
							}
						?>
					</td>
				</tr>
				
			</table>
			
			<a href="index.php" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Regresar</a>
			<a href="edit.php?nik=<?php echo $row['id_user']; ?>" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar datos</a>
			<a href="profile.php?aksi=delete&nik=<?php echo $row['id_user']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Esta seguro de borrar los datos de <?php echo $row['nom_user']; ?>')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Eliminar</a>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="../bootstrap/jquery/jquery.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script>
	<script src="../bootstrap/js/bootstrap.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>