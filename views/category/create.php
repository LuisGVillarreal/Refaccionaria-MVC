<div class="container">
	<h1 class="text-center my-2">Crear nueva categoria</h1>
	<form class="row needs-validation justify-content-center" action="<?=base_url?>category/save" method="POST" novalidate>
		<div class="col-md-4  mb-2">
			<label class="form-label" for="nombre">Nombre</label>
			<input class="form-control" type="text" name="nombre" required>
		</div>
		<div class="w-100"></div>
		<div class="col-md-4 d-grid">
			<input class="btn btn-primary" type="submit" value="Guardar">
		</div>
	</form>
</div>