<?php
namespace Cresi;
require dirname( __FILE__ ) . '/bootstrap.php';

if ( ! isset( $_SESSION['vidas'] ) ) {
  $_SESSION['vidas'] = 3;
}

$vidas = isset( $_SESSION['vidas'] ) ? $_SESSION['vidas'] : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/estilos.css">
  <title>Document</title>
</head>
<body>
  <?php
    $opcion1="";
    $opcion2="";
    $opcion3="";
    $opcion4="";
    $respuesta_correcta="";
    $id_pregunta=rand(1,248);
    $conexion = db()->link;
    $categoria = $_GET['categoria'];
    $query = "SELECT * FROM pregunta WHERE categoria = '$categoria' ORDER BY RAND() LIMIT 0,1";
    // echo $query;
    $datos = mysqli_query($conexion, $query);
    // echo $id_pregunta;
    // var_dump($datos);

    if ($reg = mysqli_fetch_array($datos)) {
      // var_dump($reg);
      $respuesta_correcta = $reg['respuestaCorrecta'];
      switch (rand(1,4)) {
        case 1:
          $opcion1 = $reg['respuesta1'];
          $opcion2 = $reg['respuesta2'];
          $opcion3 = $reg['respuesta3'];
          $opcion4 = $respuesta_correcta;
          break;
        case 2:
          $opcion1 = $reg['respuesta1'];
          $opcion2 = $reg['respuesta2'];
          $opcion3 = $respuesta_correcta;
          $opcion4 = $reg['respuesta3'];
          break;
        case 3:
          $opcion1 = $reg['respuesta1'];
          $opcion2 = $respuesta_correcta;
          $opcion3 = $reg['respuesta2'];
          $opcion4 = $reg['respuesta3'];
          break;
        case 4:
          $opcion1 = $respuesta_correcta;
          $opcion2 = $reg['respuesta1'];
          $opcion3 = $reg['respuesta2'];
          $opcion4 = $reg['respuesta3'];
          break;
      }
    }
  ?>


  <div class="header header_pregunta">
      <p class="vida">Vidas: <span id="vidas"><?php echo $vidas; ?></span></p>
      <center><img src="img/logo.png" id="icono" class="icono2" height="70"/></center>
  </div>
  <div class="pregunta">
    <div class="jumbotron">
      <h3 class="texto_pregunta"><?php echo $reg['pregunta']; ?></h3>
    </div>
  </div>


  <div class="opciones">
    <button class="btn btn-opcion btn-success btn-lg" onclick="Respuesta('<?php echo $opcion1; ?>', '<?php echo $respuesta_correcta; ?>')" ><?php echo $opcion1; ?></button>
    <br>

    <button class="btn btn-opcion btn-success btn-lg" onclick="Respuesta('<?php echo $opcion2; ?>', '<?php echo $respuesta_correcta; ?>')" ><?php echo $opcion2; ?></button>
    <br>

    <button class="btn btn-opcion btn-success btn-lg" onclick="Respuesta('<?php echo $opcion3; ?>', '<?php echo $respuesta_correcta; ?>')" ><?php echo $opcion3; ?></button>
    <br>

    <button class="btn btn-opcion btn-success btn-lg" onclick="Respuesta('<?php echo $opcion4; ?>', '<?php echo $respuesta_correcta; ?>')" ><?php echo $opcion4; ?></button>
    <br>


  </div>
  <div class="reloj">
    <p class="cont h3" id="contador">15</p>
  </div>
  <script src="js/jquery.js" charset="utf-8"></script>
  <script src="js/bootstrap.min.js" charset="utf-8"></script>
  <script src="js/preguntas.js" charset="utf-8"></script>
  <script src="js/temporizador.js" charset="utf-8"></script>
</body>
</html>
