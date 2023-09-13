<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 col-xxl-6">
                <img  class="img-fluid  mx-auto d-block" src="<?php echo get_template_directory_uri(); ?>/img/logo-menu.png" alt="logo">
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 col-xxl-6">
                <p class="text-center mt-3 text-white">
                    8a. Avenida 10-43 Zona 1. Guatemala, C.A. <br>
                    PBX (502) 2412-0200 <br>
                    Horarios de atención Lunes a Viernes 08:00 - 16:00Hrs
                </p>
		            <?php
		            $args = array(
			            'theme_location' => 'menu-footer',
			            'container' => false,
			            'menu_class' => 'text-center mt-3 custom-footer-list' // Aquí puedes agregar las clases que necesites
		            );
		            wp_nav_menu( $args );
		            ?>
            </div>
        </div>
        <div class="row">
            <p class="text-center m-0 text-white">&copy; <?php echo date('Y'); ?> Ministerio de Economía - <?php echo get_bloginfo('name') ?></p>
        </div>
    </div>
</footer>
 <?php wp_footer(); ?>
</body>
</html>
