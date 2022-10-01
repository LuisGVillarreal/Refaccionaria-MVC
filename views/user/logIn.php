<div class="container w-75 bg-light bg-gradient mt-5 rounded shadow">
	<div class="row align-items-stretch">
		<div class="col p-5 rounded-start">
			<h1 class="fw-bold text-center py-5">Iniciar Sesión</h1>
			<form action="<?=base_url?>user/logOn" method="POST">
				<div class="mb-4">
					<label for="email" class="form-label">Email </label>
					<input type="email" class="form-control" name="email" required placeholder="micorrero@mail.com">
				</div>
				<div class="mb-4">
					<label for="password" class="form-label" required>Contraseña</label>
					<input type="password" class="form-control" name="password" pattern=".{6,}" required placeholder="&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;">
				</div>
				<div class="d-grid">
					<button class="btn btn-primary" type="submit">Iniciar Sesión</button>
				</div>
			</form>
			<div class="mt-2 d-block d-lg-none"><a href="<?=base_url?>user/SignUp">Registrate aqui.</a></div>
		</div>
		<div class="col imgform d-none d-lg-block col-md-5 col-lg-5 col-xl-6 p-0 rounded">
			<div class="row p-4 bg-blur text-center align-content-center h-100">
				<h2>¿No tienes una cuenta?</h2>
				<h3>Registrate aqui.</h3>
				<button class="btn btn-light" onclick="location.href='<?=base_url?>user/SignUp';">Registrarse</button>
			</div>
		</div>
	</div>
</div>
	