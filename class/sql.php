<?php 

class sql extends PDO {
	// esta classe já sabe fazer tudo que o PDO sabe fazer 
	//EX: bindPram(), prepare(), execute() e etc...
	private $conn;
	public function __construct(){
		$this->conn = new PDO("mysql:dbname=dbphp7; host=localhost", "root", "musquebalassana94");
	}

	// função para ligar parametros e pode ser reutilizado várias vezes dentro do nosso código
	private function setParams($statment, $parameters = array ()){

    foreach($parameters as $key => $value) {
    	
        $this->setParam($statment, $key, $value);
    }
}

	// Criar uma função para ser visível a este método 

	private function setParam($statment, $key, $value){
		$statment->bindParam($key, $value);
	}


	// executar os comandos no banco
	public function query($rawQuery, $param = array()){
 
    $stmt = $this->conn->prepare($rawQuery);
 
    $this->setParams($stmt, $param);
 
    $stmt->execute();
 
    return $stmt;
 
}

	/* criar a function select para selecionar os dados no bancoa*/
	public function select($rawQuery, $params = array()):array // este método returna um array
	{
			//  aqui chamamos a função query para executar está tarefa porque ele é uma função criado com este Obj
		$stmt = $this->query($rawQuery, $params);

		return $stmt->fetchAll(PDO::FETCH_ASSOC); /* executar tudo e mostrar dados associativos com PDO::FETCH_ASSOC, dados associativos */
	}
}

 ?>