<?php 
class product {
	private $id;
	private $category_id;
	private $nombre;
	private $descripcion;
	private $precio;
	private $stock;
	private $iva;
	private $img;
	private $db;

	public function __construct(){
		$this->db = Database::connect();
	}

	public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
        return $this;
    }
	
	public function getCategoryId(){
        return $this->category_id;
    }
    public function setCategoryId($category_id){
        $this->category_id = intval($this->db->real_escape_string($category_id));
        return $this;
    }

    public function getNombre(){
        return $this->nombre;
    }
    public function setNombre($nombre){
        $this->nombre = $this->db->real_escape_string($nombre);
        return $this;
    }

	public function getDescripcion(){
        return $this->descripcion;
    }
    public function setDescripcion($descripcion){
        $this->descripcion = $this->db->real_escape_string($descripcion);
        return $this;
    }

    public function getPrecio(){
        return $this->precio;
    }
    public function setPrecio($precio){
        $this->precio = $this->db->real_escape_string($precio);

        return $this;
    }

    public function getStock(){
        return $this->stock;
    }
    public function setStock($stock){
        $this->stock = intval($this->db->real_escape_string($stock));
        return $this;
    }

    public function getIva(){
        return $this->iva;
    }

    public function setIva($iva){
        $this->iva = $this->db->real_escape_string($iva);
        return $this;
    }

    public function getImg(){
        return $this->img;
    }
    public function setImg($img){
        $this->img = $this->db->real_escape_string($img);
        return $this;
    }

    public function getAll(){
        $products = $this->db->query("SELECT * FROM products ORDER BY id DESC");
        return $products;
    }

    public function getAllCategory(){
        $sql = "SELECT p.*, c.nombre as 'catNombre' FROM products p "
                ." INNER JOIN categories c ON c.id = p.category_id "
                ."WHERE p.category_id = {$this->getCategoryId()} AND p.stock>0 "
                ."ORDER BY id DESC";
        $products = $this->db->query($sql);
        return $products;
    }

    public function getRandom($limit){
        $products = $this->db->query("SELECT * FROM products  WHERE stock>0 ORDER BY RAND() LIMIT $limit");
        return $products;
    }

    public function getOne(){
        $product = $this->db->query("SELECT * FROM products WHERE id={$this->getId()}");
        return $product->fetch_object();
    }

    public function save(){
    	$sql = "INSERT INTO products VALUES (NULL, {$this->getCategoryId()},'{$this->getNombre()}', '{$this->getDescripcion()}', {$this->getPrecio()}, {$this->getStock()}, 0.16, NULL, '{$this->getImg()}')";
    	$save = $this->db->query($sql);
        
    	$result = false;
    	if ($save) {
    		$result = true;
    	}
    	return $result;
    }


    public function edit(){
        $sql = "UPDATE products SET category_id={$this->getCategoryId()}, nombre='{$this->getNombre()}', descripcion='{$this->getDescripcion()}', precio={$this->getPrecio()}, stock={$this->getStock()}"; 
        if ($this->getImg() != null) {
            $sql .=",img='{$this->getImg()}'";
        }
        $sql .=" WHERE id={$this->id};";

        $save = $this->db->query($sql);    
        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    public function delete(){
       $sql = "DELETE FROM products WHERE id={$this->id}";
       $delete = $this->db->query($sql);
       $result = false;
        if ($delete) {
            $result = true;
        }
        return $result;
    }
}//FIN CLASE