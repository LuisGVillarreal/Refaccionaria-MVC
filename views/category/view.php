<div class="container text-center">
	<?php if (isset($category)): ?>
		<h1 class="column3"><?=$category->nombre?></h1>
		<?php if($products->num_rows == 0): ?>
			<p class="fs-4">No hay productos disponibles</p>
		<?php else: ?>
			<div class="row align-items-md-stretch">
				<?php while ($product = $products->fetch_object()):?>
					<div class="col-md-4 mb-4">
						<div class="bg-light border rounded-3 pt-3">
			        		<img src="<?=base_url?>/uploads/products/<?=$product->img;?>" height="120">
				        	<h2><strong><?=$product->nombre;?></strong></h2>
				        	<p><?=$product->descripcion;?></p>
				        	<p>&dollar;<?=$product->precio;?></p>
				        	<div class="btn-group mb-3">
				              <a class="btn btn-primary" href="<?=base_url?>product/details&id=<?=$product->id?>">Ver detalles »</a>
				              <?php if (utils::onlyUser()):?>
				              <a class="btn btn-outline-secondary" href="<?=base_url?>cart/add&id=<?=$product->id?>"><i class="bi bi-cart-plus-fill"></i></a>
				          <?php endif; ?>
				            </div>
			        	</div>
					</div>
				<?php endwhile; ?>
			</div>
		<?php endif; ?>
	<?php else: ?>
		<h1 class="column3">La categoria no existe</h1>
	<?php endif; ?>
</div>