<?php
session_start();

if (!isset($_SESSION['user'])) {
  echo "<h1 class='h1'>Por favor debes iniciar sesion</h1>";
  echo "<form action='login.php'>";
        echo "<input type='submit' value='Regresar' name='btnregresar' class='button'><br>";
session_destroy();
      die();
}

  include 'Global/conexion.php';
  include 'carrito.php';





?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Productos</title>
    <link rel="stylesheet" type="text/css" href="Assets/css/esti.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </head>
  <body >

    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a ><?php echo "<h5>Bienvenido(a)</h5>"; ?></a>
      <button class="navbar-toggler" data-target="#mynav" data-toggle="collapse">

        <span class="navbar-toggler-icon"></span>
      </button>
      <div id="my-nav" class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="mostrar_carro.php"> <img src="Assets/img/carrito.png" width="30" height="30" > (<?php echo (empty($_SESSION['CARRITO']))?0:count($_SESSION['CARRITO']); ?>)</a>
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
      <br>
      <div class="row">
        <?php
        $sentencia=$conn->prepare("SELECT * FROM `producto`");
        $sentencia->execute();
        $listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);

         ?>
         <?php foreach ($listaProductos as $producto) { ?>
           <div class="col-3">
             <div class="card">
               <img  class="card-img-top" src="img/<?php echo $producto['imagen']; ?>" height="200px">

               <div class="card-body">
                 <span><?php echo $producto['nombre']; ?></span>
                 <h5 class="card-title">$<?php echo $producto['precio']; ?></h5>
                 <p class="card-text"><?php echo $producto['descripcion']; ?></p>

                 <form  action="" method="post">
                   <input type="hidden" name="Id_producto" id="Id_producto" value="<?php echo openssl_encrypt($producto['Id_producto'],COD,KEY);?>">
                   <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($producto['nombre'],COD,KEY);?>" >
                   <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($producto['precio'],COD,KEY);?>">
                   <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1,COD,KEY);?>">


                 <button class="btn btn-primary" name="btnAccion" value="agregar" type="submit">Agregar al carrito</button>
               </form>
               </div>
             </div>
           </div>


         <?php } ?>




</body>
</html>
