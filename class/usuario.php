<?php 


class usuario{

	// campos da tabela no banco de dados 
	private $id;
	private $email;
	private $senha;
	private $dtcadastro;

	public function getId(){
		return $this->id;
	}
	public function setId($value){
		$this->id = $value;
	}

	public function getEmail(){
		return $this->email;
	}
	public function setEmail($value){
		$this->email = $value;
	}

	public function getSenha(){
		return $this->senha;
	}
	public function setSenha($value){
		$this->senha = $value;
	}

	public function getDtcadastro(){
		return $this->dtcadastro;
	}
	public function setDtcadastro($value){
		$this->dtcadastro = $value;
	}

	// Função para ler os dados na base de dados 
	public function carregaPorId($id){
		$sql = new sql();

		$results = $sql->select("SELECT * FROM usuarios WHERE id = :id", array(
			":id"=>$id
		));

		// se existe alguma coisa no banco que maior que zero conta
		if(count($results) > 0){

			$row = $results[0];

			$this->setId($row['id']);
			$this->setEmail($row['email']);
			$this->setSenha($row['senha']);
			$this->setDtcadastro(new dateTime($row['dtcadastro']));
		}
	}

	// Listar usuarios no banco de dados
	// static --> quando precisarmos chama lo fora do escopo podemos
	public static function getList(){
		$sql = new sql();

		return $sql->select("SELECT * FROM usuarios ORDER BY email;");

	}

	// Procurar 
	public static function search($email){
		$sql = new sql();
		return $sql->select("SELECT * FROM usuarios WHERE email LIKE :SAERCH ORDER BY email", array(
			':SAERCH'=>"%".$email."%"
		));
	}

	// Obter dados do usuario autenticado
	function login($email, $senha){
		$sql = new sql();

		$results = $sql->select("SELECT * FROM usuarios WHERE senha = :senha AND senha = :senha", array(
			":senha"=>$senha,
			":senha"=>$senha
		));
		if(count($results) > 0){

			$row = $results[0];

			$this->setId($row['id']);
			$this->setEmail($row['email']);
			$this->setSenha($row['senha']);
			$this->setDtcadastro(new dateTime($row['dtcadastro']));
		}else{
			throw new Exception("login e/ou email invalidade!");
			
		}

	}

	// Retornar só os dados 
	public function __toString(){
		
		// Retornar em formato JSON
		return json_encode(array(

			"id"=>$this->getId(),
			"email"=>$this->getEmail(),
			"senha"=>$this->getSenha(),
			"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
		));
	}
}


 ?>