<?php
session_start();
$session_id= session_id();
if (isset($_POST['id'])){$id=$_POST['id'];}
if (isset($_POST['cantidad'])){$cantidad=$_POST['cantidad'];}
if (isset($_POST['precio_venta'])){$precio_venta=$_POST['precio_venta'];}

	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	
if (!empty($id) and !empty($cantidad) and !empty($precio_venta))
{
$insert_tmp=mysqli_query($con, "INSERT INTO tmp_cotizacion (id_articulo,cantidad_tmp,precio_tmp,session_id) VALUES ('$id','$cantidad','$precio_venta','$session_id')");
}
if (isset($_GET['id']))//codigo elimina un elemento del array
{
$id_new = $_GET['id'];
$delete=mysqli_query($con, "DELETE FROM tmp_cotizacion WHERE id_tmp='".$id_new."'");
}

?>
<div class="table-responsive">
<table class="table table table-striped table-hover">
<tr>
	<th>CODIGO</th>
	<th>CANT.</th>
	<th>NOMBRE</th>
	<th>DESCRIPCION</th>
	<th>IMAGENES</th>
	<th><span class="pull-right">PRECIO UNIT.</span></th>
	<th><span class="pull-right">PRECIO TOTAL</span></th>
	<th></th>
</tr>
<?php
	$sumador_total=0;
	$lo=1;
	$sql=mysqli_query($con, "select * from articulos, tmp_cotizacion where articulos.id_articulo=tmp_cotizacion.id_articulo and tmp_cotizacion.session_id='".$session_id."'");
	while ($row=mysqli_fetch_assoc($sql))
	{
	$id_tmp=$row["id_tmp"];
	$codigo_producto=$row['cod_articulo'];
	$cantidad=$row['cantidad_tmp'];
	$nombre_producto=$row['nombre'];
	$id_marca_producto=$row['id_categoria'];
	$img=$row['imagenes'];
	$des=$row['descripcion'];
	if (!empty($id_marca_producto))
	{
	$sql_marca=mysqli_query($con, "select nom_categoria from categoria where id_categoria='$id_marca_producto'");
	$rw_marca=mysqli_fetch_array($sql_marca);
	$nombre_marca=$rw_marca['nom_categoria'];
	$marca_producto=" ".strtoupper($nombre_marca);
	}
	else {$marca_producto='';}
	$precio_venta=$row['precio_tmp'];
	$precio_venta_f=number_format($precio_venta,2);//Formateo variables
	$precio_venta_r=str_replace(",","",$precio_venta_f);//Reemplazo las comas
	$precio_total=$precio_venta_r*$cantidad;
	$precio_total_f=number_format($precio_total,2);//Precio total formateado
	$precio_total_r=str_replace(",","",$precio_total_f);//Reemplazo las comas
	$sumador_total+=$precio_total_r;//Sumador
	
		?>
		<tr>
			<td><?php echo $codigo_producto;?></td>
			<td><?php echo $cantidad;?></td>
			<td><?php echo $nombre_producto.$marca_producto;?></td>
			<td>
				<button type="button" class="btn btn-info" data-toggle="modal" data-target="<?php echo "#modal_desc".$lo; ?>">
					<span class="glyphicon glyphicon-chevron-down"></span>
				</button>
			</td>
			<td>
				<button type="button" class="btn btn-info" data-toggle="modal" data-target="<?php echo "#modal_lol".$lo; ?>">
					<span class="glyphicon glyphicon-picture"></span>
				</button>
			</td>

						<!-- MODAL -->
							<div class="modal fade bs-example-modal-lg" id="<?php echo	"modal_lol".$lo; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  					<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
				 						<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="myModalLabel">Imagen</h4>
				  						</div>
				  					<div class="modal-body">
				  						<img style="width: 100%;height: auto;" src="<?php echo "../../admin/articulos/crud/".$img; ?>">
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
							<div class="modal fade bs-example-modal-lg" id="<?php echo	"modal_desc".$lo; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  					<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
				 						<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="myModalLabel">Descripcion</h4>
				  						</div>
				  					<div class="modal-body" style="-ms-word-break: break-all;word-break: break-all;word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;-ms-hyphens: auto;hyphens: auto;">
				  						<div style=" width: 90%;margin: 1em auto;padding: 1em 5%;background: #fff;text-align: justify;"><?php echo $des;?></div>
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
			<td><span class="pull-right"><?php echo $precio_venta_f;?></span></td>
			<td><span class="pull-right"><?php echo $precio_total_f;?></span></td>
			<td ><span class="pull-right"><a href="#" onclick="eliminar('<?php echo $id_tmp ?>')"><i class="glyphicon glyphicon-trash"></i></a></span></td>
		</tr>		
		<?php
		$lo+=1;
	}
?>
<tr>
	<td colspan=4><span class="pull-right">TOTAL $</span></td>
	<td><span class="pull-right"><?php echo number_format($sumador_total,2);?></span></td>
	<td></td>
</tr>
</table>
</div>
					<div class="form-group row">
							<label for="condiciones" class="col-md-2 control-label">Informacion Importante:</label>
							<div class="form-group row">
							<label for="condiciones" class="col-md-2 control-label">Tipo de evento:</label>
							<div class="col-md-3">
								<select class="form-control" id="condiciones" required>
									<option value="#">-- Elija una --</option>
									<option value="Matrimonios">Matrimonios</option>
									<option value="Bautizos">Bautizos</option>
									<option value="Aniversarios">Aniversarios</option>
									<option value="15 Años">15 Años</option>
									<option value="Reuniones familiares">Reuniones familiares</option>
									<option value="Primera comunion">Primera comunion</option>
									<option value="Confirmaciones">Confirmaciones</option>
								</select>
							</div>
							<label for="entrega" class="col-md-1 control-label">Fecha del evento:</label>
							<div class="col-md-2">
								<?php date_default_timezone_set("UTC"); $hoy=date("Y-m-d"); ?>
								<input type="date" class="form-control" id="entrega" required min='<?php echo $hoy;?>'>
							</div>
<script type="text/javascript">document.getElementById('#fecha').value = new Date().toDateInputValue();</script>
<script type="text/javascript">$(document).ready( function() {
    $('#fecha').val(new Date().toDateInputValue());
});​</script>

							</div>
					</div>