
<?php
require 'Global/conecc.php';
session_start();

//Iniciar sesion

if (!empty($_POST)) {
  $usuario = mysqli_real_escape_string($conn,$_POST['usuario']);
  $password = mysqli_real_escape_string($conn,$_POST['password']);
  $password_encriptada = sha1($password);

  $sql= "SELECT Id_cliente FROM cliente
  WHERE usuario= '$usuario' AND password='$password_encriptada'";

  $resultado =$conn->query($sql);
  $rows=  $resultado->num_rows;
  if ($rows>0) {
    $row=$resultado->FETCH_ASSOC();

  $_SESSION['user'] = $usuario;
      header("location: pro.php");
  }else {
    echo "<script>alert('Usuario o password incorrecto');</script>";
  }

}

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Iniciar sesion</title>
  <link rel="stylesheet" type="text/css" href="Assets/css/estilos2.css">
  </head>
  <body>
    <div>
      <center>
        <img src="Assets/img/logo.png" height="500" width="900">
      </center>
      
    </div>
    <div id="columnas">
      <h1>Iniciar sesión</h1>
      <span> o <a href="Registro.php"> Registro </a></span>
    <center>
      <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">
        <h1>Ingresa su nombre de usuario</h1>
        <input type="text" name="usuario" placeholder="Ingresa tu usuario" required/>
        <br><br>
        <h1>Ingresa tu contraseña</h1>
        <input type="password" name= "password" placeholder="Ingresa tu contraseña" required/>
        <br><br>
        <input type="submit" name="Ingresar" value="Ingresar">
      </form>
    </center>
</div>
  </body>
</html>
