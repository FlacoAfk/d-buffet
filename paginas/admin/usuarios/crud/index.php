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
			<h2>Lista de usuarios</h2>
			<hr />

			<?php
			if(isset($_GET['aksi']) == 'delete'){
				// escaping, additionally removing everything that could be (html/javascript-) code
				$nik = mysqli_real_escape_string($mysqli,(strip_tags($_GET["nik"],ENT_QUOTES)));
				$cek = mysqli_query($mysqli, "SELECT * FROM user WHERE id_user='$nik'");
				if(mysqli_num_rows($cek) == 0){
					echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> No se encontraron datos.</div>';
				}else{
					$delete = mysqli_query($mysqli, "DELETE FROM user WHERE id_user='$nik'");
					if($delete){
						echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Datos eliminado correctamente.</div>';
						if (!empty($delete)) {
							sleep(2);
							echo "<script>location='index.php';</script>";
						}
					}else{
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Error, no se pudo eliminar los datos.</div>';
					}
				}
			}
			?>

			<form class="form-inline" method="get">
				<div class="form-group">
					<select name="filter" class="form-control" onchange="form.submit()">
						<option value="0">Filtro de tipo de usuario</option>
						<?php $filter = (isset($_GET['filter']) ? strtolower($_GET['filter']) : NULL);  ?>
						<option value="1" <?php if($filter == 'Admin'){ echo 'selected'; } ?>>Admin</option>
						<option value="2" <?php if($filter == 'Cliente'){ echo 'selected'; } ?>>Cliente</option>
					</select>
				</div>
			</form>
			<br />
			<div class="table-responsive">
			<table class="table table-striped table-hover">
				<tr>
                    <th>No</th>
					<th>N° Identidad</th>
					<th>Nombre</th>
					<th>Teléfono</th>
					<th>Correo</th>
					<th>Tipo de Usuario</th>
					<th>Acciones</th>
				</tr>
				<?php
				if($filter){
					$sql = mysqli_query($mysqli, "SELECT * FROM user WHERE Cod_clase_user='$filter' AND (correo_user!='$sesion')  AND (correo_user!='julianmed45@gmail.com') AND (correo_user!='paulahoyos@gmail.com') ORDER BY id_user ASC");
				}else{
					$sql = mysqli_query($mysqli, "SELECT * FROM user WHERE (correo_user!='$sesion') AND (correo_user!='julianmed45@gmail.com') AND (correo_user!='paulahoyos@gmail.com') ORDER BY id_user ASC");
				}
				if(mysqli_num_rows($sql) == 0){
					echo '<tr><td colspan="8">No hay datos.</td></tr>';
				}else{
					$no = 1;
					while($row = mysqli_fetch_assoc($sql)){
						echo '
						<tr>
							<td>'.$no.'</td>
							<td>'.$row['id_user'].'</td>
							<td><a href="profile.php?nik='.$row['id_user'].'"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> '.$row['nom_user'].' '.$row['apell_user'].'</a></td>
                            <td>'.$row['tel_user'].'</td>
                            <td>'.$row['correo_user'].'</td>
							<td>';
							if($row['Cod_clase_user'] == '1'){
								echo '<span class="label label-success">Admin</span>';
							}
                            else if ($row['Cod_clase_user'] == '2' ){
								echo '<span class="label label-info">Cliente</span>';
							}
						echo '
							</td>
							<td>

								<a href="edit.php?nik='.$row['id_user'].'" title="Editar datos" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
								<a href="index.php?aksi=delete&nik='.$row['id_user'].'" title="Eliminar" onclick="return confirm(\'Esta seguro de borrar los datos '.$row['nom_user'].'?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
							</td>
						</tr>
						';
						$no++;
					}
				}
				?>
			</table>
			</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="../bootstrap/jquery/jquery.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script>
	<script src="../bootstrap/js/bootstrap.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
