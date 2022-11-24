
<?php
session_start();
if (!isset($_SESSION['user'])) {
  echo "<h1 class='h1'>Por favor debes iniciar sesion</h1>";
  echo "<form action='login.php'>";
        echo "<input type='submit' value='Regresar' name='btnregresar' class='button'><br>";
session_destroy();
      die();
    }
  include 'Global/config.php';
  include 'Global/conexion.php';
  include 'carrito.php';
  include 'Global/paypal.php';



?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Productos</title>
     <link rel="stylesheet" type="text/css" href="Assets/css/esti.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
  integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script
src="https://www.paypal.com/sdk/js?&client-id=AdpBrh5BzEeMuDT0bXh47mFXm7FbWesHvrwQN55TmCXWXcwxcVesoKzqUPpWMJRKgMn0eywMFkx5jF1s  currency=MXN"></script>
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a ><?php echo "<h5>Pago de productos</h5>"; ?></a>
      <button class="navbar-toggler" data-target="#mynav" data-toggle="collapse">

        <span class="navbar-toggler-icon"></span>
      </button>
      <div id="my-nav" class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="pro.php"> <img src="Assets/img/regresar.png" width="40" height="40" >
          </li>

      </ul>
      <center> <a href='logica/salirsesion.php'>Salir sesion </a></center>
      </div>
    </nav>

    <div class="container">
<br>
<br>
<br>
<br>
<?php
if ($_POST) {
       $total=0;
       $SID=session_id();
       $correo=$_POST['email'];
       foreach ($_SESSION['CARRITO'] as $indice=>$producto){
         $total=$total+($producto['PRECIO']*$producto['CANTIDAD']);
       }
       $sentencia=$conn->prepare(
         "INSERT INTO `pedido` (`Id_pedido`, `clave`, `datospaypal`, `fecha`, `correo`, `total`, `status`)
              VALUES (NULL,:clave, '',NOW(), :correo, :total, 'pendiente');");
              $sentencia->bindParam(":clave",$SID);
              $sentencia->bindParam(":correo",$correo);
              $sentencia->bindParam(":total",$total);
              $sentencia->execute();
              $idpedido=$conn->lastInsertId();

               foreach ($_SESSION['CARRITO'] as $indice=>$producto){
               $sentencia=$conn->prepare("UPDATE pedido JOIN cliente ON pedido.correo=cliente.correo
                 SET pedido.Id_cliente=cliente.Id_cliente");
               $sentencia->execute();
              }
            foreach ($_SESSION['CARRITO'] as $indice=>$producto){
            $sentencia=$conn->prepare(
            "INSERT INTO `pago` (`id_pago`, `id_pedido`, `id_producto`, `preciouni`, `cantidad`)
            VALUES (NULL, :id_pedido, :id_producto, :preciouni, :cantidad);");
            $sentencia->bindParam(":id_pedido",$idpedido);
            $sentencia->bindParam(":id_producto",$producto['ID']);
            $sentencia->bindParam(":preciouni",$producto['PRECIO']);
            $sentencia->bindParam(":cantidad",$producto['CANTIDAD']);
            $sentencia->execute();
            }


 	 }
?>


<div class="jumbotron">
  <h1 class="display-4">Metodo de pago paypal</h1>
  <hr class="my-4">
  <p class="lead">Cantidad de pagar con paypal es: <h4> $<?php echo number_format($total,2); ?></h4>

  </p>
   <div id="paypal-button-container"></div>
  <script>
  paypal.Buttons().render('#paypal-button-container');

  </script>


</div>


  </body>
  </html>
