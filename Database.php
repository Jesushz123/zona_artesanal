<?php
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'zonartesanal';

try {
  $conn = new PDO("mysql:host=$server;dbname=$database;",$username, $password);

} catch (PDOException $error) {
  die ('conexion fallida: ' .$error-> getMessage());
}


?>
