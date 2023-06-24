<?php
/**
 * Conexion a la base de datos
 */
class Database {
	public static function connect(){
		$db =  new mysqli('https://databases-auth.000webhost.com', 'id20952305_root', 'abX&}HHXcIxWlK!5', 'id20952305_dbrefaccionaria_autos');
		$db->set_charset("utf8");
		return $db;
	}
}
