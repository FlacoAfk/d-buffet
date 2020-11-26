<?php
	include("../../../php/seguridad2.php");
	$id=$_SESSION['id_user'];
	$corr=$_SESSION['correo_user'];
	$nom=$_SESSION['nom_user'];
	$apel=$_SESSION['apell_user'];
	$tel=$_SESSION['tel_user'];
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Cotizador de Productos Online</title>
    <!-- arch -->
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../bootstrap/css/bootstrap-theme.min.css">
  </head>
  <body>
    <div class="container">
		  <div class="row-fluid">
			<div class="col-md-12">
			<h2><span class="glyphicon glyphicon-edit"></span> Crea tu Cotización</h2>
			<hr>
			<form class="form-horizontal" role="form" id="datos_cotizacion">
						<div class="form-group row" style="display: none;">
							<div class="col-md-3">
								<input type="number" class="form-control" id="id" value="<?php echo $id; ?>" placeholder="id" readonly="readonly">
							</div>
							<div class="col-md-3">
								<input type="email" class="form-control" id="email" value="<?php echo $corr; ?>" placeholder="email" readonly="readonly">
							</div>
							<div class="col-md-3">
								<input type="text" class="form-control" id="nom" value="<?php echo $nom." ".$apel; ?>" placeholder="nom" readonly="readonly">
							</div>
							<div class="col-md-3">
								<input type="number" class="form-control" id="tel" value="<?php echo $tel; ?>" placeholder="tel" readonly="readonly">
							</div>
						</div>
				
				
				<div class="col-md-12">
					<div class="pull-right">
						<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">
						 <span class="glyphicon glyphicon-plus"></span> Agregar productos
						</button>
					<?php if (empty($_GET['condiciones']) and empty($_GET['entrega'])):
					 ?>
						<button type="submit" class="btn btn-default">
						  <span class="glyphicon glyphicon-print"></span> Imprimir
						</button>
					<?php endif;
					?>
					</div>	
				</div>
			</form>
			<br><br>
		<div id="resultados" class='col-md-12'></div><!-- Carga los datos ajax -->
	
			<!-- Modal -->
			<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Buscar productos</h4>
				  </div>
				  <div class="modal-body">
					<form class="form-horizontal">
					  <div class="form-group">
						<div class="col-sm-6">
						  <input type="text" class="form-control" id="q" placeholder="Buscar productos" onkeyup="load(1)">
						</div>
						<button type="button" class="btn btn-default" onclick="load(1)"><span class='glyphicon glyphicon-search'></span> Buscar</button>
					  </div>
					</form>
					<div id="loader" style="position: absolute;	text-align: center;	top: 55px;	width: 100%;display:none;"></div><!-- Carga gif animado -->
					<div class="outer_div" ></div><!-- Datos ajax Final -->
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					
				  </div>
				</div>
			  </div>
			</div>
			
			</div>	
		 </div>
	</div>
	
	<!-- arch -->
	<script src="../bootstrap/jquery/jquery.min.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script>
	<script src="../bootstrap/jquery/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
	<script>
		$(document).ready(function(){
			load(1);
		});

		function load(page){
			var q= $("#q").val();
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'./ajax/productos_cotizacion.php?action=ajax&page='+page+'&q='+q,
				 beforeSend: function(objeto){
				 $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
			  },
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$('#loader').html('');
					
				}
			})
		}
	</script>
	<script>
	function agregar (id)
		{
			var precio_venta=document.getElementById('precio_venta_'+id).value;
			var cantidad=document.getElementById('cantidad_'+id).value;
			//Inicia validacion
			if (isNaN(cantidad))
			{
			alert('Esto no es un numero');
			document.getElementById('cantidad_'+id).focus();
			return false;
			}
			if (isNaN(precio_venta))
			{
			alert('Esto no es un numero');
			document.getElementById('precio_venta_'+id).focus();
			return false;
			}
			//Fin validacion
			
			$.ajax({
        type: "POST",
        url: "./ajax/agregar_cotizador.php",
        data: "id="+id+"&precio_venta="+precio_venta+"&cantidad="+cantidad,
		 beforeSend: function(objeto){
			$("#resultados").html("Mensaje: Cargando...");
		  },
        success: function(datos){
		$("#resultados").html(datos);
		}
			});
		}
		
			function eliminar (id)
		{
			
			$.ajax({
        type: "GET",
        url: "./ajax/agregar_cotizador.php",
        data: "id="+id,
		 beforeSend: function(objeto){
			$("#resultados").html("Mensaje: Cargando...");
		  },
        success: function(datos){
		$("#resultados").html(datos);
		}
			});

		}
		
		$("#datos_cotizacion").submit(function(){
		  var id_user = $("#id").val();
		  var correo_user = $("#email").val();
		  var nom_user = $("#nom").val();
		  var tel_user = $("#tel").val();
		  var condiciones = $("#condiciones").val();
		  var entrega = $("#entrega").val();
		 VentanaCentrada('./pdf/documentos/cotizacion_pdf.php?id_user='+id_user+'&correo_user='+correo_user+'&nom_user='+nom_user+'&tel_user='+tel_user+'&condiciones='+condiciones+'&entrega='+entrega,'Cotizacion','','1024','768','true');
	 	});
	</script>
  </body>
</html>