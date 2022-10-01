<?php
require_once 'models/user.php';
require_once 'models/log.php';
class userController {

	public function signUp() {
		if (isset($_SESSION['identity'])) {
			header('Location:'.base_url);
		}else{
			require_once 'views/user/signUp.php';
		}
	}

	public function logIn()	{
		if (isset($_SESSION['identity'])) {
			header('Location:'.base_url);
		}else{
			require_once 'views/user/logIn.php';
		}
	}

	public function gestion(){
		utils::isAdmin();
		$user = new user();
		$users = $user->getAll();
		require_once 'views/user/gestion.php';
	}

	public function logs(){
		utils::isAdmin();
		$log = new log();
		$logs = $log->getAll();
		require_once 'views/user/logs.php';
	}

	public function edit(){
		utils::isAdmin();
		$edit = true;
		if(isset($_GET['id'])){
			$id = $_GET['id'];	
			$user = new user();
			$user->setId($id);
			$u = $user->getOne();

			require_once 'views/user/create.php';
		}
		else{
			header("Location:".base_url.'user/gestion');
		}
	}

	public function editSave()	{
		if (isset($_POST)) {
			$name = isset($_POST["nombre"]) ? $_POST["nombre"] : false;
			$Paterno = isset($_POST["aPaterno"]) ? $_POST["aPaterno"] : false;
			$Materno = isset($_POST["aMaterno"]) ? $_POST["aMaterno"] : false;
			$Edad = isset($_POST["edad"]) ? $_POST["edad"] : false;
			$Sexo = isset($_POST['sexo']) ? $_POST['sexo'] : false;

			if ($name && $Paterno && $Materno && $Edad && isset($_GET['id'])) {
				$id = $_GET['id'];
				$user = new user();
				$user->setId($id);
				$user->setNombre($name);
				$user->setPaterno($Paterno);
				$user->setMaterno($Materno);
				$user->setEdad($Edad);
				$user->setSexo($Sexo);
				$u = $user->getOne();
				if (isset($_FILES['foto'])) {
					$file = $_FILES['foto'];
					$filename = $u->img;
					$mimetype = $file['type'];
					
					if (($mimetype=='image/jpg') || ($mimetype=='image/jpeg') || ($mimetype=='image/png') || ($mimetype=='image/gif')) {
						if (!is_dir('uploads/users')) {
							mkdir('uploads/users',0777, true);
						}
						$user->setImg($filename);
						move_uploaded_file($file['tmp_name'], 'uploads/users/'.$filename);
					}
				}
				$save = $user->edit();
				if ($save) {
					$_SESSION['user'] = 'complete';
				}else{
					$_SESSION['user'] = 'failed';
				}
			}else{
				$_SESSION['user'] = 'failed';
			}
		}else{
			$_SESSION['user'] = 'failed';
		}
		header("Location:".base_url.'user/gestion');
	}

	public function delete(){
		utils::isAdmin();
		if(isset($_GET['id'])){
			$id = $_GET['id'];	
			$user = new user();
			$user->setId($id);
			$u = $user->getOne();
			$delete = $user->delete();
			unlink('uploads/users/'.$u->img);
			if ($delete) {
				$_SESSION['delete'] = 'complete';
			}
			else{
				$_SESSION['delete'] = 'failed';
			}
		}else{
			$_SESSION['delete'] = 'failed';
		}
		header("Location:".base_url.'user/gestion');
	}

	public function save()	{

		if (isset($_POST)) {
			$name = isset($_POST["nombre"]) ? $_POST["nombre"] : false;
			$Paterno = isset($_POST["aPaterno"]) ? $_POST["aPaterno"] : false;
			$Materno = isset($_POST["aMaterno"]) ? $_POST["aMaterno"] : false;
			$Edad = isset($_POST["edad"]) ? $_POST["edad"] : false;
			$Sexo = isset($_POST["sexo"]) ? $_POST["sexo"] : false;
			$Email = isset($_POST["email"]) ? $_POST["email"] : false;
			$Password = isset($_POST["password"]) ? $_POST["password"] : false;

			if ($name && $Paterno && $Materno && $Edad && $Sexo && $Email && $Password) {
				$user = new user();
				$user->setNombre($name);
				$user->setPaterno($Paterno);
				$user->setMaterno($Materno);
				$user->setEdad($Edad);
				$user->setSexo($Sexo);
				$user->setEmail($Email);
				$user->setPassword($Password);
				if (isset($_FILES['foto'])) {
					$file = $_FILES['foto'];
					$filename = 'user_'.rand().'.png'; 
					$mimetype = $file['type'];
					
					if (($mimetype=='image/jpg') || ($mimetype=='image/jpeg') || ($mimetype=='image/png') || ($mimetype=='image/gif')) {
						if (!is_dir('uploads/users')) {
							mkdir('uploads/users',0777, true);
						}
						//$user->setImg($filename);
						move_uploaded_file($file['tmp_name'], 'uploads/users/'.$filename);
					}
				}
				$save = $user->save();
				if ($save) {
					$_SESSION['register'] = 'complete';
				}else{
					$_SESSION['register'] = 'failed';
				}
			}else{
				$_SESSION['register'] = 'failed';
			}
		}else{
			$_SESSION['register'] = 'failed';
		}
		var_dump($_SESSION['register']);
		header("Location:".base_url.'user/signUp');
	}

	public function logOn(){
		if (isset($_POST)) {
			$user = new user();
			$user->setEmail($_POST["email"]);
			$user->setPassword($_POST["password"]);
			$identity = $user->logOn();

			if ($identity && is_object($identity)) {
				$_SESSION['identity'] = $identity;
				$log = new log();
				$log->setUserId($identity->id);
				if ($identity->rol_id == 2) {
					$_SESSION['admin'] = true;
				}
				if ($log->getOne()) {
					$log->update();
				}else {
					$log->save();
				}
			}else{
				$_SESSION['error_login'] = 'Identificacion Fallida!';
			}
		}
		header("Location:".base_url);
	}

	public function logOut(){
		if (isset($_SESSION['identity'])) {
			unset($_SESSION['identity']);
		}
		if (isset($_SESSION['admin'])) {
			unset($_SESSION['admin']);
		}
		header("Location:".base_url);
	}
}//fin clase