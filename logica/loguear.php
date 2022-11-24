<?php
require 'Database.php';
session_start();
$usuario = $_POST['usuario'];
$password = $_POST['password'];

$query="SELECT COUNT(*) as contar from cliente WHERE usuario = '$usuario' and password='$password'";
$consulta = mysqli_query($conexion, $query);
$array = mysqli_fetch_array($consulta);

if ($array['contar']>0) {
  $_SESSION['user'] = $usuario;
  header("location: ../pro.php");
}
else {
  echo "Datos incorrectos";
}

?>
