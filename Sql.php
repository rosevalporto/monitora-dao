<?php

class Sql extends PDO{
	private static $_instance;
	private $_connection;
	private $DB_host = "localhost";
	private $DB_user_name = "sa";
	private $DB_user_password = "123";
	private $DB_driver = "sqlsrv";
	private $DB_database = "hemo";

	public static function init() {
		try {
			if (is_null(self::$_instance) || empty(self::$_instance)) {
				self::$_instance = new self();
				return self::$_instance;
			}else{
				return self::$_instance;
			}
		} catch (Exception $e) {
			return self::class;
		}
	}
	
	function __construct()
	{
		try {
			if (is_null($this->_connection) || empty($this->_connection)) {
				$this->_connection = new \PDO($this->DB_driver.':server='.$this->DB_host.';Database='.$this->DB_database, $this->DB_user_name, $this->DB_user_password);
			}
		} catch (Exception $e) {
			$this->_connection = $e;
			echo $e->getMessage();
		}
	}
	
	public function connect()
	{
		return $this->_connection ? $this->_connection : null;
	}
	

private function setParams($statment, $parameters=array()){
	foreach ($parameters as $key => $value) {
		$this->setParam($key, $value);
	}
}

private function setParam($statment, $key, $value){
	$statment->bindParam($key, $value);
}


public function pesquisa($q){
	$stmt = $_connection->query($q);
	return $stmt->execute();
}

 public function query($rawQuery, $params =array()){
 	$stmt = $conn->prepare($rawQuery);
 	//$this->setParams($stmt,$params);
 	return $stmt->execute();
 }

public function select($rawQuery,$params=array()):array{
	$stmt=$this->query($rawQuery,$params);
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}

?>