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
	<title>Cotizaciones</title>

	<!-- Bootstrap -->
	<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="../bootstrap/css/style_nav.css" rel="stylesheet">

</head>
<body>
			<h2>Cotizaciones</h2>
			<hr />

			<?php
			if(isset($_GET['aksi']) == 'delete'){
				// escaping, additionally removing everything that could be (html/javascript-) code
				$nik = mysqli_real_escape_string($mysqli,(strip_tags($_GET["nik"],ENT_QUOTES)));
				$cek = mysqli_query($mysqli, "SELECT * FROM cotizaciones_demo WHERE numero_cotizacion='$nik'");
				if(mysqli_num_rows($cek) == 0){
					echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> No se encontraron datos.</div>';
				}else{
					$delete = mysqli_query($mysqli, "DELETE FROM cotizaciones_demo WHERE numero_cotizacion='$nik'");
					if ($delete) {
					$delete2= mysqli_query($mysqli, "DELETE FROM detalle_cotizacion_demo WHERE numero_cotizacion='$nik'");
					}
					if($delete2){
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
			<br />
			<div class="table-responsive">
			<table class="table table-striped table-hover">
				<tr>
                    <th>No</th>
					<th>N° de cotizacion</th>
					<th>Fecha de cotizacion</th>
					<th>Cliente</th>
					<th>Tipo de evento</th>
					<th>Fecha acordada para el evento</th>
					<th>Detalles</th>
					<th>Acciones</th>
				</tr>
				<?php
					$sql = mysqli_query($mysqli, "SELECT * FROM cotizaciones_demo ORDER BY id_cotizacion ASC");
				if(mysqli_num_rows($sql) == 0){
					echo '<tr><td colspan="8">No hay datos.</td></tr>';
				}else{
					$no = 1;
					while($row = mysqli_fetch_assoc($sql)){
						echo '
						<tr>
							<td>'.$no.'</td>
							<td>'.$row['numero_cotizacion'].'</td>
							<td>'.$row['fecha_cotizacion'].'</td>
							<td><a href="../../usuarios/crud/profile.php?nik='.$row['id_user'].'"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> '.$row['nom_user'].'</a></td>
                            <td>'.$row['condiciones_pago'].'</td>
                            <td>'.$row['tiempo_entrega'].'</td>
                            <td><a href="profile.php?p='.$row['numero_cotizacion'].'">Aqui <span class="glyphicon glyphicon-chevron-down"></span></a></td>
							<td>
								<a href="index.php?aksi=delete&nik='.$row['numero_cotizacion'].'" title="Eliminar" onclick="return confirm(\'Esta seguro de borrar los datos de la cotizacion '.$row['numero_cotizacion'].'?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
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
