<div class="container mt-4">
	<h1 class="text-center">Carrito de la compra</h1>
	<div class="table-responsive">
	<table class="table table-hover text-center align-middle">
		<thead class="table-dark">
			<th>Imagen</th>
			<th>Nombre</th>
			<th>Precio</th>
			<th>Unidades</th>
			<th>Stock</th>
			<th>Eliminar</th>
		</thead>
		<?php if(isset($cart)): ?>
			<?php foreach ($cart as $key => $p):
			$product = $p['product'];
			?>
			<tr>
				<td><a href="<?=base_url?>product/details&id=<?=$product->id?>"><img src="<?=base_url?>/uploads/products/<?=$product->img;?>" height="70"></a></td>
				<td><?=$product->nombre;?></td>
				<td>$<?=$p['price'];?></td>
				<td>
					<a class="btn btn-outline-primary btn-sm" href="<?=base_url?>cart/down&index=<?=$key?>"> <i class="bi bi-dash"></i></a>
					<strong class="mx-1"><?=$p['amount'];?></strong>
					<a class="btn btn-outline-primary btn-sm" href="<?=base_url?>cart/up&index=<?=$key?>"><i class="bi bi-plus"></i></a>
				</td>
				<td><?=$product->stock;?></td>
				<td><a class="btn btn-outline-danger" href="<?=base_url?>cart/delete&index=<?=$key?>"><i class="bi bi-trash-fill"></i></a></td>
			</tr>
			<?php endforeach; ?>
		<?php else: ?>
			<tr><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<?php endif; ?>
	</table>
	</div>
	<?php $stats = utils::statsCart(); ?>
	<a href="<?=base_url?>cart/delete_all" class="btn btn-danger"><i class="bi bi-trash-fill me-2"></i>Vaciar Carrito</a>
	<h3 class="text-end"><span class="fw-light">Precio Total:</span> $<?=$stats['total']?></h3><hr>
	<?php if (utils::onlyUser()):?>
		<div class="text-center">
			<a href="<?=base_url?>order/index" class="btn btn-outline-dark">
				Tramitar pedido <i class="bi bi-arrow-right-circle"></i>
			</a>
		</div>
	<?php endif; ?>
</div>