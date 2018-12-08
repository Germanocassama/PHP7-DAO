<?php 

require_once("config.php");
// carrega só uma lista
/*
$germano = new usuario();
$germano->carregaPorId(10);

echo $germano; 
*/
// Listar todos
/*
$lista = usuario::getList();

echo json_encode($lista);
*/

// usuario filtrado por email
/*
$search = usuario::search("ger");
echo json_encode($search);
*/
// carrega usuario usando login email e senha

$usuario = new usuario();
$usuario->login("email@guine.com","4f00G9");
echo $usuario;

 ?>