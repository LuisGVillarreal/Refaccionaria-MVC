<div class="container">
	<?php $title = "Crear Nuevo Producto" ?>
	<?php if (isset($edit) && isset($p) && is_object($p)): ?>
		<?php $url_action = base_url."product/save&id=".$p->id; ?>
		<?php $title = "Editar Producto: ".$p->nombre ?>
	<?php else: ?>
		<?php $url_action = base_url."product/save"; ?>
	<?php endif; ?>
	<h1 class="text-center my-2"><strong><?=$title?></strong></h1>
<form class="row g-3 needs-validation" action="<?=$url_action?>" method="POST" enctype="multipart/form-data" novalidate>
	<div class="col-md-6 mb-2">
		<label class="form-label" for="nombre">Nombre</label>
		<input class="form-control" type="text" name="nombre" required value="<?=isset($p)&&is_object($p) ? $p->nombre : ''?>">
	</div>
	<div class="col-md-6 mb-2">
		<label class="form-label" for="descripcion">Descripción</label>
		<textarea class="form-control" type="text" name="descripcion" required><?=isset($p)&&is_object($p) ? $p->descripcion : ''?></textarea>
	</div>
	<div class="col-md-4 mb-2">
		<label class="form-label" for="precio">Precio</label>
		<input class="form-control" type="number" name="precio" required value="<?=isset($p)&&is_object($p) ? $p->precio : ''?>">
	</div>
	<div class="col-md-4 mb-2">
		<label class="form-label" for="stock">Stock</label>
		<input class="form-control" type="number" name="stock" required value="<?=isset($p)&&is_object($p) ? $p->stock : ''?>">
	</div>
	<div class="col-md-4 mb-2">
		<label class="form-label" for="category">Categoria</label>
		<?php $categories = utils::showCategories(); ?>
		<select class="form-select" name="category">
			<?php while($cat = $categories->fetch_object()): ?>
				<option value="<?=$cat->id?>" <?=isset($p)&&is_object($p)&&$cat->id==$p->category_id ? 'selected' : ''?>>
					<?=$cat->nombre?>
				</option>
			<?php endwhile; ?>
		</select>
	</div>
	<div class="col-md-12 mb-2">
		<label class="form-label" for="foto">Foto </label>
		<?php if (isset($p)&&is_object($p)&&!empty($p->img)): ?>
			<div class="mb-1"><img src="<?=base_url?>/uploads/products/<?=$p->img?>" width="150"></div>
		<?php endif;?>
		<input class="form-control" type="file" name="foto" accept="image/png, image/jpeg, image/jpg" >
	</div>
	<div class="col-md-12 d-grid">
		<input class="btn btn-primary" type="submit" value="Guardar">
	</div>
</form>
</div>