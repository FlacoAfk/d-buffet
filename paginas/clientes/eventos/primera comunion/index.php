<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title></title>
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="jquery.bsPhotoGallery.css" rel="stylesheet">
    <script src="../../bootstrap/jquery/jquery.min.js"></script>
    <script src="../../bootstrap/jquery/jquery-3.3.1.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script src="jquery.bsPhotoGallery.js"></script>
    <script>
      $(document).ready(function(){
        $('ul.first').bsPhotoGallery({
          "classes" : "col-lg-2 col-md-4 col-sm-3 col-xs-4 col-xxs-12",
          "hasModal" : true,
          // "fullHeight" : false
        });
      });
    </script>
  </head>
  <style>
    @import url(https://fonts.googleapis.com/css?family=Bree+Serif);

      body {
        background:#ebebeb;
      }
      ul {
          padding:0 0 0 0;
          margin:0 0 40px 0;
      }
      ul li {
          list-style:none;
          margin-bottom:10px;
      }

    .text {
      /*font-family: 'Bree Serif';*/
      color:#666;
      font-size:11px;
      margin-bottom:10px;
      padding:12px;
      background:#fff;
    }



  </style>
  <body>
    <div class="container">
        <div class="row" style="text-align:center; border-bottom:1px dashed #ccc;  padding:0 0 20px 0; margin-bottom:40px;">
            <h3 style="font-family:'Bree Serif', arial; font-weight:bold; font-size:30px;">
                <a style="text-decoration:none; color:#666;">BUFFET CASA DE EVENTOS - PRIMERA COMUNION</a>
            </h3>
           
        </div>

        <ul class="row first">
        <?php include('../../../../php/conexion.php');
    $directory="img";
    $dirint = dir($directory);
    while (($archivo = $dirint->read()) !== false)
    {
        if (preg_match('/'."gif".'/i', $archivo) || preg_match('/'."jpg".'/i', $archivo) || preg_match('/'."png".'/i', $archivo)){
            echo '
            <li>
            <img alt="Primera Comunion" src="'.$directory."/".$archivo.'">
            </li>';
        }
    }
    $dirint->close();
        ?>
        </ul>
    </div> <!-- /container -->

  </body>


</html>
