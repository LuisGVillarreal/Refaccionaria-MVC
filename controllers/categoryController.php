<?php
require_once 'models/category.php';
require_once 'models/product.php';

class categoryController {
	
	public function index(){
		utils::isAdmin();
		$category = new category();
		$categories = $category->getAll();
		require_once 'views/category/index.php';
	}

	public function view(){
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$category = new category();
			$category->setId($id);
			$category = $category->getOne();

			$product = new product();
			$product->setCategoryId($id);
			$products = $product->getAllCategory();
		}
		require_once 'views/category/view.php';
	}

	public function create(){
		utils::isAdmin();
		require_once 'views/category/create.php';
	}

	public function save(){
		utils::isAdmin();
		if (isset($_POST) && isset($_POST['nombre'])) {
			$category = new category();
			$category->setNombre($_POST['nombre']);
			$save = $category->save();
		}
		header("Location:".base_url."category/index");
	}
}