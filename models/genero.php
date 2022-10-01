<?php 

/**
 * 
 */
class genero {
	private $id;
	private $genero;
	private $db;
	
	function __construct(){
		$this->db = Database::connect();
	}

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
        return $this;
    }

    public function getGenero(){
        return $this->genero;
    }
    public function setGenero($genero){
        $this->genero = $genero;
        return $this;
    }


     public function getAll(){
        $generos = $this->db->query("SELECT * FROM sexo;");
        return $generos;
    }
}
?>