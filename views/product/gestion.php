<div class="container mt-5">
	<h1 class="text-center">Gestionar Productos</h1>
	<a class="btn btn-primary mb-1" href="<?=base_url?>product/create">Crear Productos</a>
	<!-- Alerta Editar-->
	<?php if (isset($_SESSION['product']) && $_SESSION['product'] == 'complete'): ?>
		<div class='alert alert-success d-flex alert-dismissible fade show align-items-center' role='alert'>
			<i class='bi bi-check-circle-fill me-2 flex-shrink-0' style='font-size: 24px;'></i>
			<strong>Registro guardado o editado con exito.</strong>
			<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
		</div>
	<?php elseif (isset($_SESSION['product']) && $_SESSION['product'] == 'failed'): ?>
		<div class='alert alert-warning d-flex alert-dismissible fade show align-items-center' role='alert'>
			<i class='bi bi-exclamation-triangle-fill me-2 flex-shrink-0' style='font-size: 24px;'></i>
			<strong>Hubo un error al editar o guardar un producto.</strong>
			<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
		</div>
	<?php endif; ?>
	<?php utils::deleteSession('product'); ?>
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
			<th>Código</th>
			<th>Nombre</th>
			<th>Caracteristicas</th>
			<th>Stock</th>
			<th>Precio</th>
			<th>Iva</th>
			<th>Foto</th>
			<th>Acción</th>
		</thead>
		<?php while ($p = $products->fetch_object()):?>
			<tr>
				<td><?=$p->id;?></td>
				<td><?=$p->nombre;?></td>
				<td><p><?=$p->descripcion;?></p></td>
				<td><?=$p->stock;?></td>
				<td><?=$p->precio;?></td>
				<td><?=$p->iva;?></td>
				<td><img src="<?=base_url?>/uploads/products/<?=$p->img;?>" height="60"></td>
				<td>
					<div class="btn-group">
						<a class="btn btn-warning" href="<?=base_url?>product/edit&id=<?=$p->id?>">
							<div><i class="bi bi-pencil-square me-2"></i><span>Editar</span></div>
						</a>
						<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete<?=$p->id?>">
							<div><i class="bi bi-trash-fill me-2"></i><span>Eliminar</span></div>
						</button>
						<!-- Modal"-->
						<div class="modal fade" id="modalDelete<?=$p->id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
										<a href="<?=base_url?>product/delete&id=<?=$p->id?>" class="btn btn-danger">Eliminar</a>
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