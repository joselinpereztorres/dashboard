<?php 

	class InstallModel{

	static private $link = null;

	static public function infoDatabase(){

		return [
			"host" => "localhost",
			"database" => "laboratorio",
			"user" => "root",
			"pass" => ""
		];

	}

	static public function conexion(){

		if(self::$link === null){

			$db = self::infoDatabase();

			try{

				self::$link = new PDO(
					"mysql:host={$db["host"]};dbname={$db["database"]}",
					$db["user"],
					$db["pass"],
					[
						PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
						PDO::ATTR_PERSISTENT => true
					]
				);

				self::$link->exec("SET NAMES utf8");

			}catch(PDOException $e){

				die("Error: ".$e->getMessage());
			}
		}

		return self::$link;
	}

}
?>