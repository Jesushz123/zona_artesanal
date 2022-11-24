<?php
session_start();
if (!isset($usuario)) {
  echo "<h1 class='h1'>Por favor debes iniciar sesion</h1>";
session_destroy();
      die();
}
$connect = mysqli_connect("localhost", "root","","zonartesanal");
if (isset($_POST['add_to_cart'])) {
  if (isset($_SESSION['cart'])) {
    $session_array_id = array_column($_SESSION['cart'], "Id_producto");
    if(!in_array($_GET['Id_producto'], $session_array_id)){
      $session_array = array(
        'Id_producto' =>$_GET['Id_producto'],
        "nombre" => $_POST['nombre'],
        "precio" => $_POST['precio'],
        "quantity"=> $_POST['quantity']
      );
      $_SESSION['cart'][]= $session_array;
    }


  }else{
    $session_array = array(
      'Id_producto' =>$_GET['Id_producto'],
      "nombre" => $_POST['nombre'],
      "precio" => $_POST['precio'],
      "quantity"=> $_POST['quantity']
    );
    $_SESSION['cart'][]= $session_array;
  }
}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Carrito de compras</title>
  <link rel="stylesheet" type="text/css"  href="Assets/css/estilos.css" />
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>



  <H1><center>ZonArtesanal</center></h1>
  <div class="container-fluid">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-6">
          <h2>Carrito de compras </h2>
          <div class="col-md-12">
            <div class="row">

          <?php
          $query = "SELECT * FROM producto";
          $result=mysqli_query($connect,$query);

          while ($row = mysqli_fetch_array($result)) {?>
            <div class="col-md-4">
            <form method="post" action="Productos.php?Id_producto=<?=$row['Id_producto']?>">
              <img src="img/<?= $row['imagen']?>" style='height:150px;'>
              <h4 class="text-center"><?= $row['nombre'];?></h4>
              <h4 class="text-center">$<?= number_format($row['precio'],2);?></h4>
              <input type="hidden" name="nombre" value="<?=$row['nombre']?>">
              <input type="hidden" name="precio" value="<?=$row['precio']?>">
              <input type="number" name="quantity" value="1" class="form-control">
              <input type="submit" name="add_to_cart" class="btn btn-warning btn btn-block my-2" value="agregar">

            </form>
          </div>
          <?php }

           ?>
         </div>
       </div>
        </div>

        <div class="col-md-6">
          <h2>Productos seleccionados </h2>
          <?php
          $total = 0;
          $output ="";
          $output .="
          <table class='table table-bordered table-striped'>
          <tr>
          <th>Id_producto</th>
          <th>Producto</th>
          <th>Precio</th>
          <th>Cantidad</th>
          <th>Precio total</th>
          <th>Accion</th>
          </tr>
          ";

          if (!empty($_SESSION['cart'])) {
            foreach($_SESSION['cart'] as $key => $value){
           $output.="

           <tr>
            <td>".$value['Id_producto']."</td>
            <td>".$value['nombre']."</td>
            <td>".$value['precio']."</td>
            <td>".$value['quantity']."</td>
            <td>".number_format($value['precio'] * $value['quantity'],2)."</td>
            <td>
              <a href='Productos.php?action=remove&Id_producto=".$value['Id_producto']."'>
              <button class='btn btn-danger btn-block'>Eliminar</button>
              </a>
              </td>
              ";

              $total = $total + $value['quantity'] * $value['precio'];

            }
            $output  .="
            <tr>
            <td colspan='3'</td>
            <td><b>Precio total</b></td>
            <td>".number_format($total,2)."</td>
            <td>
              <a href= 'Productos.php?action=clearall'
              <button class='btn btn-warning'> Borrar todo</button>
              </a>
              </td>

            </tr>
            ";
          }




          echo $output;


           ?>

        </div>
      </div>
    </div>
  </div>
  <?php
  if(isset($_GET['action'])){
    if($_GET['action']=="clearall"){
      unset($_SESSION['cart']);
    }
    if ($_GET['action']=="remove") {

      foreach ($_SESSION['cart'] as $key => $value) {
      if ($value['Id_producto']==$_GET['Id_producto']) {
        unset($_SESSION['cart'][$key]);
      }
      }
    }
  }

   ?>
</body>
</html>
