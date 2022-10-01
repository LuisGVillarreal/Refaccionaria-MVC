<div class="container">
	<?php if (isset($_SESSION['order']) && $_SESSION['order'] == 'complete'): ?>
		<h1 class="text-center text-success">Tu pedido se ha confirmado</h1>
		<p class="text-center fs-4">Tu pedido ha sido guardado con exito</p>
		<?php if(isset($order)): ?>
			<h4>Datos del pedido:</h4>
			Numero de pedido: <?=$order->id?><br>
			Total a pagar: $<?=$order->costo?><br>
			<table class="table text-center caption-top">
				<caption>Lista de productos</caption>
				<thead class="table-light">
					<th>Imagen</th>
					<th>Nombre</th>
					<th>Precio</th>
					<th>Unidades</th>
				</thead>
				<?php while($p = $products->fetch_object()): ?>
					<tr>
						<td><a href="<?=base_url?>product/details&id=<?=$product->id?>"><img src="<?=base_url?>/uploads/products/<?=$p->img;?>" width="70"></a></td>
						<td><?=$p->nombre;?></td>
						<td><?=$p->precio;?></td>
						<td><?=$p->unidades;?></td>
					</tr>
				<?php endwhile;?>
			</table>
			<div class="text-center">
				<a class="btn btn-outline-success" href="<?=base_url?>order/myOrders">Ver mis pedidos</a>
			</div>
		<?php endif; ?>
	<?php else: ?>
		<h1 class="text-center text-warning">Tu pedido no se ha podido procesar</h1>
	<?php endif; ?>
</div>