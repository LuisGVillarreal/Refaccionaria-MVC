<?php
require_once 'log.php';
class user {
	private $id;
	private $nombre;
	private $aPaterno;
	private $aMaterno;
	private $edad;
	private $sexo;
	private $email;
	private $password;
	private $rol;
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

    public function getNombre(){
        return $this->nombre;
    }
    public function setNombre($nombre){
        $this->nombre = $this->db->real_escape_string($nombre);
        return $this;
    }

    public function getPaterno(){
        return $this->aPaterno;
    }
    public function setPaterno($aPaterno){
        $this->aPaterno = $this->db->real_escape_string($aPaterno);

        return $this;
    }

    public function getMaterno(){
        return $this->aMaterno;
    }
    public function setMaterno($aMaterno){
        $this->aMaterno = $this->db->real_escape_string($aMaterno);
        return $this;
    }

    public function getEdad(){
        return $this->edad;
    }
    public function setEdad($edad){
        $this->edad =  intval($this->db->real_escape_string($edad));
        return $this;
    }

    public function getSexo(){
        return $this->sexo;
    }
    public function setSexo($sexo){
        $this->sexo =  intval($this->db->real_escape_string($sexo));
        return $this;
    }

    public function getEmail(){
        return $this->email;
    }
    public function setEmail($email){
        $this->email = $this->db->real_escape_string($email);
        return $this;
    }

    public function getPassword(){
        return password_hash($this->db->real_escape_string($this->password),PASSWORD_BCRYPT,['cost' => 4]);
    }
    public function setPassword($password){
        $this->password = $password;
        return $this;
    }

    public function getRol(){
        return $this->rol;
    }
    public function setRol($rol){
        $this->rol = $rol;
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
        $users = $this->db->query("SELECT u.id,nombre,a_paterno,a_materno,edad,genero,email,img FROM users u INNER JOIN sexo s ON s.id = u.sexo_id ORDER BY u.id DESC");
        return $users;
    }

    public function getLastId(){
        $id = 0;
        $rs = $this->db->query("SELECT MAX(id) AS id FROM users");
        if ($row = mysqli_fetch_row($rs)) {
            $id = trim($row[0]);
        }
        return $id;
    }

    public function getOne(){
        $user = $this->db->query("SELECT * FROM users WHERE id={$this->getId()}");
        return $user->fetch_object();
    }

    public function edit(){
        $sql = "UPDATE users SET nombre='{$this->getNombre()}', a_paterno='{$this->getPaterno()}', a_materno='{$this->getMaterno()}', edad={$this->getEdad()}, sexo_id={$this->getSexo()}"; 
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
        $log = new log();
        $log->setUserId($this->getId());
        if ($log->getOne()) {
            $log->delete();
        }
        $sql = "DELETE FROM users WHERE id={$this->getId()}";
        $delete = $this->db->query($sql);
        $result = false;
        if ($delete) {
            $result = true;
        }
        return $result;
    }


    public function save(){
    	$sql = "INSERT INTO users VALUES (NULL, '{$this->getNombre()}','{$this->getPaterno()}','{$this->getMaterno()}',{$this->getEdad()},{$this->getSexo()},'{$this->getEmail()}','{$this->getPassword()}',NOW(),1,'{$this->getImg()}')";
    	$save = $this->db->query($sql);

    	$result = false;
    	if ($save) {
    		$result = true;
    	}
    	return $result;
    }

    public function logOn(){
        $email = $this->email;
        $password = $this->password;
        $sql = "SELECT * FROM users WHERE email ='$email'";
        $log = $this->db->query($sql);
        $result = false;

        if ($log && $log->num_rows == 1) {
             $user = $log->fetch_object();
             $verify = password_verify($password, $user->password);
             if ($verify) {
                $result = $user;
             }
        }
        return $result;
    }
}//FIN CLASE
