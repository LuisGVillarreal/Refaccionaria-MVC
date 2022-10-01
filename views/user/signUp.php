<div class="container w-75 bg-light bg-gradient mt-5 rounded shadow">
	<?php if (isset($_SESSION['register']) && $_SESSION['register'] == 'complete'): ?>
		<div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
		  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi flex-shrink-0 me-2 bi-check-circle-fill" viewBox="0 0 16 16">
		  		<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
			</svg>
		  	<strong class="me-2">Success!</strong> <span>Registro Completado con exito.</span>
		  	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	<?php elseif (isset($_SESSION['register']) && $_SESSION['register'] == 'failed'): ?>
		<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
		  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi flex-shrink-0 me-2 bi-check-circle-fill" viewBox="0 0 16 16">
		  		<path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
		  		</svg>
		  	<strong class="me-2">Error!</strong> <span>Hubo un error al guardar el registro.</span>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	<?php endif; ?>
	<?php utils::deleteSession('register'); ?>
	<div class="row align-items-stretch">
		<div class="col p-5 rounded-start">
			<h1 class="fw-bold text-center pb-5">Registrate</h1>
			<form class="row g-3 needs-validation" action="<?=base_url?>user/save" method="POST" enctype="multipart/form-data" novalidate>
				<div class="col-md-6 mb-2">
					<label for="nombre" class="form-label">Nombre </label>
					<input type="text" class="form-control" id="validationCustom01" name="nombre" required placeholder="Juan">
				</div>
				<div class="col-md-6 mb-2">
					<label for="aPaterno" class="form-label">Apellido Paterno </label>
					<input type="text" class="form-control" name="aPaterno" required placeholder="Hernandez">
				</div>
				<div class="col-md-12 mb-2">
					<label for="aMaterno" class="form-label">Apellido Materno </label>
					<input type="text" class="form-control" name="aMaterno" required placeholder="Villa">
				</div>
				<div class="col-md-6 mb-2">
					<label for="edad" class="form-label">Edad </label>
					<input type="number" class="form-control" name="edad" min="18" max="100" required placeholder="18">
				</div>
				<div class="col-md-6 mb-2">
					<label class="form-label" for="sexo">Sexo </label>
					<?php $generos = utils::showGeneros(); ?>
					<select class="form-select" name="sexo">
						<?php while($g = $generos->fetch_object()): ?>
							<option value="<?=$g->id?>">
								<?=$g->genero?>
							</option>
						<?php endwhile; ?>
					</select>
				</div>
				<div class="col-md-12 mb-2">
					<label for="email" class="form-label">Email </label>
					<input type="email" class="form-control" name="email" required placeholder="micorrero@mail.com">
				</div>
				<div class="col-md-12 mb-2">
					<label for="password" class="form-label" required>Contraseña </label>
					<input type="password" class="form-control" name="password" pattern=".{6,}" required placeholder="&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;">
				</div>
				<div class="col-md-12 mb-2">
					<label for="foto" class="form-label">Foto </label>
					<input type="file" class="form-control" name="foto" accept="image/png, image/jpeg, image/jpg" required>
				</div>
				<div class="col-md-12 d-grid">
					<button class="btn btn-primary" type="submit" name="">Registrarse</button>
				</div>
			</form>
		</div>	
		<div class="col imgform d-none d-lg-block col-md-5 col-lg-5 col-xl-6 p-0 rounded">
			<div class="row p-4 bg-blur text-center align-content-center h-100">
				<h2>¿Ya tienes una cuenta?</h2>
				<h3>Inicia sesion aqui.</h3>
				<button class="btn btn-primary" onclick="location.href='<?=base_url?>user/LogIn';">Iniciar sesión</button>
			</div>
		</div>
	</div>
</div>
	