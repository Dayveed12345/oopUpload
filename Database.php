<?php
class Database{
	private$pdo;
	public function connect($dbname){
		$this->pdo=new PDO("mysql:host=localhost;dbname=$dbname",'root','');
		return $this->pdo;
	}
}
?>