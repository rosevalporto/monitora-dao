<?php

class Sql extends PDO{

private $conn;

public function __construct(){
	$conn = new PDO("sqlsrv:Database=hemo;server=sql2;","**","*******"); // linha p conexao
}

private function setParams($statment, $parameters=array()){
	foreach ($parameters as $key => $value) {
		$this->setParam($key, $value);
	}
}

private function setParam($statment, $key, $value){
	$statment->baindParam($key, $value);
}

 public function query($rawQuery, $params =array()){
 	// $stmt= $conn->prepare(
 	$stmt = $this->$conn->prepare($rawQuery);
 	$this->setParams($stmt,$params);
 	$stmt->execute();
 	return $stmt;
 }

public function select($rawQuery,$params=array()):array
{
$stmt=$this->query($rawQuery,$params);
return $stmt->fetchAll(PDO::FETCH_ASSOC);

}
}

?>