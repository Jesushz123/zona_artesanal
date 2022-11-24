<?php
include("config.php");
$conn = new mysqli($server,$user,$password,$bd);
if (mysqli_connect_errno()) {
  //echo "No conectado, mysqli_connect_error";
exit();
}
else {
  //echo "Conectado";
}
 ?>
