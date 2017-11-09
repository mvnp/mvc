<?php

class Database
{
	public $pdo;
	
	public function init()
	{
		$hostname = 'localhost';
		$dbname = 'php_mvc';
		$username = 'root';
		$password = '';
		try {
			$this->pdo = new PDO('mysql:host='.$hostname.';dbname='.$dbname, $username, $password, array(
				PDO::ATTR_PERSISTENT => true
			));
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e){
			throw new Exception("Ga bisa connect ke database");
		}
	}
}