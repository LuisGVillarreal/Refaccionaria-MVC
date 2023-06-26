<!DOCTYPE html>
<html class="h-100">
<head>
	<title>Refaccionaria</title>
	<meta charset="utf-8">
	<meta lang="es">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="<?=base_url?>assets/images/logo.ico">
	<link rel="stylesheet" type="text/css" href="<?=base_url?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url?>assets/css/main.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>
<body class="d-flex flex-column h-100">
	<?php $categories = utils::showCategories();?>
	<?php $stats = utils::statsCart();?>
	<?php if(utils::hidden()):?>
	<header>
		<nav class="navbar navbar-expand-sm navbar-dark bg-dark" >
			<div class="container">
				<a class="navbar-brand me-md-auto" href="<?=base_url?>">
					<img src="<?=base_url?>assets/images/logo.png" height="50" class="d-inline-block align-text-center">
				</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav ms-auto text-center">
						<li class="nav-item">
							<a class="nav-link" href="<?=base_url?>">
								<i class="bi bi-house-door-fill d-block fs-4"></i>Inicio
							</a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								<i class="bi bi-filter-square-fill d-block fs-4"></i>Categorias
							</a>
							<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
								<?php while($cat = $categories->fetch_object()):?>
									<li>
										<a class="dropdown-item" href="<?=base_url?>category/view&id=<?=$cat->id?>"><?=$cat->nombre;?></a>
									</li>
								<?php endwhile;?>
							</ul>
						</li>
						<?php if (utils::onlyUser()):?>
						<li class="nav-item dropdown">
							<a class="nav-link" href="#" id="navbarDropdownMenuLink3" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								<i class="bi bi-cart-fill d-block fs-4 position-relative"><span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger fst-normal fs-6"><?=$stats['count'];?><span class="visually-hidden">Cart</span></span></i>Mi carrito
							</a>
							<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink3">
								<li class="dropdown-item">
									<a class="dropdown-item" href="<?=base_url?>cart/index">
										Productos: <?=$stats['count'];?><br>Total: <?=$stats['total'];?>
									</a>
								</li>
							</ul>
						</li>
						<?php endif; ?>
						<?php if(isset($_SESSION['identity'])):?>
							<li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								<span class="d-block"><img src="<?=base_url?>uploads/users/<?=$_SESSION['identity']->img?>" alt="mdo" width="36" height="36" class="rounded-circle"></span>
								Cuenta
								</a>
								<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">
									<?php if(isset($_SESSION['admin'])):?>
										<li><a class="dropdown-item" href="<?=base_url?>user/gestion">Gest. Usuarios</a></li>
										<li><a class="dropdown-item" href="<?=base_url?>user/logs">Bitacora</a></li>
										<li><a class="dropdown-item" href="<?=base_url?>product/gestion">Gest. Productos</a></li>
										<li><a class="dropdown-item" href="<?=base_url?>category/index">Gest. Categorias</a></li>
										<li><a class="dropdown-item" href="<?=base_url?>order/gestion">Gest. Pedidos</a></li>
										<?php else:?>
											<li><a class="dropdown-item" href="<?=base_url?>order/myOrders">Mis Pedidos</a></li>
											<li><a class="dropdown-item" href="<?=base_url?>user/edit&id=<?=$_SESSION['identity']->id?>">Editar perfil</a></li>
										<?php endif;?>
										<li><hr class="dropdown-divider"></li>
										<li><a class="dropdown-item" href="<?=base_url?>user/logOut">Cerrar Sesion</a></li>
									</ul>
								</li>
								<?php else:?>
									<li class="nav-item"><a class="nav-link" href="<?=base_url?>user/logIn"><i class="bi bi-person-circle d-block fs-4"></i>Iniciar Sesion</a></li>
								<?php endif;?>
							</ul>
				</div>
			</div>
		</nav>
	</header>
	<?php else: ?>
		<a class="navbar-brand" href="<?=base_url?>">
			<img src="<?=base_url?>assets/images/logo.png" height="50" class="d-inline-block align-text-center">
		</a>
	<?php endif; ?>
	<article class="flex-shrink-0">
