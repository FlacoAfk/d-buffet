<?php
include("../../../../php/seguridad.php");
include("../../../../php/conexion.php");
$sesion= $_SESSION['correo_user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Buscador</title>
	<!-- Bootstrap -->
	<link href="../bootstrap/bootstrap2/css/bootstrap.min.css" rel="stylesheet">
	<link href="../bootstrap/bootstrap2/css/style_nav.css" rel="stylesheet">
	<link href="../bootstrap/bootstrap2/icomoon/style.css" rel="stylesheet">
</head>
<body>
	<form action="buscador.php" method="POST">
	<div class="input-group mb-2">
				<input class="form-control" type="text" aria-describedby="button-addon2" name="palabra" placeholder="Ingrese su busqueda" value="<?php  if (isset($_POST["palabra"])) {echo ($_POST["palabra"]);} ?>">
		<div class="input-group-append">
				<input class="btn btn-outline-secondary" id="button-addon2" type="submit" name="buscador" value="Buscar">
		</div>
	</div>
	</form>


<?php 
if (isset($_POST['buscador']))
{

$buscar = $_POST['palabra'];

if (empty($buscar) || $buscar=="'" || $buscar=="''" || $buscar==NULL)
{
echo "No se ha ingresado ninguna palabra";
}
else{

$result = mysqli_query($mysqli, "SELECT * FROM user INNER JOIN tipo_user on user.Cod_clase_user=tipo_user.Cod_clase_user WHERE correo_user!='$sesion' and correo_user!='julianmed45@gmail.com' and correo_user!='paulahoyos@gmail.com' and nom_user LIKE '%$buscar%' or correo_user!='$sesion' and correo_user!='julianmed45@gmail.com' and correo_user!='paulahoyos@gmail.com' and  correo_user LIKE '%$buscar%' or correo_user!='$sesion' and correo_user!='julianmed45@gmail.com' and correo_user!='paulahoyos@gmail.com' and  id_user LIKE '%$buscar%' or correo_user!='$sesion' and correo_user!='julianmed45@gmail.com' and correo_user!='paulahoyos@gmail.com' and  tel_user LIKE '%$buscar%' or correo_user!='$sesion' and correo_user!='julianmed45@gmail.com' and correo_user!='paulahoyos@gmail.com' and apell_user LIKE '%$buscar%'");

if ($total = mysqli_num_rows($result)) {

if ($row = mysqli_fetch_array($result)) {

echo "Resultados para:  $buscar";
echo "<br>";
echo "Total de resultados:  $total";
?>

<br>
<div class="table-responsive">
<table class="table table-striped table-hover">
	<tr>
		<th>N° Identidad</th>
		<th>Nombre</th>
		<th>Teléfono</th>
		<th>Correo</th>
		<th>Tipo de Usuario</th>
		<th>Acciones</th>
	</tr>
<?php
do {
echo '
<br>
<tr>
	<td>'.$row['id_user'].'</td>
	<td><span class="glyphicon glyphicon-user" aria-hidden="true"></span> '.$row['nom_user'].' '.$row['apell_user'].'</td>
     <td>'.$row['tel_user'].'</td>
     <td>'.$row['correo_user'].'</td>
	<td>';
	if($row['Cod_clase_user'] == '1'){
	echo '<span class="label label-success">Admin</span>';
							}
    else if ($row['Cod_clase_user'] == '2' ){
	echo '<span class="label label-info">Cliente</span>';
	}
	echo '<td>

		<a href="../crud/edit.php?nik='.$row['id_user'].'" title="Editar datos" class="btn btn-primary btn-sm">Modificar</a>
		<a href="../crud/index.php?aksi=delete&nik='.$row['id_user'].'" title="Eliminar" onclick="return confirm(\'Esta seguro de borrar los datos '.$row['nom_user'].'?\')" class="btn btn-danger btn-sm">Eliminar</a>
							</td>
		</tr>';
	?>

<?php
}
while ($row = mysqli_fetch_array($result));
}
else{
echo "No se encontraron resultados para: $buscar";
}
}
}
}
?>

</table>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="../bootstrap/bootstrap2/jquery/jquery.js"></script>
<script src="../bootstrap/bootstrap2/js/bootstrap.min.js"></script>
<script src="../bootstrap/bootstrap2/js/bootstrap.js"></script>
<script src="../bootstrap/bootstrap2/js/bootstrap.min.js"></script>
</body>
</html>