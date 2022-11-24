<?php

$server = 'localhost';
$username = 'root';
$password = '';
$database = 'zonartesanal';

/*$servidor="mysql:dbname=".BD.";host".SERVIDOR;*/
define("KEY","ZonArtesanal");
define("COD","AES-128-ECB");
try {
  $conn = new PDO("mysql:host=$server;dbname=$database;",$username, $password);
//$conn= new PDO($servidor,USUARIO,PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
//echo "<script>alert('Base de datos conectada')</script>";
} catch (PDOException $error) {
  die ('conexion fallida: ' .$error-> getMessage());
}


?>
