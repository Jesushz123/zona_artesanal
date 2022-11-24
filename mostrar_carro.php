
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
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a class="navbar-brand"><?php echo "<h5>Productos solicitados</h5>"; ?></a>
      <button class="navbar-toggler" data-target="#mynav" data-toggle="collapse">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div id="my-nav" class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="pro.php"> <img src="Assets/img/regresar.png" width="40" height="40" >  </a>
        </ul>
        <center> <a href='logica/salirsesion.php'>Salir de la sesion</a></center>
      </div>
    </nav>
    <div class="container">

      <br>
      <p>
      <h3>Productos seleccionados </h3>
      <?php if (!empty($_SESSION['CARRITO'])) {?>

      <table class="table table-light" >
        <tbody>
          <tr>
            <th width="40%" class="tex-center">NOMBRE</th>
            <th width="40%" class="tex-center">PRECIO</th>
            <th width="40%" class="tex-center">CANTIDAD</th>
            <th width="40%" class="tex-center">TOTAL</th>
            <th width="40%" class="tex-center">--</th>
          </tr>
          <?php $total=0; ?>
          <?php foreach ($_SESSION['CARRITO'] as $indice=>$producto) {?>

          <tr>
            <td width="40%"><?php echo $producto['NOMBRE'] ?></td>
            <td width="40%"><?php echo $producto['PRECIO'] ?></td>
            <td width="40%"><?php echo $producto['CANTIDAD'] ?></td>
            <td width="40%"><?php echo number_format($producto['PRECIO']*$producto['CANTIDAD'],2)?></td>


            <td width="40%">
              <form accion="" method="post">
               <input type="hidden" name="Id_producto" id="Id_producto" value="<?php echo openssl_encrypt($producto['ID'],COD,KEY);?>">
                <button class="btn btn-danger" type="submit" name="btnAccion" value="Eliminar">Eliminar</button>
              </form>
            </td>
          </tr>
          <?php $total=$total+($producto['PRECIO']*$producto['CANTIDAD']); ?>
        <?php } ?>
        <tr>
          <td colspan="3" align="right"><h3>Total</h3></td>
          <td align=right><h3>$<?php echo number_format($total,2); ?></h3></td>
          <td></td>
        </tr>
        <tr>
          <td colspan="5"></td>
          <form  action="pagar.php" method="post">
            <div class="form-group">
              <label for="my-input">Ingresa tu correo electronico:</label>
              <input id="email" name="email" class="form-control" type="email"
              placeholder="Ingresa tu correo" required>
            </div>
            <button class="btn btn-primary btn-lg btn-block" type="submit"
            name="btnAccion" value="proceder" >Pagar</button>
          </form>
        </tr>



        </tbody>
      </table>
    <?php }else { ?>
      <div class="alert alert-sucess">
        No has seleccionado ningún producto

      </div>
    <?php } ?>
      </br>


    </div>

  </body>
</html>
