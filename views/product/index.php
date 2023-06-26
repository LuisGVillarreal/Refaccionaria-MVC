<!------------------------- Carousel--------------------------- -->
<div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2" class="active" aria-current="true"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="<?=base_url?>/assets/images/autopartes1.jpg" height="100%">
        <div class="container">
          <div class="carousel-caption text-start ps-3 bg-black-transparent text-white">
          <?php if(isset($_SESSION['identity'])):?>
            <h1>¡Bienvenido de nuevo!</h1>
            <p>Explora nuestra selección premium de productos y aprovecha nuestras ofertas personalizadas.</p>
          <?php else:?>
              <h1>Registrate hoy.</h1>
              <p>Registrate para obtener nuestros mejores productos.</p>
              <p><a class="btn btn-lg btn-primary" href="<?=base_url?>user/signUp">Registrarse</a></p>
          <?php endif;?>
          </div>
        </div>
      </div>
      <div class="carousel-item ">
        <img src="<?=base_url?>/assets/images/autopartes2.jpg" height="100%">
        <div class="container">
          <div class="carousel-caption bg-black-transparent">
            <h1>Productos de calidad.</h1>
            <p>Tenemos las mejores refacciones para tu auto.</p>
          </div>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
</div>

<!------------------------- Productos--------------------------- -->
<div class="container text-center">
	<div class="row row-cols-2 row-cols-md-3 align-items-md-stretch">
		<?php while ($product = $products->fetch_object()):?>
    	<div class="col-sm mb-4">
        	<div class="bg-light border rounded-3 pt-3">
        		<img class="img-product" src="<?=base_url?>/uploads/products/<?=$product->img;?>">
	        	<div class="overflow-auto" style="height: 50px;"><h4 class=""><?=$product->nombre;?></h4></div>
            <p>&dollar;<?=$product->precio;?></p>
	        	<div class="btn-group mb-3">
              <a class="btn btn-primary" href="<?=base_url?>product/details&id=<?=$product->id?>">Ver detalles »</a>
              <?php if (utils::onlyUser()):?>
                <a class="btn btn-outline-secondary" href="<?=base_url?>cart/add&id=<?=$product->id?>"><i class="bi bi-cart-plus-fill"></i></a>
              <?php endif; ?>
            </div>
        	</div>
      	</div>
      	<?php endwhile; ?>
    </div>	
</div>