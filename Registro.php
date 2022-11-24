<?php
require 'Global/conecc.php';
$message ='';


if (isset($_POST["Registrar"])) {
$correo = mysqli_real_escape_string($conn,$_POST['correo']);
$usuario = mysqli_real_escape_string($conn,$_POST['usuario']);
$password = mysqli_real_escape_string($conn,$_POST['password']);
$password_encriptada = sha1($password);
$municipio = mysqli_real_escape_string($conn,$_POST['municipio']);
$calle_con_numero = mysqli_real_escape_string($conn,$_POST['calle_con_numero']);
$codigo_postal = mysqli_real_escape_string($conn,$_POST['codigo_postal']);

$sql="SELECT id_cliente FROM cliente WHERE usuario='$usuario'";

$resultadouser = $conn->query($sql);
$filas=$resultadouser->num_rows;
if ($filas>0) {
  echo "<script> alert('El usuario ya existe') </script>";
}
else {
  $sqlusuario = "INSERT INTO cliente(usuario,	correo,	password,	municipio,	calle_con_numero, codigo_postal)
  VALUES('$usuario', '$correo','$password_encriptada','$municipio','$calle_con_numero','$codigo_postal')";
  $resultadousuario= $conn->query($sqlusuario);
  if ($resultadousuario>0) {
    echo "<script> alert('Registro exitoso')</script>";
  }
  else {
    echo "<script> alert('No se registo');</script>";
    }
  }
}


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Registro</title>
  <link rel="stylesheet" type="text/css" href="Assets/css/estilos2.css">
  </head>
  <body>
    <div>
      <center>
        <img src="Assets/img/logo.png" height="500" width="900">
      </center>
    </div>
<div id="columnas">
  <h1>Registro</h1>
  <span> o <a href="login.php"> Inicia sesión </a></span>
<center>
  <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="post">
    <h2>Ingresa tu correo</h2>
            <input type="text" name="correo" placeholder="Ingresa tu correo">
<h2>Ingresa tu nombre de usuario</h2>
    <input type="text" name="usuario" placeholder="Ingresa tu nombre de usuario">

<h2>Ingresa tu contraseña</h2>
        <input type="password" name="password" placeholder="Ingresa tu contraseña">
<h2>Confirma tu contraseña</h2>
    <input type="password" name="passwordr" placeholder="Confirma tu contraseña">
<h2>Ingresa tu municipio</h2>
    <input type="text" name="municipio" placeholder="Ingresa tu municipio">
<h2>Ingresa tu calle</h2>
    <input type="text" name="calle_con_numero" placeholder="Ingresa tu calle">
<h2>Ingresa tu codigo_postal</h2>
     <input type="number" name="codigo_postal" placeholder="Ingresa tu codigo postal">

    <p></p>

    <input type="submit" name="Registrar" value="Registrar">
  </form>
  </center>
</div>
<div class="container">
<center>
<?php if (!empty($message)):?>
<p> <?= $message ?> </p>
<?php endif;   ?>
</center>
</div>
</body>
</html>
