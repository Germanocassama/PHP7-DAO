<?php 

require_once("config.php");

$sql = new sql();

$resultados = $sql->select("SELECT * FROM usuarios");

// Mostrar em formato JSON

echo json_encode($resultados);

 ?>