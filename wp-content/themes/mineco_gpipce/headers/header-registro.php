<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header class="header-registro">
	<div class="container barra-navegacion">
		<div class="row justify-content-center">
			<div class="col-12">
				<div class="text-center">
					<a href="<?php echo site_url('/'); ?>">
						<img  class="logo" src="<?php echo get_template_directory_uri(); ?>/img/logo-menu.png" alt="logo">
					</a>
				</div>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-12">
				<nav class="navbar navbar-expand-lg navbar-light ">
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarNav">
						<?php

						$id_user = obtener_informacion_usuario_loggeado();
						if($id_user['Profile'] === 'genero'){
							$args = array(
								'theme_location' => 'menu-administrador',
								'container'      => '',
								'menu_class'     => 'navbar-nav mr-auto menu-principal menu-principal-home',
							);
							wp_nav_menu( $args );
						}
						?>
					</div>
				</nav>
			</div>
		</div>
	</div>

	<div class="tagline text-center container">

		<h1 class="ml2">
			<?php the_field('encabezado_admin'); ?>
		</h1>
		<p><?php the_field('informacion_admin'); ?></p>
	</div>
</header>
