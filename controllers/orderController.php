<?php
/**
 * Controlador de Pedidos
 */
require_once 'models/order.php';
require_once 'models/product.php';
require 'vendor/autoload.php';
use Dompdf\Dompdf;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class orderController {
	
	public function index(){
		utils::isIdentity();
		if (isset($_SESSION['cart'])) {
			$cart = $_SESSION['cart'];
		}
		require_once 'views/order/index.php';
	}

	public function confirm(){
		utils::isIdentity();
		$identity = $_SESSION['identity'];
		$order = new order();
		$order->setUserId($identity->id);
		$order = $order->getOneByUser();
		$products_order = new order();
		$products = $products_order->getProductsByOrder($order->id);
		require_once 'views/order/confirm.php';
	}

	public function gestion(){
		utils::isAdmin();
		$gestion = true;
		$order = new order();
		$orders = $order->getAll();
		require_once 'views/order/my_orders.php';
	}

	public function myOrders(){
		utils::isIdentity();
		$userId = $_SESSION['identity']->id;
		$order = new order();
		$order->setUserId($userId);
		$orders = $order->getAllByUser();
		require_once 'views/order/my_orders.php';
	}

	public function details(){
		utils::isIdentity();
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$order = new order();
			$order->setId($id);
			$order = $order->getOne();
			$products_order = new order();
			$products = $products_order->getProductsByOrder($id);
			require_once 'views/order/details.php';
		}else{
			header("Location:".base_url."order/myOrders");
		}
	}

	public function add(){
		utils::isIdentity();
		if (isset($_POST)) {
			$stats = utils::statsCart();
			$userId = $_SESSION['identity']->id;
			$costo = $stats['total'];
			$estado = isset($_POST['estado']) ? $_POST['estado'] : false;
			$ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : false;
			$cp = isset($_POST['cp']) ? $_POST['cp'] : false;
			$colonia = isset($_POST['colonia']) ? $_POST['colonia'] : false;
			$calle = isset($_POST['calle']) ? $_POST['calle'] : false;
			$no_int = isset($_POST['no_int']) ? $_POST['no_int'] : false;
			$no_ext = isset($_POST['no_ext']) ? $_POST['no_ext'] : false;

			if ($userId && $costo && $estado && $ciudad && $cp && $colonia && $no_int && $no_ext) {
				$order = new order();
				$order->setUserId($userId);
				$order->setCosto($costo);
				$order->setEstado($estado);
				$order->setCiudad($ciudad);
				$order->setCP($cp);
				$order->setColonia($colonia);
				$order->setCalle($calle);
				$order->setNInt($no_int);
				$order->setNExt($no_ext);
				$save = $order->save();
				$saveProdOrd = $order->saveProductsOrders();
				if ($save && $saveProdOrd) {
					$_SESSION['order'] = 'complete';
					unset($_SESSION['cart']);
				}else{
					$_SESSION['order'] = 'failed';
				}
			}else{
				$_SESSION['order'] = 'failed';
			}
			header("Location:".base_url."order/confirm");
		}else{
			$_SESSION['order'] = 'failed';
			header("Location:".base_url);
		}
	}	

	public function estado(){
		utils::isAdmin();
		if (isset($_POST)) {
			$id = $_POST['orderId'];
			$estado = $_POST['estado'];
			$order = new order();
			$order->setId($id);
			$order->setEstadoPedido($estado);
			$order->update();
			header("Location:".base_url."order/details&id=".$id);
		} else {
			header("Location:".base_url."order/gestion");
		}
	}

	public function pdf(){
		utils::isIdentity();
		if (isset($_GET['order_id'])) {
			$id = $_GET['order_id'];
			$order = new order();
			$order->setId($id);
			$order = $order->getOne();
			$products_order = new order();
			$products = $products_order->getProductsByOrder($id);
			require_once 'views/order/details.php';
			$html = ob_get_clean();
			$dompdf = new Dompdf();
			$options = $dompdf->getOptions();
			$options->set(array('isRemoteEnabled' => true, 'isJavascriptEnabled' => true));
			$dompdf->setOptions($options);
			$dompdf->loadHtml($html);
			$dompdf->setPaper('letter');
			$dompdf->render();
			$dompdf->stream('Pedido N°'.$id.'.pdf',array('Attachment' => false));
		}
		else{
			header("Location:".base_url."order/myOrders");
		}
	}

	public function sendMail(){
		utils::isIdentity();
		if (isset($_POST) && isset($_GET['order_id'])) {
			$email = isset($_POST['email']) ? $_POST['email'] : false;
			if ($email) {
				$id = $_GET['order_id'];
				$order = new order();
				$order->setId($id);
				$order = $order->getOne();
				$products_order = new order();
				$products = $products_order->getProductsByOrder($id);
				require_once 'views/order/details.php';
				$html = ob_get_clean();
				
				//Create an instance; passing `true` enables exceptions
				$mail = new PHPMailer(true);
				try {
					//Server settings
					$mail->isSMTP();
					$mail->Host       = 'smtp.office365.com';
					$mail->SMTPAuth   = true;
					$mail->Username   = email;
					$mail->Password   = password;
					$mail->SMTPSecure = 'tls';
					$mail->Port       = 587;
					$mail->CharSet = 'UTF-8';
					//Recipients 
					$mail->setFrom('lmlluizgus99@hotmail.com', 'Refaccionara');
					$mail->addAddress($email, 'User');
					//Content
					$mail->isHTML(true);
					$mail->Subject = 'Ticket de Pedido N° '.$id;
					$mail->Body    = $html;
					$mail->send();
					$_SESSION['email'] = 'sent';
				}catch (Exception $e) {
					$_SESSION['email'] = 'failed';
				}
			}else{
				$_SESSION['email'] = 'failed';
			}
		}
		else{
			$_SESSION['email'] = 'failed';
		}
		header("Location:".base_url."order/myOrders");
	}
}//FIN DE LA CLASE