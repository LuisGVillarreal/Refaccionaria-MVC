<?php 
class utils{
	public static function deleteSession($name)	{
		if (isset($_SESSION[$name])) {
			$_SESSION[$name] = null;
			unset($_SESSION[$name]);
		}
		return $name;
	}

	public static function isAdmin(){
		if (!isset($_SESSION['admin'])) {
			header('Location:'.base_url);
		}
		else{
			return true;
		}
	}

	public static function onlyUser(){
		$isUser = true;
		if (isset($_SESSION['admin'])) {
			$isUser = false;
		}
		return $isUser;
	}

	public static function isIdentity(){
		if (!isset($_SESSION['identity'])) {
			header('Location:'.base_url);
		}
		else{
			return true;
		}
	}

	public static function isAdminOrOwner($userId){
		if (isset($_SESSION['admin'])) {
			return true;
		}
		
		if(isset($_SESSION['identity'])){
			require_once 'models/user.php';
			$identityId = $_SESSION['identity']->id;
			$user = new User();
			$user->setId($userId);
			$user = $user->getOne();
			if ($user !== null && $user->id == $identityId) {
				return true;
			} else {
				header('Location: '.base_url);
			}
		} else{
			header('Location: '.base_url);
		}
	}

	public static function showCategories(){
		require_once 'models/category.php';
		$category = new category();
		$categories = $category->getAll();
		return $categories;
	}

	public static function showGeneros(){
		require_once 'models/genero.php';
		$genero = new genero();
		$generos = $genero->getAll();
		return $generos;
	}

	public static function statsCart(){
		$stats = array(
			'count' => 0, 
			'total' => 0
		);
		if(isset($_SESSION['cart'])){
			$stats['count'] = count($_SESSION['cart']);
			foreach ($_SESSION['cart'] as $product) {
				$stats['total'] += $product['price']*$product['amount'];
			}
		}
		return $stats;
	}

	public static function showStatus($status){
		$value = 'Pendiente';
		if ($status == 'Confirm') {
			$value = 'Pendiente';
		} elseif ($status == 'Preparation') {
			$value = 'En preparación';
		}elseif ($status == 'Ready') {
			$value = 'Preparado para enviar';
		}elseif ($status == 'Sended') {
			$value = 'Enviado';
		}
		return $value;
	}

	public static function hidden(){
		$hidden = false;
		if (!isset($_GET['order_id'])) {
			$hidden = true;
		}
		return $hidden;
	}

	public static function getStock($product_id){
		require_once 'models/product.php';
		$product = new product();
		$product->setId($product_id);
		$product = $product->getOne();
		return $product->stock;
	}
}
