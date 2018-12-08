<?php 

require_once("config.php");
/*
$sql = new sql();
$resultados = $sql->select("SELECT * FROM usuarios");
echo json_encode($resultados);
*/
$germano = new usuario();

$germano->carregaPorId(9);

echo $germano; 

 ?>