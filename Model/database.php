<?php

class Database{

	public static function Conectar () {

		$pdo = new PDO('mysql:host=localhost;dbname=bdd_test;charset=utf8','root','');

$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); //se encarga de enviar el error 

return $pdo;

}

}