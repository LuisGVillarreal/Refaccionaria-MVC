<div class="container">
	<?php if (isset($_SESSION['identity'])):?>
	<?php if (isset($_SESSION['cart'])): ?>
		<h1 class="text-center mt-1">Realizar pedido</h1>
		<a class="btn btn-outline-dark mb-4" href="<?=base_url?>cart/index"><i class="bi bi-arrow-left-circle me-2"></i>Regresar al carrito</a>
		<div class="row g-5">
			<div class="col-md-5 col-lg-4 order-md-last">
				<h4 class="d-flex justify-content-between align-items-center mb-3">
					<span class="text-primary">Mi carrito</span>
					<?php $stats = utils::statsCart(); ?>
					<span class="badge bg-primary rounded-pill"><?=$stats['count'];?></span>
				</h4>
				<ul class="list-group mb-3">
					<?php foreach ($cart as $key => $p):
					$product = $p['product'];
					?>
					<li class="list-group-item d-flex justify-content-between lh-sm">
						<div>
							<h6 class="my-0"><?=$product->nombre;?> x<?=$p['amount'];?></h6>
							<small class="text-muted"><?=$product->descripcion;?></small>
						</div>
						<span class="text-muted">$<?=$p['price'];?></span>
					</li>
					<?php endforeach; ?>
					<li class="list-group-item d-flex justify-content-between">
						<span>Total (MXN)</span>
						<strong>$<?=$stats['total'];?></strong>
					</li>
				</ul>
			</div>
			<div class="col-md-7 col-lg-8">
				<h4 class="mb-3">Domicilio para el envio</h4>
				<form action="<?=base_url?>order/add" method="POST" class="needs-validation" novalidate>
					<div class="row g-3">
						<div class="col-sm-6">
							<label class="form-label" for="estado">Estado</label>
							<input class="form-control" type="text" name="estado" required>
						</div>
						<div class="col-sm-6">
							<label class="form-label" for="ciudad">Ciudad/Delegacion</label>
							<input class="form-control" type="text" name="ciudad" required>
						</div>
						<div class="col-12">
							<label class="form-label" for="colonia">Colonia</label>
							<input class="form-control"type="text" name="colonia" required>
						</div>
						<div class="col-12">
							<label class="form-label" for="calle">Calle</label>
							<input class="form-control"type="text" name="calle" required>
						</div>
						<div class="col-md-5">
							<label class="form-label" for="cp">Codigo Postal</label>
							<input class="form-control"type="number" name="cp" required>
						</div>
						<div class="col-sm-4">
							<label class="form-label" for="no_int">No. Interior</label>
							<input class="form-control"type="number" name="no_int" required>
						</div>
						<div class="col-sm-3">
							<label class="form-label" for="no_ext">No. Exterior</label>
							<input class="form-control"type="number" name="no_ext" required>
						</div>
					</div>
					<hr>
					
					<button class="w-100 btn btn-primary btn-lg" type="submit">Continuar para confirmar</button>
				</form>
			</div>
		</div>
	<?php else: ?>
		<h1 class="text-center mt-1">No hay ningun articulo en tu carrito de compras</h1>
	<?php endif; ?>
	<?php else: ?>
		<h1 class="text-center mt-1">Necesita estar identificado</h1>
		<p class="text-center">Tienes que iniciar sesion en la pagina para realizar tu pedido</p>
	<?php endif; ?>
</div>