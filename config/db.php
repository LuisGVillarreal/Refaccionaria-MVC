<?php
/**
 * Conexion a la base de datos
 */
class Database {
	public static function connect(){
		$db =  new mysqli('bu6diejoetrowjajgwkp-mysql.services.clever-cloud.com', 'uo8xuk4gadd3xdnv', 'XuOIKNZMOC7ezYAkPuBE', 'bu6diejoetrowjajgwkp');
		$db->set_charset("utf8");
		return $db;
	}
}
