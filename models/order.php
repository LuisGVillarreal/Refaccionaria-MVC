<?php 
class order {
	private $id;
	private $user_id;
	private $costo;
	private $estado_pedido;
	private $estado;
	private $ciudad;
	private $cp;
    private $colonia;
    private $calle;
    private $n_int;
    private $n_ext;
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
	
	public function getUserId(){
        return $this->user_id;
    }
    public function setUserId($user_id){
        $this->user_id = intval($this->db->real_escape_string($user_id));
        return $this;
    }

    public function getCosto(){
        return $this->costo;
    }
    public function setCosto($costo){
        $this->costo = $this->db->real_escape_string($costo);
        return $this;
    }

	public function getEstadoPedido(){
        return $this->estado_pedido;
    }
    public function setEstadoPedido($estado_pedido){
        $this->estado_pedido = $this->db->real_escape_string($estado_pedido);
        return $this;
    }

    public function getEstado(){
        return $this->estado;
    }
    public function setEstado($estado){
        $this->estado = $this->db->real_escape_string($estado);
        return $this;
    }

    public function getCiudad(){
        return $this->ciudad;
    }
    public function setCiudad($ciudad){
        $this->ciudad = $this->db->real_escape_string($ciudad);
        return $this;
    }

    public function getCP(){
        return $this->cp;
    }
    public function setCP($cp){
        $this->cp = $this->db->real_escape_string($cp);
        return $this;
    }

    public function getColonia(){
        return $this->colonia;
    }
    public function setColonia($colonia){
        $this->colonia = $this->db->real_escape_string($colonia);
        return $this;
    }

    public function getCalle(){
        return $this->calle;
    }
    public function setCalle($calle){
        $this->calle = $this->db->real_escape_string($calle);
        return $this;
    }

    public function getNInt(){
        return $this->n_int;
    }
    public function setNInt($n_int){
        $this->n_int = $this->db->real_escape_string($n_int);
        return $this;
    }

    public function getNExt(){
        return $this->n_ext;
    }
    public function setNExt($n_ext){
        $this->n_ext = $this->db->real_escape_string($n_ext);
        return $this;
    }

    /*----------------------Funciones------------- */
    public function getAll(){
        $orders = $this->db->query("SELECT * FROM orders ORDER BY id DESC");
        return $orders;
    }

    public function getOne(){
        $order = $this->db->query("SELECT * FROM orders WHERE id={$this->getId()}");
        return $order->fetch_object();
    }

    public function getOneByUser(){
        $sql = "SELECT o.id, o.costo FROM orders o "
                ."WHERE user_id={$this->getUserId()} ORDER BY id DESC LIMIT 1";
        $order = $this->db->query($sql);
        return $order->fetch_object();
    }

    public function getAllByUser(){
        $sql = "SELECT o.* FROM orders o "
                ."WHERE user_id={$this->getUserId()} ORDER BY id DESC";
        $order = $this->db->query($sql);
        return $order;
    }

    public function getProductsByOrder($order_id){
        $sql = "SELECT pr.*, po.unidades FROM products pr "
                ."INNER JOIN products_orders po ON pr.id = po.product_id "
                ."WHERE po.order_id={$order_id}";
        $products = $this->db->query($sql);
        return $products;
    }

    public function save(){
    	$sql = "INSERT INTO orders VALUES (NULL, {$this->getUserId()}, {$this->getCosto()}, 'Confirm', NULL, '{$this->getEstado()}', '{$this->getCiudad()}', {$this->getCP()}, '{$this->getColonia()}','{$this->getCalle()}',{$this->getNInt()},{$this->getNExt()})";
    	$save = $this->db->query($sql);
        
    	$result = false;
    	if ($save) {
    		$result = true;
    	}
    	return $result;
    }

    public function saveProductsOrders(){
        $sql = "SELECT LAST_INSERT_ID() as 'orderId';";
        $query = $this->db->query($sql);
        $orderId = $query->fetch_object()->orderId;
        foreach ($_SESSION['cart'] as $value){
            $product = $value['product'];
            $stock = ($product->stock)-($value['amount']);
            $insert = "INSERT INTO products_orders VALUES (NULL, {$orderId},{$product->id},{$value['amount']})";
            $save = $this->db->query($insert);
            
            $updateStock = "UPDATE products SET stock={$stock}"; 
            $updateStock .=" WHERE id={$product->id};";
            $save = $this->db->query($updateStock);    
        }
        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    public function update(){
        $sql = "UPDATE orders SET estado_pedido='{$this->getEstadoPedido()}'"; 
        $sql .=" WHERE id={$this->getId()};";
        
        $save = $this->db->query($sql);    
        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

}//FIN CLASE