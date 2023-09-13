<?php
get_header();
?>

<main class="mb-5">
    <section class="bienvenida seccion">
        <div class="container text-justify">
            <h1 class="card-title titulo"><?php the_field('encabezado_mision'); ?></h1>
            <hr class="m-hr">
            <p class=" m-label"><?php the_field('texto_mision'); ?></p>
        </div>
        <div class="container pt-5">
            <h1 class="card-title titulo"><?php the_field('vision_encabezado'); ?></h1>
            <hr class="m-hr">
            <p class="m-text-justify m-label"><?php the_field('texto_vision'); ?></p>
        </div>
        <div class="container pt-5">
            <h1 class="card-title titulo"><?php the_field('objetivo_encabezado'); ?></h1>
            <hr class="m-hr">
            <p class="m-text-justify m-label"><?php the_field('objetivo_texto'); ?></p>
        </div>
    </section>

    <section class="areas">
        <div class="area">
            <?php
                $area1 = get_field('genero');
            ?>

            <img src="<?php echo esc_attr($area1['imagen_genero']['sizes']['medium_large']); ?>" alt="<?php echo esc_attr($area1['texto']); ?>">
            <p><a href="<?php echo esc_html($area1['link']); ?>"><?php echo esc_html($area1['texto']); ?></a></p>
        </div>
        <div class="area">
            <?php
                $area1 = get_field('grupo_de_pueblo');
            ?>

            <img src="<?php echo esc_attr($area1['imagen']['sizes']['medium_large']); ?>" alt="<?php echo esc_attr($area1['texto']); ?>">
            <p><a href="<?php echo esc_html($area1['link']); ?>"><?php echo esc_html($area1['texto']); ?></a></p>
        </div>
        <div class="area">
            <?php
                $area1 = get_field('grupo_de_discapacidad');
            ?>

            <img src="<?php echo esc_attr($area1['imagen']['sizes']['medium_large']); ?>" alt="<?php echo esc_attr($area1['texto']); ?>">
            <p><a href="<?php echo esc_html($area1['link']); ?>"><?php echo esc_html($area1['texto']); ?></a></p>
        </div>
    </section>

    <section class="container mt-5" >
		<?php mineco_lista_actividad(3); ?>
    </section>


</main>

<?php
get_footer();
?>
