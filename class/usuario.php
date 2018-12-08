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

		// Enquanto os dados são maior que zero conta
		if(count($results) > 0){

			$row = $results[0];

			$this->setId($row['id']);
			$this->setEmail($row['email']);
			$this->setSenha($row['senha']);
			$this->setDtcadastro(new dateTime($row['dtcadastro']));
		}
	}

	// Retornar só os dados 
	public function __toString(){
		// Retirnar em formato JSON
		return json_encode(array(

			"id"=>$this->getId(),
			"email"=>$this->getEmail(),
			"senha"=>$this->getSenha(),
			"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
		));
	}
}


 ?>