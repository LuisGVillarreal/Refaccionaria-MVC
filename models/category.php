<?php 
/**
 * 
 */
class category {
	private $id;
	private $nombre;
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

    public function getNombre(){
        return $this->nombre;
    }
    public function setNombre($nombre){
        $this->nombre = $this->db->real_escape_string($nombre);
        return $this;
    }

    public function getAll(){
        $categories = $this->db->query("SELECT * FROM categories;");
        return $categories;
    }

    public function getOne(){
        $category = $this->db->query("SELECT * FROM categories WHERE id={$this->getId()};");
        return $category->fetch_object();
    }

    public function save(){
    	$sql = "INSERT INTO categories VALUES (NULL, '{$this->getNombre()}')";
    	$save = $this->db->query($sql);

    	$result = false;
    	if ($save) {
    		$result = true;
    	}
    	return $result;
    }
}
