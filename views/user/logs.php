<div class="container  mt-5">
	<h1 class="text-center">Bitacora de sesiones</h1>
	<!-- Tabla -->
	<div class="table-responsive">
	<table class="table table-hover text-center">
		<thead class="table-dark">
			<th>ID</th>
			<th>Nombre</th>
			<th>Ap. Paterno</th>
			<th>Ap. Materno</th>
			<th>Email</th>
			<th>Ultima Conexion</th>
		</thead>
		<?php while ($l = $logs->fetch_object()):?>
			<tr>
				<td><?=$l->user_id;?></td>
				<td><?=$l->nombre;?></td>
				<td><?=$l->a_paterno;?></td>
				<td><?=$l->a_materno;?></td>
				<td><?=$l->email;?></td>
				<td><?=$l->conexion;?></td>
			</tr>
		<?php endwhile; ?>
	</table>
	</div>
</div>