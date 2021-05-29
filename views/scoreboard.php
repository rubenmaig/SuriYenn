<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Web SuriYenn" />
	  <meta name="keywords" content="videojuegos, aventura, zelda, isaac, suri, yenn, indie, 2D, pixel" />
    <meta name="Cesur" content="Rubén Maldonado Iglesias">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/custom.css">
	  <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
    <title>SuriYenn - Sitio Web</title>
</head>
<body>
  <div class="row justify-content-center">
    <div class="col-6 text-white bg-dark justify-content-center bgshadow">
      <div class="">
        <?php include('header.php'); ?>
      </div>
      <div class="px-2 leaderboard">
          <h3 class="text-center">Tablón de puntuaciones</h3>
          <?php
          include "../controllers/conexionController.php";

          $sql_registe = mysqli_query($conexion, "SELECT COUNT(*) as total_registro FROM leaderboard");
          $result_register = mysqli_fetch_array($sql_registe);
          $total_registro = $result_register['total_registro'];
          $por_pagina=10;
          if (empty($_GET['pagina'])) {
            $pagina=1;
          }else{
            $pagina=$_GET['pagina'];
          }

          $desde = ($pagina-1) * $por_pagina;
          $total_paginas = ceil($total_registro / $por_pagina);
          ?>
          <div>

            <div class="result">
              <?php echo $result_register['total_registro'] ?> resultados. <?php echo $por_pagina ?> resultados por página.
            </div>
          </div>
          <?php
          if (!$conexion) {
          	die("Conexion fallida " . mysqli_connect_error($conn));
          }

          $consulta = "SELECT * FROM leaderboard ORDER BY puntos DESC LIMIT $desde, $por_pagina";
          $resultado = mysqli_query($conexion, $consulta);
          echo "<ul>";
          $posicion=(10*$pagina)-9;
          while ($columna = mysqli_fetch_array($resultado)){
            echo "<hr><li>
                    <mark class=\"bg-dark lb1\">".$posicion++.".</mark>
                    <mark class=\"bg-dark lb1\">".$columna['nombre']."</mark>
                    <mark class=\"bg-dark lb2\">".$columna['puntos']."</mark>
                  </li><hr>";
          }
          echo "</ul>";
          mysqli_close($conexion);
          ?>
      </div>
      <br>
    <div class="paginador">
      <ul>
        <?php
        if ($pagina != 1) {
         ?>
        <li><a href="?pagina=<?php echo 1; ?>">|<</a></li>
        <li><a href="?pagina=<?php echo $pagina-1; ?>"><<</a></li>
        <?php
        }
          for ($i=1; $i <= $total_paginas; $i++) {
            if ($i == $pagina) {
              echo '<li class="pageSelected">'.$i.'</li>';
            }else{
            echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
            }
          }

          if ($pagina != $total_paginas) {
         ?>
        <li><a href="?pagina=<?php echo $pagina+1; ?>">>></a></li>
        <li><a href="?pagina=<?php echo $total_paginas; ?>">>|</a></li>
        <?php
          }
        ?>
      </ul>
    </div>
      <div class="">
        <?php include('footer.php'); ?>
      </div>
    </div>
  </div>

<!-- Latest compiled and minified JavaScript -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
</body>
</html>
