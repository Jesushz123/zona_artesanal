<?php
session_start();
require 'Database.php';
if (isset($_SESSION['id_cliente'])) {
  $records = $conn->prepare('SELECT id_cliente,password FROM cliente WHERE id_cliente=id_cliente');
  $records->bindParam(':id_cliente', $_SESSION['id_cliente']);
  $records ->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC);

  // code...
}
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Bienvenido</title>
    <link rel="stylesheet" type="text/css" href="Assets/css/estilos2.css">
  </head>
  <body>
    <div>
      <center>
        <img src="Assets/img/logo.png" height="500" width="900">
      </center>
    </div>

    <div>
      <center>

      <h1>Somos una empresa dedicada a la creación y ventas de productos artesanales (Muebles, juguetes, tapetes, ropa, etc).
      <center>Ingresa y conocenos</center>
    </h1>
</center>
    </div>
    <div id="columnas">

        <a align="right" href="login.php"><img src="Assets/img/Iniciar.png" width="298" height="120" /></a>


        <a href="Registro.php"><img src="Assets/img/Registrar.png" width="298" height="120" /></a>

</div>
  </body>
</html>
