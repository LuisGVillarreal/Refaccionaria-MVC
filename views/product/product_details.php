<div class="container">
	<?php if(isset($p)): ?>
		<div class="row p-5 mb-4 bg-light rounded-3 mt-2 flex-column-reverse flex-md-row">
			<div class="col-md-8">
				<h1 class="display-5 fw-bold"><?=$p->nombre?></h1>
				<p class="fs-4"><?=$p->descripcion;?></p>
				<p class="fs-5">Stock: <?=$p->stock;?></p>
				<p class="fs-4"><strong>&dollar;<?=$p->precio;?></strong></p>
				<?php if (utils::onlyUser()):?>
					<a class="btn btn-primary btn-lg" href="<?=base_url?>cart/add&id=<?=$p->id?>">
						<i class="bi bi-cart-plus-fill me-2"></i>Añadir al arrito
					</a>
				<?php endif; ?>
			</div>
			<div class="col-md-4">
				<img src="<?=base_url?>/uploads/products/<?=$p->img;?>" height="250" class="img-fluid mb-1">
			</div>
		</div>
	<?php else:?>
		<h1 class="text-center">El producto no existe</h1>
	<?php endif; ?>
</div>