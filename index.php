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
/*
$usuario = new usuario();
$usuario->login("email@guine.com","4f00G9");
echo $usuario;
*/
/*
//Criando um novo usuário
$aluno = new Usuario("empresa@gb.com", "1238jhfs");
$aluno->insert();
echo $aluno;
*/

//Atualizar dados 
/*
$usuario = new usuario();
$usuario->carregaPorId(8);
$usuario->update("professor", "senhaProf");
echo $usuario;
*/

// Apagar usuario
$usuario = new usuario();
$usuario->carregaPorId(7);
$usuario->delete();
echo $usuario;



 ?>