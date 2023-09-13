<?php


function mineco_lista_actividad($cantidad  = -1): void {
	?>
	<ul class="listado-grid">
		<?php
			$args = array(
				'post_type' => 'mineco_actividades',
				'posts_per_page' => $cantidad
			);
			
		$actividades = new WP_Query($args);
		while($actividades->have_posts()) {
			$actividades->the_post();
			?>
			<li class="card-actividad">
				<?php the_post_thumbnail(); ?>
				<div class="contenido">
					<a href="<?php the_permalink(); ?>">
						<h3><?php the_title(); ?></h3>
					</a>
					<p>
						<?php the_field('descripcion_de_actividad'); ?>
					</p>
				</div>
			</li>
			<?php
		}
		wp_reset_postdata();
		?>
	</ul>
	<?php
}

function get_user_unit_by_id(): ?array{
	$user_id = get_current_user_id();
	$unidad_user_id = get_the_author_meta( 'unidad_id', $user_id );
	global $wpdb;
	$table_unidades = $wpdb->prefix . 'unidades';
	$query = "SELECT id, descripcion FROM $table_unidades WHERE estado_id = 1 and id = $unidad_user_id";
	return $wpdb->get_results($query);

}



function obtener_informacion_usuario_loggeado() {
	$current_user_id = get_current_user_id();

	if ( $current_user_id ) {
		$current_user = get_userdata( $current_user_id );

		$user_roles   = $current_user->roles;
		$user_profile = reset( $user_roles );

		$user_data = array(
			'ID'      => $current_user_id,
			'Profile' => $user_profile
		);

		return $user_data;
	}



}
