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
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../bootstrap/css/bootstrap-theme.min.css">
</head>
<body>
	<div class="container">
		<div class="content">
			<h2>Informacion de la cotizacion</h2>
			<hr />
			
			<?php
			$nik = mysqli_real_escape_string($mysqli,(strip_tags($_GET["p"],ENT_QUOTES)));
			
			$sql = mysqli_query($mysqli, "SELECT * FROM cotizaciones_demo WHERE numero_cotizacion='$nik'");
			if(mysqli_num_rows($sql) == 0){
				header("Location: index.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			?>
			
			<table class="table table-striped table-condensed">
						<tr>
							<th>N° Cotizacion</th>
							<th>Cantidad</th>
							<th>Nombre del producto</th>
							<th>Precio</th>
							<th>Imagen</th>
						</tr>
				<?php 
					$mysql=mysqli_query($mysqli,"SELECT * FROM articulos INNER JOIN detalle_cotizacion_demo on articulos.id_articulo=detalle_cotizacion_demo.id_articulo WHERE numero_cotizacion='$nik'");
					$no=1;
					$sumador=0;
					while ($row=mysqli_fetch_assoc($mysql)):
						$precio=$row['precio_venta'];
						$precio2=$precio*$row['cantidad'];
						$img_l=$row['imagenes'];
						?>
						<tr>
							<th><?php echo $row['numero_cotizacion']; ?></th>
							<td><?php echo $row['cantidad']; ?></td>
							<td><?php echo $row['nombre']?></td>
							<td>$<?php echo number_format($precio2)?></td>
							<td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal_img<?php echo $no?>"><span class="glyphicon glyphicon-picture"></span></button></td>
							<td>
						</tr>
						<!-- MODAL -->
							<div class="modal fade bs-example-modal-lg" id="<?php echo"modal_img".$no; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  					<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
				 						<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="myModalLabel">Imagenes</h4>
				  						</div>
				  					<div class="modal-body">
				  						<img style="width: 100%;height: auto;" src="<?php echo "../../articulos/crud/".$img_l; ?>">
										<div id="loader" style="position: absolute;	text-align: center;	top: 55px;	width: 100%;display:none;"></div><!-- Carga gif animado -->
										<div class="outer_div" ></div><!-- Datos ajax Final -->
				 					</div>
				  					<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				 					</div>
									</div>
			  					</div>
							</div>
						<!---->
						<?php
						$no+=1;
						$sumador+=$precio2;
					endwhile;
				 ?>
				 		<tr>
				 			<td colspan="5"><b style="float: right;">Precio Total:  $<?php echo number_format($sumador); ?></b></td>
				 		</tr>
			</table>
			
			<a href="index.php" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Regresar</a>
		</div>
	</div>

	<script src="../bootstrap/jquery/jquery.min.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script>
	<script src="../bootstrap/jquery/jquery-3.3.1.min.js"></script>
</body>
</html>