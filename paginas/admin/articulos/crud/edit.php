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
			<h2>Datos de los articulos &raquo; Editar datos</h2>
			<hr />
			
			<?php
			// escaping, additionally removing everything that could be (html/javascript-) code
			$nik = mysqli_real_escape_string($mysqli,(strip_tags($_GET["nik"],ENT_QUOTES)));
			$sql = mysqli_query($mysqli, "SELECT * FROM articulos WHERE cod_articulo='$nik'");
			if(mysqli_num_rows($sql) == 0){
				header("Location: index.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			if(isset($_POST['save'])){
				$id	     = mysqli_real_escape_string($mysqli,(strip_tags($_POST["id"],ENT_QUOTES)));//Escanpando caracteres 
				$nombre2	 = mysqli_real_escape_string($mysqli,(strip_tags($_POST["nom"],ENT_QUOTES)));//Escanpando caracteres 

				$nombre=ucwords($nombre2);

				$precio	 = mysqli_real_escape_string($mysqli,(strip_tags($_POST["pre"],ENT_QUOTES)));//Escanpando caracteres 
				$tipo	 = mysqli_real_escape_string($mysqli,(strip_tags($_POST["ilo"],ENT_QUOTES)));//Escanpando caracteres 
				$descripcion		 = mysqli_real_escape_string($mysqli,(strip_tags($_POST["des"],ENT_QUOTES)));//Escanpando caracteres 

		if ($_FILES['foto']['name']=="" || $_FILES['foto']['name']==null) {
		$resultado= mysqli_query($mysqli, "UPDATE articulos SET cod_articulo='$id', nombre='$nombre', precio='$precio', id_categoria='$tipo', descripcion='$descripcion' WHERE cod_articulo='$nik'");
		if ($resultado) {
		echo "<script>alert('los datos se han guardado correctamente, sin imagen');</script>";
		}
		else{
		echo "<script>alert('error');location='index.php';</script>";
		}
	}
	else{
		$re = mysqli_query($mysqli,"SELECT imagenes FROM articulos WHERE cod_articulo='$id'");

		if (file_exists($row['imagenes'])) {

		while ($f=mysqli_fetch_array($re)) {
			unlink($f['imagenes']);
		}

		}

		if($_FILES["foto"]["error"]>0){
		echo "<script>alert('Error al cargar archivo');</script>";	
		} else {
		
		$permitidos = array("image/jpg","image/png","image/jpeg");
		$limite_kb = 5120;
		
		if(in_array($_FILES["foto"]["type"], $permitidos) && $_FILES["foto"]["size"] <= $limite_kb * 1024){
			
			$ruta = 'files/';
			opendir($ruta);
			$archivo = $ruta.$_FILES["foto"]["name"];
			
			if(!file_exists($ruta)){
				mkdir($ruta);
			}
			
			if(!file_exists($archivo)){
				
				$resultado = copy($_FILES["foto"]["tmp_name"], $archivo);
				
				if($resultado){
					echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Bien hecho! El archivo ha sido guardado.</div>';					
				} else {
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. La imagen no pudo ser guardada!</div>';

					sleep(2);

					echo '<script>location="edit.php?nik='.$row['cod_articulo'].'";</script>';
				}
				
				} else {
				echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. Archivo ya exite!</div>';

				sleep(2);

				echo '<script>location="edit.php?nik='.$row['cod_articulo'].'";</script>';
			}
			
			} else {
			echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. Archivo no permitido o excede el tamaño!</div>';

			sleep(2);

			echo '<script>location="edit.php?nik='.$row['cod_articulo'].'";</script>';
		}
		
	}

	if (isset($resultado)) {

		$update=mysqli_query($mysqli, "UPDATE articulos SET cod_articulo='$id', nombre='$nombre', precio='$precio', imagenes='$archivo', id_categoria='$tipo', descripcion='$descripcion' WHERE cod_articulo='$nik'");
		echo "<script>alert('los datos se han guardado correctamente');";
	}
	else{
		echo "<script>alert('Error al cargar la imagen');";
	}
	}

				if($resultado){
					header("Location: edit.php?nik=".$nik."&pesan=sukses");
				}else{
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error, no se pudo guardar los datos.</div>';
				}
			}
			
			if(isset($_GET['pesan']) == 'sukses'){
				echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Los datos han sido guardados con éxito.</div>';
					if (isset($_GET['pesan'])) {
							sleep(2);
							echo "<script>location='index.php';</script>";
					}
			}
			?>
			<form class="form-horizontal" method="POST" enctype="multipart/form-data">
				
				<div class="form-group">
					<label class="col-sm-3 control-label">ID del articulo</label>
						<div class="col-sm-4"> 
						<input type="number" name="id" value="<?php echo $row ['cod_articulo']; ?>" class="form-control" placeholder="Ingrese el ID del articulo:" min="0" required>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Nombre del articulo</label>
						<div class="col-sm-4">
						<input type="text" name="nom" value="<?php echo $row ['nombre']; ?>" class="form-control" placeholder="Ingrese el nombre del articulo:" required>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Precio</label>
						<div class="col-sm-4">
						<input class="form-control" type="number" step="any" name="pre" value="<?php echo $row ['precio']; ?>" placeholder="Ingrese el precio del articulo:" min="0" required>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Imagenes del articulo</label>
						<div class="col-sm-4">
							<div class="custom-file">
 								<input type="file" name="foto" class="custom-file-input" id="fileName" accept=".jpg,.jpeg,.png">
  								<label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
							</div>
						</div>
					</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Nombre de la categoria</label>
					<div class="col-sm-4">
						<select name="ilo" class="custom-select" required>
							<option value="">- Selecciona la categoria -</option>

							<?php $sqli= mysqli_query($mysqli, 'SELECT * FROM categoria'); 

								$nol=$row['id_categoria'];

                            	while ($row2=mysqli_fetch_assoc($sqli)) {
                            	echo '<option value="'.$row2['id_categoria'].'"'; 
                            	if($row['id_categoria'] == $row2['id_categoria']){
                            	 echo "selected='".$row['id_categoria']."'";
                            	}
                            	  echo'>'.$row2['nom_categoria'].'</option>';
                            	}

                            	$nol++;
                            ?>
						</select> 
					</div> 
                </div>

                <div class="form-group">
     				<label class="col-sm-3 control-label">Descripcion del articulo</label>
     					<div class="col-sm-4">
     						<textarea name="des" class="form-control" placeholder="Escriba la descripcion del articulo:" required><?php echo $row ['descripcion']; ?></textarea>
     					</div>
     			</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="save" class="btn btn-sm btn-primary" value="Guardar datos">
						<a href="index.php" class="btn btn-sm btn-danger">Cancelar</a>
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
	<script src="../bootstrap/bootstrap2/js/bootstrap.min.js"></script>
	<script>
	$('.date').datepicker({
		format: 'dd-mm-yyyy',
	})
	</script>
</body>
</html>