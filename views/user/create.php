<div class="container">
<?php $url_action = base_url."user/editSave&id=".$u->id; ?>
<h1 class="text-center my-2"><strong>Editar Usuario N° <?=$u->id;?></strong></h1>
<form class="row g-3 needs-validation" action="<?=$url_action?>" method="POST" enctype="multipart/form-data" novalidate>
	<div class="col-md-4 mb-2">
		<label class="form-label" for="nombre">Nombre</label>
		<input class="form-control" type="text" name="nombre" required value="<?=isset($u)&&is_object($u) ? $u->nombre : ''?>">
	</div>
	<div class="col-md-4 mb-2">
		<label class="form-label" for="aPaterno">Ap. Paterno</label>
		<input class="form-control" type="text" name="aPaterno" required value="<?=isset($u)&&is_object($u) ? $u->a_paterno : ''?>">
	</div>
	<div class="col-md-4 mb-2">
		<label class="form-label" for="aMaterno">Ap. Materno</label>
		<input class="form-control" type="text" name="aMaterno" required value="<?=isset($u)&&is_object($u) ? $u->a_materno : ''?>">
	</div>
	<div class="col-md-3 mb-2">
		<label class="form-label" for="edad">Edad</label>
		<input class="form-control" type="number" name="edad" required value="<?=isset($u)&&is_object($u) ? $u->edad : ''?>">
	</div>
	<div class="col-md-3 mb-2">
		<label class="form-label" for="sexo">Genero</label>
		<?php $generos = utils::showGeneros(); ?>
		<select class="form-select" name="sexo">
			<?php while($g = $generos->fetch_object()): ?>
				<option value="<?=$g->id?>" <?=isset($g)&&is_object($g)&&$g->id==$u->sexo_id ? 'selected' : ''?>>
					<?=$g->genero?>
				</option>
			<?php endwhile; ?>
		</select>
	</div>
	<div class="col-md-12 mb-2">
		<label class="form-label" for="foto">Foto</label>
		<?php if (isset($u)&&is_object($u)&&!empty($u->img)): ?>
			<div class="mb-1"><img src="<?=base_url?>uploads/users/<?=$u->img?>" width="150"></div>
		<?php endif;?>
		<input class="form-control" type="file" name="foto" accept="image/png, image/jpeg, image/jpg" >
	</div>
	<div class="col-md-12 d-grid">
		<input type="submit" value="Editar" class="btn btn-primary">
	</div>
</form>
</div>