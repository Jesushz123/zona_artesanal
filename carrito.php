<?php

$mensaje="";

if (isset($_POST['btnAccion'])) {

  switch ($_POST['btnAccion']) {

    case 'agregar':

      if (is_numeric(openssl_decrypt($_POST['Id_producto'],COD,KEY))){
        $ID=openssl_decrypt($_POST['Id_producto'],COD,KEY);
        //$mensaje.= "ID CORRECTO" .$ID."<br/>";
      }else {
        //$mensaje.= "ID INCORRECTO" .$ID."<br/>";
        }
      if(is_string(openssl_decrypt($_POST['nombre'],COD,KEY))){
        $NOMBRE=openssl_decrypt($_POST['nombre'],COD,KEY);
        //$mensaje.="NOMBRE CORRECTO".$NOMBRE."<br/>";
      }else {
        //$mensaje.="NOMBRE MAL".$NOMBRE."<br/>";
        break; }

      if (is_numeric(openssl_decrypt($_POST['cantidad'],COD,KEY))) {
        $CANTIDAD=openssl_decrypt($_POST['cantidad'],COD,KEY);
        //$mensaje.="La cantidad está bien".$CANTIDAD."<br/>";
      }
      else {
        $mensaje.="La cantidad está mal".$CANTIDAD. "<br/>";
        break; }
      if (is_numeric(openssl_decrypt($_POST['precio'],COD,KEY))) {
        $PRECIO=openssl_decrypt($_POST['precio'],COD,KEY);
        //$mensaje.= "Precio correcto".$PRECIO."<br/>";
      }else {
        //$mensaje.= "Precio incorrecto".$PRECIO."<br/>";
      break;}

      if (!isset($_SESSION['CARRITO'])) {
        $producto=array(
          'ID'=>$ID,
          'NOMBRE'=>$NOMBRE,
          'CANTIDAD'=>$CANTIDAD,
          'PRECIO'=>$PRECIO
        );
        $_SESSION['CARRITO'][0]=$producto;
      //  $mensaje="Producto agregado";
      }else {
          $idproductos=array_column($_SESSION['CARRITO'],"ID");
          if (in_array($ID,$idproductos)) {
            echo "<script>alert('El producto ya ha sido seleccionado');</script>";
        //    $mensaje="";
          }

        else {
        $NumeroProductos=count($_SESSION['CARRITO']);
        $producto=array(
          'ID'=>$ID,
          'NOMBRE'=>$NOMBRE,
          'CANTIDAD'=>$CANTIDAD,
          'PRECIO'=>$PRECIO
        );
        $_SESSION['CARRITO'][$NumeroProductos]=$producto;
//        $mensaje="Producto agregado";
      }
    }



      break;
      case "Eliminar":
      if (is_numeric(openssl_decrypt($_POST['Id_producto'],COD,KEY))){
        $ID=openssl_decrypt($_POST['Id_producto'],COD,KEY);
        foreach ($_SESSION['CARRITO'] as $indice=>$producto) {
          if ($producto['ID']==$ID) {
            //eliminar el registo de la sesion
            unset($_SESSION['CARRITO'][$indice]);
            //echo "<script>alert('Producto borrado');</script>";
            $_SESSION['CARRITO']=array_values($_SESSION["CARRITO"]); 

        }
      }
    }

      break;
  }
}
?>
