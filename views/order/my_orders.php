<div class="container mt-4">
	<?php if(isset($gestion)): ?>
		<h1 class="text-center">Gestionar pedidos</h1>
	<?php else: ?>
		<h1 class="text-center">Mis pedidos</h1>
	<?php endif; ?>
	<!-- Alerta Enviar-->
	<?php if (isset($_SESSION['email']) && $_SESSION['email'] == 'sent'): ?>
		<div class='alert alert-success d-flex alert-dismissible fade show align-items-center' role='alert'>
			<i class='bi bi-check-circle-fill me-2 flex-shrink-0' style='font-size: 24px;'></i>
			<strong>Ticket enviado con exito!.</strong>
			<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
		</div>
	<?php elseif (isset($_SESSION['email']) && $_SESSION['email'] == 'failed'): ?>
		<div class='alert alert-danger d-flex alert-dismissible fade show align-items-center' role='alert'>
			<i class='bi bi-exclamation-triangle-fill me-2 flex-shrink-0' style='font-size: 24px;'></i>
			<strong>Hubo un error al enviar.</strong>
			<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
		</div>
	<?php endif; ?>
	<?php utils::deleteSession('email'); ?>
	<!-- Tabla-->
	<div class="table-responsive">
	<table class="table table-hover text-center">
		<thead class="table-dark">
			<th>No. Pedido</th>
			<th>Costo</th>
			<th>Fecha</th>
			<th>Estado del Ped.</th>
			<th>Acción</th>
		</thead>
		<?php if(isset($orders)): ?>
			<?php while($p = $orders->fetch_object()):?>
			<tr>
				<td><a class="btn btn-link" href="<?=base_url?>order/details&id=<?=$p->id?>"><?=$p->id?></a></td>
				<td>$<?=$p->costo;?></td>
				<td><?=$p->fecha;?></td>
				<td><?=utils::showStatus($p->estado_pedido);?></td>
				<td>
					<div id="editor" class="btn-group">
						<a id="cmd" class="btn btn-outline-primary" href="<?=base_url?>order/pdf&order_id=<?=$p->id?>" target="_blank"><i class="bi bi-file-pdf-fill"></i></a>
						<button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#sendModal<?=$p->id?>">
							<i class="bi bi-send-fill"></i>
						</button>		
					</div>
					<!-- Modal -->
					<div class="modal fade" id="sendModal<?=$p->id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog text-start">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Enviar Ticket N° <?=$p->id?></h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<form action="<?=base_url?>order/sendMail&order_id=<?=$p->id?>" method="POST" class="needs-validation" novalidate>
										<div class="mb-3">
											<label for="email" class="col-form-label">Para:</label>
											<input type="email" class="form-control" name="email" placeholder="me@mail.com" required>
										</div>
										<div>
											<input type="submit" class="btn btn-primary"></input>
										</div>
									</form>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
								</div>
							</div>
						</div>
					</div>
				</td>
			</tr>
			<?php endwhile; ?>
		<?php else: ?>
			<tr><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<?php endif; ?>
	</table>
	</div>
</div>