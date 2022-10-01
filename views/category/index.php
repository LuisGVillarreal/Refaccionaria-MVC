<div class="container mt-5">
	<h1 class="text-center">Gestionar categorias</h1>
	<a class="btn btn-primary mb-1" href="<?=base_url?>category/create">Crear categoria</a>
	<table class="table table-hover text-center">
		<thead class="table-dark">
			<th>ID</th>
			<th>NOMBRE</th>
		</thead>
		<?php while ($cat = $categories->fetch_object()):?>
			<tr>
				<td><?=$cat->id;?></td>
				<td><?=$cat->nombre;?></td>
			</tr>
		<?php endwhile; ?>
	</table>
</div>