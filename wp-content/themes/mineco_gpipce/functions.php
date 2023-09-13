<?php

require get_template_directory() . '/includes/widgets.php';
require get_template_directory() . '/includes/queries.php';
require get_template_directory() . '/includes/API/api-registro.php';
require get_template_directory() . '/includes/API/ControllerPeriodo.php';
require get_template_directory() . '/includes/API/ControllerFormularios.php';
require get_template_directory() . '/includes/API/ControllerTipos.php';


function mineco_gpipce_setup(){

	// imagenes destacadas

	add_theme_support('post-thumbnails');

	// titulos para SEO

	add_theme_support('title-tag');
}

add_action('after_setup_theme', 'mineco_gpipce_setup');

function mineco_gpipce_menus(): void {
	register_nav_menus( array(
		'menu-principal'    =>  __('Menu Principal','mineco'),
		'menu-administrador'    =>  __('Menu Adminstrador','mineco'),
		'menu-footer'    =>  __('Menu Footer','mineco')
	));
}

add_action('init', 'mineco_gpipce_menus');

function mineco_gpipce_scripts_style(): void {



//	wp_enqueue_style('normalize', 'https://necolas.github.io/normalize.css/8.0.1/normalize.css', array(), '8.0.1');
	wp_enqueue_style('fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css', array(), '4.5.0');
	wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.css', array(), '5.3.0');
	wp_enqueue_style('sweetalert', 'https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css', array(), '11.7.12');
	wp_enqueue_style('select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css', array(), '4.1.0');
	wp_enqueue_style('custom-sweetalert', get_template_directory_uri() . '/css/sweetalert-custom.css', array(), '1.0.1');
	wp_enqueue_style('custom-header', get_template_directory_uri() . '/css/headers.css', array(), '1.0.1');
	wp_enqueue_style('datables', 'https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.5/b-2.4.0/b-colvis-2.4.0/b-html5-2.4.0/b-print-2.4.0/date-1.5.0/fc-4.3.0/sp-2.2.0/sl-1.7.0/datatables.min.css', array(), '5.0.0');
	wp_enqueue_style('style', get_stylesheet_uri(), array('bootstrap','sweetalert'), '1.0.0');

	wp_enqueue_script('anime','https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js', array(), '2.0.2', true);
	wp_enqueue_script('chartjs','https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js', array(), '2.9.4', true);
	wp_enqueue_script( 'popper', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js', array('jquery'), '2.11.8', true );
	wp_enqueue_script( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js', array('popper'), '5.3.0', true );
	wp_enqueue_script( 'sweetalert', 'https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js', array('popper'), '11.7.12', true );
	wp_enqueue_script( 'pdfmake', 'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js', array(), '0.2.7', true );
	wp_enqueue_script( 'pdfmakefont', 'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js', array(), '0.2.7', true );
	wp_enqueue_script( 'datatables', 'https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.5/b-2.4.0/b-colvis-2.4.0/b-html5-2.4.0/b-print-2.4.0/date-1.5.0/fc-4.3.0/sp-2.2.0/sl-1.7.0/datatables.min.js', array('jquery'), '5.0.0', true );
	wp_enqueue_script( 'select2js', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', array(), '4.1.0', true );
	wp_enqueue_script('scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery','anime','chartjs','sweetalert'), '1.0.0', true);
	wp_enqueue_script('scripts-periodos', get_template_directory_uri() . '/js/Periodos.js', array('jquery','sweetalert'), '1.0.0', true);
	wp_enqueue_script('scripts-formularios', get_template_directory_uri() . '/js/Formularios.js', array('jquery','sweetalert'), '1.0.0', true);
	wp_localize_script("scripts","mineco",array(
		"rest_url"  => rest_url("mineco/v1")
	));
	wp_localize_script("scripts-periodos","mineco",array(
		"rest_url"  => rest_url("mineco/v1")
	));
	wp_localize_script("scripts-formularios","mineco",array(
		"rest_url"  => rest_url("mineco/v1"),
		"ajax_url" => admin_url("admin-ajax.php")
	));

}

add_action('wp_enqueue_scripts', 'mineco_gpipce_scripts_style');

function mineco_hero_imagen(){

	$front_id = get_option('page_on_front');

	$id_imagen = get_field('encabezado_imagen', $front_id);
	$id_imagen_admin = get_field('imagen_administrativa', $front_id);

	$imagen = wp_get_attachment_image_src($id_imagen, 'full')[0];
	$imagen_admin = wp_get_attachment_image_src($id_imagen_admin, 'full')[0];


	wp_register_style('custom', false);
	wp_enqueue_style('custom');
	$imagen_destacada_css = "
		body.home .header {
			background-image: linear-gradient( rgb(0 0 0 /.75), rgb( 0 0 0 / .75) ), url($imagen) ;
		}
		
		.header-admin{
			background-image: linear-gradient( rgb(0 0 0 /.75), rgb( 0 0 0 / .75) ), url($imagen_admin) ;
		}
		
		.header-registro{
			background-image: linear-gradient( rgb(0 0 0 /.75), rgb( 0 0 0 / .75) ), url($imagen_admin) ;
		}
	";
	wp_add_inline_style('custom',$imagen_destacada_css);
}

add_action('init','mineco_hero_imagen');

function mineco_widgets(){

	register_sidebar(array(
		'name'  =>  'Sidebar 1',
		'id'    =>  'sidebar_1',
		'before_widget' =>  '<div class="widget"></div>',
		'after_widget' =>  '</div>',
		'before_title'  =>  '<h3 class="text-center text-primary">',
		'after_title'  =>  '</h3>',
	));
}

add_action('widgets_init','mineco_widgets');


function add_fields_section( $user ): void {
	$unidades = mineco_get_unidades();
    $unidad_user_id = get_the_author_meta( 'unidad_id', $user->ID );
	?>
	<h3><?php _e('Dirección Administrativa / Unidad Ejecutora'); ?></h3>

	<table class="form-table">
		<tr>
			<th>
				<label for="unidad_id"><?php _e('Unidades'); ?></label>
			</th>
			<td>
                <select class="form-select"  name="unidad_id" id="unidad_id">
	                <?php
                        foreach ($unidades as $value) {
	                        $selected = '';
	                        if ($unidad_user_id && $unidad_user_id === $value->id) {
		                        $selected = 'selected';
	                        }
	                        echo '<option value="' . esc_attr($value->id) . '" ' . $selected . '>' . esc_html($value->descripcion) . '</option>';

                        }
	                ?>
                </select>
			</td>
		</tr>
	</table>
    <?php
}

add_action( 'show_user_profile', 'add_fields_section' );
add_action( 'edit_user_profile', 'add_fields_section' );

function save_fields_section( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) ) {
		return false;
	}

	if( isset($_POST['unidad_id']) ) {
		$unidad_id = sanitize_text_field($_POST['unidad_id']);
		update_user_meta( $user_id, 'unidad_id', $unidad_id );
	}
}

add_action( 'personal_options_update', 'save_fields_section' );
add_action( 'edit_user_profile_update', 'save_fields_section' );

function my_ajax_get_formulario_items(): void {
	$items = mineco_formularios_items();
	$profile = get_user_unit_by_id();

	$response = array(
		'items' => $items,
		'profile' => $profile
	);

	echo json_encode(array('data' => $response));
	exit();
}

add_action('wp_ajax_my_get_formulario_items', 'my_ajax_get_formulario_items');
add_action('wp_ajax_nopriv_my_get_formulario_items', 'my_ajax_get_formulario_items');

function remove_toolbar_items($wp_admin_bar): void {
	$wp_admin_bar->remove_node('wp-logo');
}
add_action('admin_bar_menu', 'remove_toolbar_items', 999);


function custom_login_logo(): void {
	echo '<style type="text/css">
        #login h1 a { background-image: url('.get_bloginfo('template_directory').'/images/custom-login-logo.png) !important; }
    </style>';
}
add_action('login_head', 'custom_login_logo');


function custom_login_page() {
	echo '<style type="text/css">
            .wpum-action-links {
                display: none !important;
            }
         </style>';
}
add_action('login_enqueue_scripts', 'custom_login_page');



