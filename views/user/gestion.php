<div class="container mt-5">
	<h1 class="text-center">Gestionar Usuarios</h1>
	<!-- Alerta Editar-->
	<?php if (isset($_SESSION['user']) && $_SESSION['user'] == 'complete'): ?>
		<div class='alert alert-success d-flex alert-dismissible fade show align-items-center' role='alert'>
			<i class='bi bi-check-circle-fill me-2 flex-shrink-0' style='font-size: 24px;'></i>
			<strong>Registro editado con exito.</strong>
			<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
		</div>
	<?php elseif (isset($_SESSION['user']) && $_SESSION['user'] == 'failed'): ?>
		<div class='alert alert-warning d-flex alert-dismissible fade show align-items-center' role='alert'>
			<i class='bi bi-exclamation-triangle-fill me-2 flex-shrink-0' style='font-size: 24px;'></i>
			<strong>Hubo un error al editar.</strong>
			<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
		</div>
	<?php endif; ?>
	<?php utils::deleteSession('user'); ?>
	<!-- Alerta Eliminar-->
	<?php if (isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete'): ?>
		<div class='alert alert-danger d-flex alert-dismissible fade show align-items-center' role='alert'>
			<i class='bi bi-check-circle-fill me-2 flex-shrink-0' style='font-size: 24px;'></i>
			<strong>Registro eliminado.</strong>
			<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
		</div>
	<?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] == 'failed'): ?>
		<div class='alert alert-warning d-flex alert-dismissible fade show align-items-center' role='alert'>
			<i class='bi bi-exclamation-triangle-fill me-2 flex-shrink-0' style='font-size: 24px;'></i>
			<strong>Hubo un error al eliminar</strong>
			<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
		</div>
	<?php endif; ?>
	<?php utils::deleteSession('delete'); ?>

	<!-- Tabla -->
	<div class="table-responsive">
	<table class="table table-hover text-center">
		<thead class="table-dark">
			<th>ID</th>
			<th>Nombre</th>
			<th>Ap. Paterno</th>
			<th>Ap. Materno</th>
			<th>Edad</th>
			<th>Sexo</th>
			<th>Email</th>
			<th>Foto</th>
			<th>Acción</th>
		</thead>
		<?php while ($u = $users->fetch_object()):?>
			<tr>
				<td><?=$u->id;?></td>
				<td><?=$u->nombre;?></td>
				<td><?=$u->a_paterno;?></td>
				<td><?=$u->a_materno;?></td>
				<td><?=$u->edad;?></td>
				<td><?=$u->genero;?></td>
				<td><?=$u->email;?></td>
				<td><img src="<?=base_url?>/uploads/users/<?=$u->img;?>" height="60"></td>
				<td>
					<div class="btn-group">
						<a class="btn btn-warning" href="<?=base_url?>user/edit&id=<?=$u->id?>">
							<div><i class="bi bi-pencil-square me-2"></i><span>Editar</span></div>
						</a>
						<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete<?=$u->id?>">
							<div><i class="bi bi-trash-fill me-2"></i><span>Eliminar</span></div>
						</button>
						<!-- Modal"-->
						<div class="modal fade" id="modalDelete<?=$u->id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Eliminar registro</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<div class="modal-body">
										¿Esta seguro que desea eliminar este registro?
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
										<a href="<?=base_url?>user/delete&id=<?=$u->id?>" class="btn btn-danger">Eliminar</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</td>
			</tr>
		<?php endwhile; ?>
	</table>
	
	</div>
</div>