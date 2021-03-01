<?php
namespace db;

class Sql {

	const HOSTNAME = "localhost";
	const USERNAME = "servidor";
	const PASSWORD = "Nv32125";
	const DBNAME = "obv";

	private $conn;

	public function __construct()
	{

		$this->conn = new \PDO(
			"mysql:dbname=".Sql::DBNAME.";host=".Sql::HOSTNAME,
			Sql::USERNAME,
			Sql::PASSWORD
		);

	}


	private function setParams($statement, $parameters = array())
	{

		foreach ($parameters as $key => $value) {

			$this->bindParam($statement, $key, $value);

		}

	}

	private function bindParam($statement, $key, $value)
	{

		$statement->bindParam($key, $value);

	}

	public function query($rawQuery, $params = array())
	{
		$lstId=0;
		// $this->conn->beginTransaction();
		$stmt = $this->conn->prepare($rawQuery);
		$this->setParams($stmt, $params);
		$stmt->execute();
		$lstId 	= $this->conn->lastInsertId();//ultimo ID inserido
		$rowC 	= $stmt->rowCount();//linhas afetadas na query
		$eMsg		= $stmt->errorInfo();//error message


		if ($eMsg[1]>1) {
		  return $eMsg;
		}else{
      
      //se rotina de INSERT então retornar o last ID
			if(strstr(strtoupper($rawQuery),"INSERT")){
				return $lstId;
      //caso update delete ou select retorna o num de linhas afetadas
			}else{
				return $rowC;
			}

		}

	}

	public function select($rawQuery, $params = array()):array
	{

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		if (!$stmt->execute()) {
		    print_r($stmt->errorInfo());
		}else{
			return $stmt->fetchAll(\PDO::FETCH_ASSOC);
		}

	}



}

 ?>
