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
	<title>Crud</title>
	<!-- arch -->
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../bootstrap/css/bootstrap-theme.min.css">
	
</head>
<body>
			<h2>Lista de articulos</h2>
			<hr />

			<?php
			if(isset($_GET['aksi']) == 'delete'){
				// escaping, additionally removing everything that could be (html/javascript-) code
				$nik = mysqli_real_escape_string($mysqli,(strip_tags($_GET["nik"],ENT_QUOTES)));
				$cek = mysqli_query($mysqli, "SELECT * FROM articulos WHERE cod_articulo='$nik'");
				if(mysqli_num_rows($cek) == 0){
					echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> No se encontraron datos.</div>';
				}else{
					$insert = mysqli_query($mysqli, "SELECT imagenes FROM articulos WHERE cod_articulo='$nik'");

					$lolo=mysqli_fetch_array($insert);

					if (file_exists($lolo['imagenes']) && !empty($lolo['imagenes'])) {

					$re = mysqli_query($mysqli, "SELECT imagenes FROM articulos WHERE cod_articulo='$nik'");

					$lo=1;
					while ($imagen=mysqli_fetch_array($re)) {
					$espera = unlink($imagen['imagenes']);
					}
					$lo++;

					}


					$delete = mysqli_query($mysqli, "DELETE FROM articulos WHERE cod_articulo='$nik'");

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
						<option value="0">-- Filtro según su categoria --</option>
						<?php $filter = (isset($_GET['filter']) ? strtolower($_GET['filter']) : NULL);  
						$sqli= mysqli_query($mysqli,"SELECT * FROM categoria");
						$no=1;
						while ($resul=mysqli_fetch_assoc($sqli)):
						?>
						<option value="<?php echo $resul['id_categoria'] ?>" <?php if($filter == $resul['id_categoria']){ echo 'selected'; } ?>><?php echo $resul['nom_categoria']; ?></option>
					<?php endwhile;
						$no++;
					 ?>
					</select>
				</div>
			</form>
			<br />
			<div class="table-responsive">
			<table class="table table-striped table-hover">
				<tr class="center">
                    <th>No</th>
					<th>Cod. Articulo</th>
					<th>Nombre</th>
					<th>Precio</th>
					<th>Descripcion</th>
					<th>Categoria</th>
					<th>Producto</th>
					<th>Acciones</th>
				</tr>
				<?php
				if($filter){
					$sql = mysqli_query($mysqli, "SELECT * FROM articulos WHERE id_categoria='$filter' ORDER BY cod_articulo ASC");
				}else{
					$sql = mysqli_query($mysqli, "SELECT * FROM articulos ORDER BY cod_articulo ASC");
				}
				if(mysqli_num_rows($sql) == 0){
					echo '<tr><td colspan="8">No hay datos.</td></tr>';
				}else{
					$no = 1;
					while($row = mysqli_fetch_assoc($sql)){
					$precio=number_format($row['precio'], 0, "," , "." );
					$des=$row['descripcion'];
					$img_l=$row['imagenes'];

						echo '
						<tr>
							<td>'.$no.'</td>
							<td>'.$row['cod_articulo'].'</td>
							<td style="color: blue;">
							'.$row['nombre'].'</td>
							'; 
							?>

						<!-- MODAL -->
							<div class="modal fade bs-example-modal-lg" id="<?php echo"modal_des".$no; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  					<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
				 						<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="myModalLabel">Descripcion</h4>
				  						</div>
				  					<div class="modal-body" style="-ms-word-break: break-all;word-break: break-all;word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;-ms-hyphens: auto;hyphens: auto;">
				  						<div style=" width: 90%;margin: 1em auto;padding: 1em 5%;text-align: justify;"><?php echo $des;?></div>
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
						<!-- MODAL -->
							<div class="modal fade bs-example-modal-lg" id="<?php echo"modal_img".$no; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  					<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
				 						<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="myModalLabel">Imagenes</h4>
				  						</div>
				  					<div class="modal-body">
				  						<img style="width: 100%;height: auto;" src="<?php echo $img_l; ?>">
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
							echo'
                            <td>$ '.$precio.'</td>
                            <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal_des'.$no.'"><span class="glyphicon glyphicon-chevron-down"></span></button></td>
							<td>';

							if(isset($row['id_categoria'])){
								$id_marca_producto=$row['id_categoria'];
								$sql_marca=mysqli_query($mysqli, "select nom_categoria from categoria where id_categoria='$id_marca_producto'");
								$rw_marca=mysqli_fetch_array($sql_marca);
							$nombre_marca=$rw_marca['nom_categoria'];
							$marca_producto=" ".strtoupper($nombre_marca);
							}
							else {$marca_producto='';}
						
							echo '<span class="label label-success">'.$marca_producto.'</span>';

						echo '
							</td>
							<td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal_img'.$no.'"><span class="glyphicon glyphicon-picture"></span></button></td>
							</td>

							<td>

								<a href="edit.php?nik='.$row['cod_articulo'].'" title="Editar datos" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
								<a href="index.php?aksi=delete&nik='.$row['cod_articulo'].'" title="Eliminar" onclick="return confirm(\'Esta seguro de borrar los datos '.$row['nombre'].'?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
							</td>
						</tr>
						';
						$no++;
					}
				}
				?>
			</table>
			</div>
	<!-- arch -->
	<script src="../bootstrap/jquery/jquery.min.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script>
	<script src="../bootstrap/jquery/jquery-3.3.1.min.js"></script>
	
</body>
</html>
