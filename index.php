<?php 
	session_start();
	header('Content-Type: text/html; charset=UTF-8'); 
	if (!empty($_SESSION['Cod_clase_user']) && !empty($_SESSION['correo_user'])) {
	$cod = $_SESSION['Cod_clase_user'];
	$sesion = $_SESSION['correo_user'];
	$nombre=  $_SESSION['nom_user'];
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php 

	/* Head de admin */

	if (!empty($cod) && !empty($sesion) && $_SESSION['Cod_clase_user']=="1") {
		echo "Bienvenido(a) ".$nombre." Administrador";
	} 

	/* Head de cliente */

	elseif (!empty($cod) && !empty($sesion) && $_SESSION['Cod_clase_user']=="2") {
		echo "Bienvenido(a) ".$nombre."";
	}

	else{
		echo "Buffet Casa De Eventos";
	}
	?></title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta charset="UTF-8">
	<link rel="icon" type="image/png" href="img/ico2.png" />
	<!-- Css li -->
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="icomoon/style.css">
	<!-- Css modal ingresa -->
	<!-- Css modal registrar -->
</head>
<body>
	<header>
		<div class="menu_bar">
			<a href="#" class="bt-menu"><span class="icon-list2"></span>Buffet</a>
		</div>
 
		<nav class="nav">

	<!-- Sesion admin -->

		<?php if (!empty($_SESSION['correo_user']) && $_SESSION['Cod_clase_user']=="1"):?>

			<ul class="menu2">
				<li class="submenu" id="user">
					<a class="letra" href='#'><?php echo "Bienvenido(a) ".$nombre." <i class='little'>admin <span class='icon-user-tie'></span></i>"?></a>
					<ul class="children">
						<li class="ingre"><a href="php/cerrar.php"><span class="icon-switch"></span>Cerrar sesion </a></li>	
					</ul>
				</li>
			</ul>

		<?php endif; ?>

		<!-- Sesion cliente -->

		<?php if (!empty($_SESSION['correo_user']) && $_SESSION['Cod_clase_user']=="2"):?>

			<ul class="menu2">
				<li class="submenu" id="user">
					<a href='#'><?php echo "Bienvenido(a) ".$nombre;?></a>
					<ul class="children">
						<li class="ingre"><a href="paginas/clientes/edit/index.php" target="frame"><span class="icon-cog"></span>Configuracion </a></li>
						<li class="ingre"><a href="php/cerrar.php"><span class="icon-switch"></span>Cerrar sesion </a></li>	
					</ul>
				</li>
			</ul>

		<?php endif; ?>

			<ul>

	<!-- Inicio y nombre de la pagina -->

				<li class="text1"><a href="paginas/inicio/index.php" target="frame" class="text">Buffet</a></li>
				<li class="ingre"><a href="paginas/inicio/index.php" target="frame"><span class="icon-home"></span>Inicio</a></li>

	<!-- Crud administrador -->

		<?php if (!empty($_SESSION['correo_user']) && $_SESSION['Cod_clase_user']=="1"):?>

				<li class="submenu">
					<a href="#"><span class="icon-user"></span>Usuarios<span class="caret icon-arrow-down6"></span></a>
					<ul class="children">
						<li class="ingre"><a href="paginas/admin/usuarios/crud/add.php" target="frame">Ingresar <span class="icon-dot"></span></a></li>
						<li class="ingre"><a href="paginas/admin/usuarios/crud/index.php" target="frame">Consultar <span class="icon-dot"></span></a></li>
						<li class="ingre"><a href="paginas/admin/usuarios/buscar/buscador.php" target="frame">Buscar <span class="icon-dot"></span></a></li>
					</ul>
				</li>
				<li class="submenu">
					<a href="#"><span class="icon-rocket"></span>Articulos<span class="caret icon-arrow-down6"></span></a>
					<ul class="children">
						<li class="ingre"><a href="paginas/admin/articulos/crud/add.php" target="frame">Insertar <span class="icon-dot"></span></a></li>
						<li class="ingre"><a href="paginas/admin/articulos/crud/index.php" target="frame">Consultar <span class="icon-dot"></span></a></li>
					</ul>
				</li>
				<li class="ingre"><a href="paginas/admin/cotizacion/crud/index.php" target="frame"><span class="icon-file-text2"></span>Cotizaciones</a></li>

		<?php endif; ?>

		<!-- Productos y eventos -->

		<?php if (!isset($_SESSION['correo_user']) || $_SESSION['Cod_clase_user']=="2" && !empty($_SESSION['correo_user'])):?>

				<li class="submenu">
					<a href="#"><span class="icon-rocket"></span>Eventos<span class="caret icon-arrow-down6"></span></a>
					<ul class="children">
						<li class="ingre"><a href="paginas/clientes/eventos/matrimonios/index.php" target="frame">Matrimonios <span class="icon-dot"></span></a></li>
						<li class="ingre"><a href="paginas/clientes/eventos/aniversarios/index.php" target="frame">Aniversarios <span class="icon-dot"></span></a></li>
						<li class="ingre"><a href="paginas/clientes/eventos/15 anos/index.php" target="frame">15 Años <span class="icon-dot"></span></a></li>
						<li class="ingre"><a href="paginas/clientes/eventos/reuniones familiares/index.php" target="frame">Reuniones familiares <span class="icon-dot"></span></a></li>
						<li class="ingre"><a href="paginas/clientes/eventos/bautizos/index.php" target="frame">Bautizos <span class="icon-dot"></span></a></li>
						<li class="ingre"><a href="paginas/clientes/eventos/primera comunion/index.php" target="frame">Primera comunion <span class="icon-dot"></span></a></li>
						<li class="ingre"><a href="paginas/clientes/eventos/confirmaciones/index.php" target="frame">Confirmaciones <span class="icon-dot"></span></a></li>
					</ul>
				</li>

				<li class="ingre"><a href="paginas/clientes/articulos/index.php" target="frame"><span class="icon-spoon-knife"></span>Productos</a></li>
		<?php endif; ?>

		<!-- Cotizaciones clientes -->

		<?php if (!empty($_SESSION['correo_user']) && $_SESSION['Cod_clase_user']=="2"):?>

				<li class="ingre"><a href="paginas/clientes/cotizacion/index.php" target="frame"><span class="icon-file-text2"></span>Cotizacion</a></li>

		<?php endif; ?>

		<!-- Cotizaciones y ingresar -->

		<?php if (!isset($_SESSION['correo_user']) && !isset($_SESSION['Cod_clase_user'])):?>

				<li class="ingre"><a onclick="alert('Ingrese sesion primero');" href="#modal"><span class="icon-file-text2"></span>Cotizacion</a></li>

				<li class="ingre"><a href="#modal"><span class="icon-user"></span>Ingresar</a></li>

		<?php endif;?>

			</ul>
		</nav>
	</header>

	<!-- Iframe -->

	<section>
		<iframe src="paginas/inicio/index.php" name="frame" seamless="seamless" frameborder="0" allowtransparency="true">
		</iframe>
	</section>

	<!-- Modal ingresar -->

	<link rel="stylesheet" href="css/style1.css">
	<link rel="stylesheet" href="mediaq/style.css">
	
	<div class="contenedor2 modal" id="modal" style="-webkit-box-shadow: 10px 10px 18px 0px rgba(0,0,0,0.75);-moz-box-shadow: 10px 10px 18px 0px rgba(0,0,0,0.75);box-shadow: 10px 10px 18px 0px rgba(0,0,0,0.75);">
		<div class="modal2">
		<img src="img/ico.png" class="img2">
			<form class="modal3" method="POST" action="php/proceso.php" name="inicio" onload="document.inicio.reset();">
				<a href="#" class="modal__close">&times;</a>
				<p><h1 class="h1">Inicio</h1></p>
				<article class="article">
				<div class="div">
					<label class="label"><b><p>Usuario</p></b></label>
					<input type="email" name="usuario" required="" class="input" placeholder="Ingrese su correo">
				</div>
				<div class="div">
					<label class="label"><b><p>Contraseña</p></b></label>
					<input type="password" name="contraseña" minlength="6" required=""
					class="input" placeholder="Ingrese su contraseña">
				</div>
				</article>
				<input type="submit" class="enviar input" value="Login">
			</form>
			<p class="link2">
				<a href="#">Olvido su contraseña</a>
				<br>
				<a href="#modal2">Registrese</a>
			</p>
		</div>
	</div>
	
	<!-- Fin modal -->

	<!-- Modal registrar -->

	<link rel="stylesheet" href="css/style2.css">
	<link rel="stylesheet" href="mediaq/style2.css">

	<div class="contenedor modal" id="modal2" style="-webkit-box-shadow: 10px 10px 18px 0px rgba(0,0,0,0.75);-moz-box-shadow: 10px 10px 18px 0px rgba(0,0,0,0.75);box-shadow: 10px 10px 18px 0px rgba(0,0,0,0.75);">
		<div class="modal2">
		<img src="img/ico.png" class="img">
			<form class="modal3" method="POST" action="php/proceso2.php" name="inicio" onload="document.inicio.reset();">
				<a href="#" class="modal__close">&times;</a>
				<h1>Registrese</h1>
				<article>
				<div>
					<label><b>N. Ident.</b></label>
					<input type="number" name="id" placeholder="Escriba su numero de identificacion" required="">
				</div>
				<div>
					<label><b>Nombres</b></label>
					<input type="text" name="nom" placeholder="Escriba sus nombres" required="">
				</div>
				<div>
					<label><b>Apellidos</b></label>
					<input type="text" name="ape" placeholder="Escriba sus apellidos" required="">
				</div>
				<div>
					<label><b>Telefono</b></label>
					<input type="number" name="tel" placeholder="Escriba su telefono o numero de celular" min="0" required="">
				</div>
				<div>
					<label><b>Correo</b></label>
					<input type="email" name="corre" placeholder="Escriba su correo electronico" required="">
				</div>
				<div>
					<label><b>Contraseña</b></label>
					<input type="password" name="contra" placeholder="Escriba su contraseña" minlength="6" required="">
				</div>
				<div>
					<label><b>Contraseña</b></label>
					<input type="password" name="contra2" placeholder="Vuelva a escribir su contraseña" minlength="6" required="">
				</div>
				</article>
				<input type="submit" value="Registrarse">
			</form>
			<br>
		</div>
	</div>

	<!-- Fin modal -->
	
<script src="jquery/jquery-latest.js"></script>
<script src="js/main.js"></script>
</body>
</html>