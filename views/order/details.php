<div class="container" id="content">
	<?php if(isset($order)): ?>
		<p class="mt-4"><strong>Pedido N° <?=$order->id?></strong></p> 
		<?=utils::showStatus($order->estado_pedido);?><br>
		<?php if(isset($_SESSION['admin'])): ?>
			<?php if(utils::hidden()):?>
			<form class="row g-3 justify-content-center" action="<?=base_url?>order/estado" method="POST">
				<h3 class="text-center">Cambiar estado del pedido</h3>
				<input type="hidden" name="orderId" value="<?=$order->id?>">
				<div class="col-md-4">
					<select class="form-select" name="estado">
						<option value="Confirm" <?=$order->estado_pedido == 'Confirm' ? 'selected' : '';?>>Pendiente</option>
						<option value="Preparation" <?=$order->estado_pedido == 'Preparation' ? 'selected' : '';?>>En preparación</option>
						<option value="Ready" <?=$order->estado_pedido == 'Ready' ? 'selected' : '';?>>Preparado para enviar</option>
						<option value="Sended" <?=$order->estado_pedido == 'Sended' ? 'selected' : '';?>>Enviado</option>
					</select>
				</div>
				<div class="w-100 m-0"></div>
				<div class="col-md-4 d-grid" >
					<input class="btn btn-outline-primary" type="submit" name="" value="Cambiar estado">
				</div>
			</form><br>
			<?php endif; ?>
		<?php endif; ?>
		<?=$order->fecha?><br>
		<table class="table caption-top">
			 <caption>Productos:</caption>
			<thead>
				<th>Imagen</th>
				<th>Nombre</th>
				<th>Cantidad</th>
				<th>Subtotal</th>
			</thead>
			<tbody>
			<?php while($p = $products->fetch_object()): ?>
				<tr>
					<td><a href="<?=base_url?>product/details&id=<?=$p->id?>"><img src="<?=base_url?>/uploads/products/<?=$p->img;?>" width="70"></a></td>
					<td><?=$p->nombre;?></td>
					<td><?=$p->unidades;?></td>
					<td>$<?=$p->precio;?></td>
				</tr>
			<?php endwhile;?>
			</tbody>
			<tfoot>
				<tr><td colspan="3" class="text-end">Subtotal </td><td>$<?=$order->costo?></td></tr>
			    <tr><td colspan="3" class="text-end">Total </td><td>$<?=$order->costo?></td></tr>
			</tfoot>
		</table>
		<div class="mt-5 p-2 border">
			<h5>Direccion de envio</h5>
			<p>
				<?=$_SESSION['identity']->nombre?> <?=$_SESSION['identity']->a_paterno?> <?=$_SESSION['identity']->a_materno?><br>
				<?=$order->calle?>, <?=$order->colonia?>. <br>
				No° Int: <?=$order->n_int?> - No° Ext: <?=$order->n_ext?><br>
				<?=$order->estado?>, <?=$order->ciudad?>,  <?=$order->cp?>
			</p>
		</div>
	<?php endif; ?>
</div>