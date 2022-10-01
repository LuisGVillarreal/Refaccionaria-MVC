<?php
/**
 * Conexion a la base de datos
 */
class Database {
	public static function connect(){
		$db =  new mysqli('127.0.0.1', 'root', '', 'dbrefaccionaria_autos');
		$db->set_charset("utf8");
		return $db;
	}
}