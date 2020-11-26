<style type="text/css">
<!--
table { vertical-align: top; }
tr    { vertical-align: top; }
td    { vertical-align: top; }
table.page_footer {width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;}
}
-->
</style>
<page backtop="15mm" backbottom="15mm" backleft="15mm" backright="15mm" style="font-size: 12pt; font-family: arial" >
        <page_footer>
        <table class="page_footer">
            <tr>

                <td style="width: 50%; text-align: left">
                    P&aacute;gina [[page_cu]]/[[page_nb]]
                </td>
                <td style="width: 50%; text-align: right">
                    &copy; <?php echo "obedalvarado.pw "; echo  $anio=date('Y'); ?>
                </td>
            </tr>
        </table>
    </page_footer>
    <table cellspacing="0" style="width: 100%;">
        <tr>

            <td style="width: 20%; color: #444444;">
                <img style="width: 100%;" src="../../img/logo.jpg" alt="Logo"><br>
                
            </td>
			<td style="width: 75%;text-align:right">
			COTIZACION Nº <?php echo $numero_cotizacion;?>
			</td>
			
        </tr>
    </table>
    <br>
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;">
		<tr>
		<td style="width:50%; "><strong>Ubicacion:</strong> <br>Rivera(Huila).<br>Tel: (+57)301 7873859.</td>
		
		</tr>
	</table>
	
	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
		<tr>
			<td style="width: 100%;text-align:right">
			Fecha: <?php date_default_timezone_set("UTC"); echo date("d-m-Y");?>
			</td>
		</tr>
	</table>
	
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        <tr><td><h2>Datos del usuario</h2></td></tr>
        <tr>
           
            <td style="width:40%;float: left;"> Identificacion:</td>
            <td style="width:50%; float: right;"><?php echo $id_user; ?> </td>
        </tr>
        <tr>
			<td style="width:40%;float: left;">  Email:</td>
			<td style="width:50%; float: right;"><?php echo $correo_user; ?> </td>
        </tr>
        <tr>
            
            <td style="width:40%;float: left;"> Nombre:</td>
            <td style="width:50%; float: right;"><?php echo $nom_user; ?></td>
        </tr>
        <tr>
			<td style="width:40%;float: left;">  Teléfono:</td>
			<td style="width:50%; float: right;"><?php echo $tel_user; ?> </td>
        </tr>
    </table>
        <br><br>
    <table border="1" cellspacing="0" style="width: 100%; border: solid 1px black;  text-align: center; font-size: 11pt;padding:1mm;">
        <tr>
            <th>Cantidad</th>
            <th>Nombre Producto/Categoria</th>
            <th>Precio Unit.</th>
            <th>Precio Total</th>
        </tr>
<?php
$sumador_total=0;
$sql=mysqli_query($con, "select * from articulos, tmp_cotizacion where articulos.id_articulo=tmp_cotizacion.id_articulo and tmp_cotizacion.session_id='".$session_id."'");
while ($row=mysqli_fetch_assoc($sql))
	{
	$id_tmp=$row["id_tmp"];
	$id_producto=$row["id_articulo"];
	$codigo_producto=$row['cod_articulo'];
	$cantidad=$row['cantidad_tmp'];
	$nombre_producto=$row['nombre'];
	$id_marca_producto=$row['id_categoria'];
	if (!empty($id_marca_producto))
	{
	$sql_marca=mysqli_query($con,"select nom_categoria from categoria where id_categoria='$id_marca_producto'");
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
            <td style="width: 10%; text-align: center"><?php echo $cantidad; ?></td>
            <td style="width: 60%; text-align: left"><?php echo $nombre_producto.$marca_producto;?></td>
            <td style="width: 15%; text-align: right"><?php echo $precio_venta_f;?></td>
            <td style="width: 15%; text-align: right"><?php echo $precio_total_f;?></td>
            
        </tr>
	<?php 
	//Insert en la tabla detalle_cotizacion
	$insert_detail=mysqli_query($con, "INSERT INTO detalle_cotizacion_demo VALUES ('','$numero_cotizacion','$id_producto','$cantidad','$precio_venta_r')");
	}

?>
    </table>
    <table cellspacing="0" style="width: 100%; border: solid 1px black; background: #E7E7E7; text-align: center; font-size: 11pt;padding:1mm;">
        <tr>
            <th style="width: 87%; text-align: right;">TOTAL : </th>
            <th style="width: 13%; text-align: right;">&#36; <?php echo number_format($sumador_total,2);?></th>
        </tr>
    </table>
	*** Precios incluyen IVA ***
	
	<br>
          <table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
            <tr>
                <td style="width:50%;text-align:right">Tipo de evento: </td>
                <td style="width:50%; ">&nbsp;<?php echo $condiciones; ?></td>
            </tr>
			<tr>
                <td style="width:50%;text-align:right">Fecha acordada del evento: </td>
                <td style="width:50%; ">&nbsp;<?php echo $entrega; ?></td>
            </tr>
        </table>
    <br><br><br><br>
	
	
	  <table cellspacing="10" style="width: 100%; text-align: left; font-size: 11pt;">
			 <tr>
                <td style="width:33%;text-align: center;border-top:solid 1px">Vendedor</td>
               <td style="width:33%;text-align: center;border-top:solid 1px">Cotizado</td>
               <td style="width:33%;text-align: center;border-top:solid 1px">Aceptado Cliente</td>
            </tr>
        </table>

</page>

<?php
date_default_timezone_set("UTC");
$date=date("Y-m-d H:i:s");
$insert=mysqli_query($con,"INSERT INTO cotizaciones_demo VALUES ('','$numero_cotizacion','$date','$id_user','$correo_user','$nom_user','$tel_user','$condiciones','$entrega')");
$delete=mysqli_query($con,"DELETE FROM tmp_cotizacion WHERE session_id='".$session_id."'");
?>