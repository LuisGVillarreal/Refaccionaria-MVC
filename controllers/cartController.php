<?php
/**
 * 
 */
require_once 'models/product.php';
class cartController {
	
	public function index(){
		if (isset($_SESSION['cart'])) {
			$cart = $_SESSION['cart'];
		}
		require_once 'views/cart/index.php';
	}

	public function add(){
		if(isset($_GET['id']) && (utils::getStock($_GET['id'])>0)) {
			$product_id = $_GET['id'];
		}else{
			header('Location:'.base_url);
		}
		if(isset($_SESSION['cart'])) {
			$counter = 0;
			foreach ($_SESSION['cart'] as $keys => $value) {
				$id_product = $_SESSION['cart'][$keys]['id_product'];
				$amount = $_SESSION['cart'][$keys]['amount'];
				if ($value['id_product'] == $product_id) {
					if ($amount < utils::getStock($id_product)) {
						$_SESSION['cart'][$keys]['amount']++;
					}
					$counter++;
				}
			}
		}
		if(!isset($counter) || $counter == 0){
			$product = new product();
			$product->setId($product_id);
			$product = $product->getOne();

			if (is_object($product)) {
				$_SESSION['cart'][] = array(
					"id_product" => $product->id,
					"price" => $product->precio,
					"amount" => 1,
					"product" => $product
				);
			}
		}
		header('Location:'.base_url.'cart/index');
	}

	public function up(){
		if (isset($_GET['index'])) {
			$index = $_GET['index'];
			$id_product = $_SESSION['cart'][$index]['id_product'];
			$amount = $_SESSION['cart'][$index]['amount'];
			if ($amount < utils::getStock($id_product)) {
				$_SESSION['cart'][$index]['amount']++;
			}
			header('Location:'.base_url.'cart/index');
		}
	}

	public function down(){
		if (isset($_GET['index'])) {
			$index = $_GET['index'];
			$_SESSION['cart'][$index]['amount']--;

			if ($_SESSION['cart'][$index]['amount'] == 0) {
				unset($_SESSION['cart'][$index]);
			}
			header('Location:'.base_url.'cart/index');
		}
	}

	public function delete(){
		if (isset($_GET['index'])) {
			$index = $_GET['index'];
			unset($_SESSION['cart'][$index]);
			header('Location:'.base_url.'cart/index');
		}
	}

	public function delete_all(){
		unset($_SESSION['cart']);
		header('Location:'.base_url.'cart/index');
	}
}