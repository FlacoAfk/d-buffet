<?php session_start(); ?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>D'buffet</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
		    <script src="js/jssor.slider-27.5.0.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        jssor_1_slider_init = function() {

            var jssor_1_SlideshowTransitions = [
              {$Duration:800,x:-0.3,$During:{$Left:[0.3,0.7]},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,x:0.3,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}
            ];

            var jssor_1_options = {
              $AutoPlay: 1,
              $SlideshowOptions: {
                $Class: $JssorSlideshowRunner$,
                $Transitions: jssor_1_SlideshowTransitions,
                $TransitionsOrder: 1
              },
              $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$
              },
              $ThumbnailNavigatorOptions: {
                $Class: $JssorThumbnailNavigator$,
                $Orientation: 2,
                $NoDrag: true
              }
            };

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

            /*#region responsive code begin*/

            var MAX_WIDTH = 980;

            function ScaleSlider() {
                var containerElement = jssor_1_slider.$Elmt.parentNode;
                var containerWidth = containerElement.clientWidth;

                if (containerWidth) {

                    var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

                    jssor_1_slider.$ScaleWidth(expectedWidth);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }

            ScaleSlider();

            $Jssor$.$AddEvent(window, "load", ScaleSlider);
            $Jssor$.$AddEvent(window, "resize", ScaleSlider);
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
            /*#endregion responsive code end*/
        };
    </script>
    <style>
        /*jssor slider loading skin spin css*/
        .jssorl-009-spin img {
            animation-name: jssorl-009-spin;
            animation-duration: 1.6s;
            animation-iteration-count: infinite;
            animation-timing-function: linear;
        }

        @keyframes jssorl-009-spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .jssora061 {display:block;position:absolute;cursor:pointer;}
        .jssora061 .a {fill:none;stroke:#fff;stroke-width:360;stroke-linecap:round;}
        .jssora061:hover {opacity:.8;}
        .jssora061.jssora061dn {opacity:.5;}
        .jssora061.jssora061ds {opacity:.3;pointer-events:none;}
    </style>
	</head>
	<body class="landing" id="volver">

		<!-- Header -->
			<header id="header" class="alt">
				<h1><strong><a href="index.php">Buffet</a></strong></h1>
			</header>

		<!-- Banner -->
			<section id="banner">
				<h2>BUFFET</h2>
				<p>Casa de eventos.</p>
				<ul class="actions">
					<li><button id="boton" class="button special big aber">Nosotros</button></li>
				</ul>
			</section>

			<!-- One -->
				<section id="one" class="wrapper style1">
					<div class="container 75%">
						<div class="row 200%">
							<div class="6u 12u$(medium)">
								<header class="major">
									<h2>¿SOBRE NOSOTROS?</h2>
									<p>Informacion</p>
								</header>
							</div>
							<div class="6u$ 12u$(medium)" style="font-size: 18px">
								<p>Esta empresa se encarga de realizar eventos como: primeras comuniones, reuniones familiares, etc...<br/><br/> En esta pagina podras cotizar todo lo que necesites para tu evento: platos, decoracion, menaje(todo lo que son losas, vasos y cubiertos), etc...</p>
							</div>
						</div>
					</div>
				</section>

			<!-- Two -->
				<section id="two" class="wrapper style2 special">
					<div class="container">
						<header class="major">
							<h2>Productos</h2>
							<p>Algunos de estos</p>
						</header>
						<div class="row 150%">
							<div class="6u 12u$(xsmall)">
								<div class="image fit captioned">
									<img src="images/pic02.jpg" alt="" />
									<h3>Platos deliciosos.</h3>
								</div>
							</div>
							<div class="6u$ 12u$(xsmall)">
								<div class="image fit captioned">
									<img src="images/pic03.jpg" alt="" />
									<h3>Menajes.</h3>
								</div>
							</div>
						</div>
						<ul class="actions">
							<li><a href="../clientes/articulos/index.php" class="button special big">VER</a></li>
						</ul>
					</div>
				</section>

			<!-- Three -->
				<section id="three" class="wrapper style1">
					<div class="container">
						<header class="major special">
							<h2>Multiples eventos</h2>
							<p>Los que necesites!</p>
						</header>
						<div class="feature-grid">
							<div class="feature">
								<div class="image rounded"><img src="images/pic04.jpg" alt="" /></div>
								<div class="content">
									<header>
										<h4>Matrimonios</h4>
									</header>
									<p>Queremos ser parte de la boda de tus sueños. Ese momento en que todos te miran con sonrisas y lágrimas; es uno de los mejores recuerdos que tendrás, por ello, te prestamos nuestros servicios de manera personalizada, con el fin de hacer realidad lo que siempre quisiste.</p>
								</div>
							</div>
							<div class="feature">
								<div class="image rounded"><img src="images/banner.jpg" alt="" /></div>
								<div class="content">
									<header>
										<h4>Aniversarios</h4>
									</header>
									<p>El aniversario de una boda o noviazgo es una fecha especial, que los esposos y novios deben aprovechar para celebrar y de esta forma evitar la monotonía. La idea es que cada uno le de a su pareja un regalo del material alusivo a las bodas que cumplen.</p>
								</div>
							</div>
							<div class="feature">
								<div class="image rounded"><img src="images/pic06.jpg" alt="" /></div>
								<div class="content">
									<header>
										<h4>15 Años</h4>
									</header>
									<p>Para una quinceañera es tan importante esta fecha, el comienzo de un cambio de bellas emociones, te estas convirtiendo en una señorita con ilusiones y sueños; por eso tiene que ser una fecha especial y que mejor ocasión para desearle lo mejor en sus cumpleaños.</p>
								</div>
							</div>
							<div class="feature">
								<div class="image rounded"><img src="images/pic07.jpg" alt="" /></div>
								<div class="content">
									<header>
										<h4>Reuniones Familiares</h4>
									</header>
									<p>Nuestras fiestas para reuniones familiares son únicas y variadas, poseemos diseños temáticos especiales que incluyen decoración alusiva al tema de la fiesta. Hasta el más mínimo detalle lo tenemos planeado y diseñado para hacer de su fiesta un evento inolvidable.</p>
								</div>
							</div>
						</div>
					</div>
				</section>

			<!-- Four -->
				<section id="four" class="wrapper style3 special">
					<div class="container">
						<header class="major">
							<h2>Galeria De Productos</h2>
							<p>que lo disfutes!</p>
						</header>
						<!-- slider -->
							<div id="jssor_1" style="-webkit-box-shadow: 10px 10px 18px 0px rgba(0,0,0,0.75);-moz-box-shadow: 10px 10px 18px 0px rgba(0,0,0,0.75);box-shadow: 10px 10px 18px 0px rgba(0,0,0,0.75);border-radius: 15px;position:relative;margin:0 auto;top:0px;left:0px;width:980px;height:500px;overflow:hidden;visibility:hidden;">
        <!-- Loading Screen -->
        <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
            <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="img/spin.svg" />
        </div>
        <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:980px;height:500px;overflow:hidden;">

        	<?php 
        	include("../../php/conexion.php");

        	$sqli=mysqli_query($mysqli, ("SELECT imagenes, nombre FROM articulos"));
        	$no=1;
        	while ($row=mysqli_fetch_assoc($sqli)):
        	 ?>
            <div>
                <img data-u="image" src="<?php echo "../admin/articulos/crud/".$row['imagenes']?>" />
                <div u="thumb"><?php echo $row['nombre']; ?></div>
            </div>
            <?php endwhile;
            $no++; ?>
        </div>
        <!-- Thumbnail Navigator -->
        <div u="thumbnavigator" style="position:absolute;bottom:0px;left:0px;width:980px;height:50px;color:#FFF;overflow:hidden;cursor:default;background-color:rgba(0,0,0,.5);">
            <div u="slides">
                <div u="prototype" style="position:absolute;top:0;left:0;width:980px;height:50px;">
                    <div u="thumbnailtemplate" style="position:absolute;top:0;left:0;width:100%;height:100%;font-family:arial,helvetica,verdana;font-weight:normal;line-height:50px;font-size:16px;padding-left:10px;box-sizing:border-box;"></div>
                </div>
            </div>
        </div>
        <!-- Arrow Navigator -->
        <div data-u="arrowleft" class="jssora061" style="width:55px;height:55px;top:0px;left:25px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
            <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <path class="a" d="M11949,1919L5964.9,7771.7c-127.9,125.5-127.9,329.1,0,454.9L11949,14079"></path>
            </svg>
        </div>
        <div data-u="arrowright" class="jssora061" style="width:55px;height:55px;top:0px;right:25px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
            <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <path class="a" d="M5869,1919l5984.1,5852.7c127.9,125.5,127.9,329.1,0,454.9L5869,14079"></path>
            </svg>
        </div>
    </div>
    			<br>
						<!-- fin slider -->
						<ul class="actions">
							<li><button id="boton2" class="button special big">Volver Arriba</button></li>
						</ul>
					</div>
				</section>

		<!-- Footer -->
			<footer id="footer">
				<div class="container">
					<ul class="icons">
						<li><a href="https://www.facebook.com/DbuffetOficial/" target="_blank" class="icon fa-facebook"></a></li>
						<li><a href="#" class="icon fa-twitter"></a></li>
						<li><a href="#" class="icon fa-instagram"></a></li>
					</ul>
					<ul class="copyright">
						<li>&copy; Untitled</li>
						<li>Design: <a href="https://www.facebook.com/julian.medinamonje.3" target="_blank">Julian</a> and <a href="https://www.facebook.com/paulahoyos1539" target="_blank">Paula</a></li>
						<li>Images: <a href="https://www.facebook.com/DbuffetOficial/" target="_blank">D'buffet<u style="font-size: 10px">(facebock)</u></a></li>
					</ul>
				</div>
			</footer>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script type="text/javascript">jssor_1_slider_init();</script>
			<script src="assets/js/util.js"></script>
			<script src="js/main.js"></script>
	</body>
</html>