<?php 
class log {
	private $id;
	private $user_id;
	private $conexion;
	private $db;
	
	function __construct(){
		$this->db = Database::connect();
	}

	public function getId() {
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
        $this->user_id = $user_id;

        return $this;
    }

    public function getConexion(){
        return $this->conexion;
    }

    public function setConexion($conexion){
        $this->conexion = $conexion;
        return $this;
    }

    public function getAll(){
        $logs = $this->db->query("SELECT user_id,u.nombre,u.a_paterno,u.a_materno,u.email,conexion FROM logs l INNER JOIN users u ON l.user_id = u.id ORDER BY conexion DESC");
        return $logs;
    }

    public function getOne(){
        $sql = "SELECT * FROM logs WHERE user_id ={$this->user_id}";
        $log = $this->db->query($sql);
        $result = false;

        if ($log && $log->num_rows == 1) {
            $result = true;
        }
        return $result;
    }

    public function save(){
        $sql = "INSERT INTO logs VALUES (NULL, {$this->getUserId()}, NULL)";
        $save = $this->db->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    public function update(){
        $sql = "UPDATE logs SET conexion=now() WHERE user_id={$this->user_id};";
        $save = $this->db->query($sql);
        
        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    public function delete(){
       $sql = "DELETE FROM logs WHERE user_id={$this->user_id}";
       $delete = $this->db->query($sql);
       $result = false;
        if ($delete) {
            $result = true;
        }
        return $result;
    }
}//FIN CLASE