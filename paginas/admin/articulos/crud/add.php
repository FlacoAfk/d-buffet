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
	<title>Crud</title>

	<!-- Bootstrap -->
	<link href="../bootstrap/bootstrap2/css/bootstrap.min.css" rel="stylesheet">
	<link href="../bootstrap/bootstrap2/css/bootstrap-datepicker.css" rel="stylesheet">
	<link href="../bootstrap/bootstrap2/css/style_nav.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<div class="content">
			<h2>Datos de los productos &raquo; Agregar datos</h2>
			<hr />

			<?php
			if(isset($_POST['add'])){
				$id	     = mysqli_real_escape_string($mysqli,(strip_tags($_POST["id"],ENT_QUOTES)));//Escanpando caracteres 
				$nombre2	 = mysqli_real_escape_string($mysqli,(strip_tags($_POST["nom"],ENT_QUOTES)));//Escanpando caracteres 

				$nombre=ucwords($nombre2);

				$precio	 = mysqli_real_escape_string($mysqli,(strip_tags($_POST["pre"],ENT_QUOTES)));//Escanpando caracteres 
				$img	     = mysqli_real_escape_string($mysqli,(strip_tags($_POST["img"],ENT_QUOTES)));//Escanpando caracteres 
				$tipo	 = mysqli_real_escape_string($mysqli,(strip_tags($_POST["ilo"],ENT_QUOTES)));//Escanpando caracteres 
				$descripcion		 = mysqli_real_escape_string($mysqli,(strip_tags($_POST["des"],ENT_QUOTES)));//Escanpando caracteres 


	if($_FILES["img"]["error"]>0){
		echo "<script>alert('Error al cargar archivo');</script>";	
		} else {
		
		$permitidos = array("image/jpg","image/png","image/jpeg");
		$limite_kb = 5120;
		
		if(in_array($_FILES["img"]["type"], $permitidos) && $_FILES["img"]["size"] <= $limite_kb * 1024){
			
			$ruta = 'files/';
			opendir($ruta);
			$archivo = $ruta.$_FILES["img"]["name"];
			
			if(!file_exists($ruta)){
				mkdir($ruta);
			}
			
			if(!file_exists($archivo)){
				
				$resultado = copy($_FILES["img"]["tmp_name"], $archivo);
				
				if($resultado){
					echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Bien hecho! El archivo ha sido guardado.</div>';					
				} else {
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. La imagen no pudo ser guardada!</div>';
				}
				
				} else {
				echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. Archivo ya exite!</div>';
			}
			
			} else {
			echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. Archivo no permitido o excede el tamaño!</div>';
		}
		
	}

		if (isset($_POST["add"]) and isset($resultado)) {

				$cek = mysqli_query($mysqli, "SELECT * FROM articulos WHERE cod_articulo='$id'");
				if(mysqli_num_rows($cek) == 0){
						$insert = mysqli_query($mysqli, "INSERT INTO articulos(cod_articulo, nombre, precio, imagenes, id_categoria, descripcion) VALUES('$id','$nombre', '$precio', '$archivo', '$tipo', '$descripcion')") or die(mysqli_error());
						if($insert){
							echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Bien hecho! Los datos han sido guardados con éxito.</div> <script>location="add.php";</script>';
						}else{
							echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. No se pudo guardar los datos !</div>';
						}
					 
				}else{
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. código exite!</div>';
				}
			}
		else{
			echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. no se pudo enviar la información!</div>';
		}
	}
			?>

						<form class="form-horizontal" method="POST" name="pagina" enctype="multipart/form-data">

						<div class="form-group">
							<label class="col-sm-3 control-label">ID del articulo</label>
							<div class="col-sm-4"> 
								<input class="form-control" type="number" name="id" placeholder="Ingrese el ID del articulo:" min="0" required>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Nombre del articulo</label>
							<div class="col-sm-4">
								<input class="form-control" type="text" name="nom" placeholder="Ingrese el nombre del articulo:" required>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Precio</label>
							<div class="col-sm-4">
								<input class="form-control" type="number" step="any" name="pre" placeholder="Ingrese el precio del articulo:" min="0" required>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Imagenes del articulo</label>
							<div class="col-sm-4">
								<div class="custom-file">
 									<input type="file" name="img" class="custom-file-input" id="fileName" accept=".jpg,.jpeg,.png" lang="es" required>
  									<label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-3 control-label">Nombre de la categoria</label>
							<div class="col-sm-4">
								<select class="custom-select" name="ilo" required>
									<option value="">Seleccione la categoria:</option>
        					<?php
        						$query = mysqli_query($mysqli,"SELECT * FROM categoria");

								$i=0;			
								
        						while ($valores = mysqli_fetch_array($query)) {
        						$i++;
												
        						echo '<option value="'.$valores[id_categoria].'">'.$i. '. ' .$valores[nom_categoria].'</option>';
													
          						}
        					?>
     							</select>
     						</div>
     					</div>

     					<div class="form-group">
     						<label class="col-sm-3 control-label">Descripcion del articulo</label>
     						<div class="col-sm-4">
     							<textarea name="des" class="form-control" placeholder="Escriba la descripcion del articulo:" required></textarea>
     						</div>
     					</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">&nbsp;</label>
								<div class="col-sm-6">
									<input type="submit" name="add" class="btn btn-sm btn-primary" value="Guardar datos">
									<a href="add.php" class="btn btn-sm btn-danger">Cancelar</a>
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
	<script>
	$('.date').datepicker({
		format: 'dd-mm-yyyy',
	})
	</script>
</body>
</html>
