<?php
/**
 * 
 */
require_once 'models/product.php';
class productController {
	
	public function index(){
		$product = new product();
		$products = $product->getRandom(6);
		require_once 'views/product/index.php';
	}

	public function details(){
		if(isset($_GET['id'])){
			$id = $_GET['id'];	
			$product = new product();
			$product->setId($id);
			$p = $product->getOne();
		}
		require_once 'views/product/product_details.php';
	}

	public function gestion(){
		utils::isAdmin();
		$product = new product();
		$products =$product->getAll();
		require_once 'views/product/gestion.php';
	}

	public function create(){
		utils::isAdmin();
		require_once 'views/product/create.php';
	}

	public function save(){
		utils::isAdmin();
		if (isset($_POST)) {
			$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
			$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
			$precio = isset($_POST['precio']) ? $_POST['precio'] : false;
			$stock = isset($_POST['stock']) ? $_POST['stock'] : false;
			$category = isset($_POST['category']) ? $_POST['category'] : false;
			
			if ($nombre && $descripcion && $precio && $stock && $category) {
				$product = new product();
				$product->setNombre($nombre);
				$product->setDescripcion($descripcion);
				$product->setPrecio($precio);
				$product->setStock($stock);
				$product->setCategoryId($category);

				if (isset($_FILES['foto'])) {
					$file = $_FILES['foto'];
					$filename = $file['name'];
					$mimetype = $file['type'];
					if (($mimetype=='image/jpg') || ($mimetype=='image/jpeg') || ($mimetype=='image/png') || ($mimetype=='image/gif')) {
						if (!is_dir('uploads/products')) {
							mkdir('uploads/products',0777, true);
						}
						$product->setImg($filename);
						move_uploaded_file($file['tmp_name'], 'uploads/products/'.$filename);
					}
				}

				if(isset($_GET['id'])){
					$id = $_GET['id'];
					$product->setId($id);
					$save = $product->edit();
				}else{
					$save = $product->save();
				}
				if ($save) {
					$_SESSION['product'] = 'complete';
				}else{
					$_SESSION['product'] = 'failed';
				}
			}else{
				$_SESSION['product'] = 'failed';
			}
		}else{
			$_SESSION['product'] = 'failed';
		}
		header("Location:".base_url."product/gestion");
	}

	public function edit(){
		utils::isAdmin();
		$edit = true;
		if(isset($_GET['id'])){
			$id = $_GET['id'];	
			$product = new product();
			$product->setId($id);
			$p = $product->getOne();
			require_once 'views/product/create.php';
		}
		else{
			header("Location:".base_url."product/gestion");
		}
	}

	public function delete(){
		utils::isAdmin();
		if(isset($_GET['id'])){
			$id = $_GET['id'];	
			$product = new product();
			$product->setId($id);
			$delete = $product->delete();
			if ($delete) {
				$_SESSION['delete'] = 'complete';
			}
			else{
				$_SESSION['delete'] = 'failed';
			}
		}else{
			$_SESSION['delete'] = 'failed';
		}
		header("Location:".base_url."product/gestion");
	}
}//FIN DE LA CLASE