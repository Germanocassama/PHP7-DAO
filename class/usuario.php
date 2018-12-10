<?php 


class usuario{

	// campos da tabela no banco de dados 
	private $id;
	private $email;
	private $senha;
	private $dtcadastro;
	////////////////////////////////
	public function getId(){
		return $this->id;
	}
	public function setId($value){
		$this->id = $value;
	}
	//////////////////////////////////
	public function getEmail(){
		return $this->email;
	}
	public function setEmail($value){
		$this->email = $value;
	}
	////////////////////////////////////
	public function getSenha(){
		return $this->senha;
	}
	public function setSenha($value){
		$this->senha = $value;
	}
	//////////////////////////////////////
	public function getDtcadastro(){
		return $this->dtcadastro;
	}
	public function setDtcadastro($value){
		$this->dtcadastro = $value;
	}
	////////////////////////////////////////////
	// função para inserir os dados 
	public function setDados($dados){
		$this->setId($dados['id']);
			$this->setEmail($dados['email']);
			$this->setSenha($dados['senha']);
			$this->setDtcadastro(new dateTime($dados['dtcadastro']));
	}
	///////////////////////////////////////////////////////////////////////
	// Função para ler os dados na base de dados 
	public function carregaPorId($id){
		$sql = new sql();

		$results = $sql->select("SELECT * FROM usuarios WHERE id = :id", array(
			":id"=>$id
		));

		// se existe alguma coisa no banco que maior que zero conta
		if(count($results) > 0){

			$this->setDados($results[0]);
		}
	}

	// Listar usuarios no banco de dados
	// static --> cramos getList com Static para quando precisarmos chama lo fora do escopo 
	public static function getList(){
		$sql = new sql();

		return $sql->select("SELECT * FROM usuarios ORDER BY email;");

	}

	// Procurar por email
	public static function search($email){
		$sql = new sql(); // instanciar a classe sql do banco
		return $sql->select("SELECT * FROM usuarios WHERE email LIKE :SAERCH ORDER BY email", array(
			':SAERCH'=>"%".$email."%"
		));
	}

	// Obter dados do usuario autenticado
	function login($email, $senha){// primeiro precisamos aceder os dados dos usuarios 
		$sql = new sql();

		$results = $sql->select("SELECT * FROM usuarios WHERE email = :email AND senha = :senha", array(
			":email"=>$email,
			":senha"=>$senha
		));
		if(count($results) > 0){
			$this->setDados($results[0]);			
		}else{
			throw new Exception("login e/ou email invalidade!");			
		}

	}

	// criar função insert()
	public function insert(){
		$sql = new Sql();
		// criar procedure. Função para enviar e receber o id de ultimos dados enviado para DB
		$results = $sql->select("CALL sp_usuarios_insert(:email, :senha)", array(
			':email'=>$this->getEmail(),
			':senha'=>$this->getsenha()
		));
		if (count($results) > 0) {
			$this->setDados($results[0]);
		}
	}

	 // Atualizar dados no banco
	// Primeiro precisamos receber os dados para depois fazer atualização
	public function update($email, $senha){
		$this->setEmail($email);
		$this->setSenha($senha);
		///////////////////////////////////////////////////////
		$sql = new sql();
		$sql->query("UPDATE usuarios SET email = :email, senha = :senha WHERE id = :id", array(
			':email'=>$this->getEmail(),
			':senha'=>$this->getSenha(),
			'id'=>$this->getId()
		));
	}

	// criar construtor mágico para receber  email e a senha na mesma linha
	//  se não passar nada ele retorna fazio
	public function __construct($email = "", $senha = ""){
		$this->setEmail($email);
		$this->setSenha($senha);
	}

	// Apagar dados 
	public function delete(){
		$sql = new sql();

		$sql->query("DELETE FROM usuarios WHERE id = :id", array(
			'id'=>$this->getId()
		));

		 $this->setId(0);
		$this->setEmail("");
		$this->setSenha("");
		$this->setDtcadastro(new DateTime());
	}


	// Retornar só os dados 
	public function __toString(){	
		return json_encode(array( // Retornar os dados em formato JSON
			"id"=>$this->getId(),
			"email"=>$this->getEmail(),
			"senha"=>$this->getSenha(),
			"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
		));
	}
}


 ?>