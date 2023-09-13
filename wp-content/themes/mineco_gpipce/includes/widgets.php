<?php

if(!defined('ABSPATH')) die();

class Mineco_Actividades_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'mineco_widget',
			esc_html__( 'Mineco Actividades', 'mineco' ),
			array( 'description' => esc_html__( 'Agrega actividades como Widget', 'mineco' ), )
		);
	}

	public function widget( $args, $instance ) {
		?>
		<ul class="clases-sidebar">
			<?php
			$args = array(
				'post_type' => 'mineco_actividades',
				'posts_per_page' => $instance['cantidad']
			);
			$clases = new WP_Query($args);
			while($clases->have_posts()) {
				$clases->the_post();
				?>
				<li>
					<div class="imagen">
						<?php the_post_thumbnail('thumbnail'); ?>
					</div>
					<div class="contenido-clase">
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

	public function form( $instance ) {
		$cantidad = !empty($instance['cantidad']) ? $instance['cantidad'] : esc_html('¿Cuántas clases deseas mostrar?');
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('cantidad')) ?>">
				<?php esc_attr_e('¿Cuántas clases deseas mostrar?') ?>
			</label>

			<input
				class="widefat"
				id="<?php echo esc_attr($this->get_field_id('cantidad')) ?>"
				name="<?php echo esc_attr($this->get_field_name('cantidad')) ?>"
				type="number"
				value="<?php echo esc_attr($cantidad) ?>"
			/>
		</p>

		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['cantidad'] = (!empty($new_instance['cantidad'])) ? sanitize_text_field($new_instance['cantidad']) : '';
		return $instance;
	}
}

function mineco_registrar_widget(): void {
	register_widget( 'Mineco_Actividades_Widget' );
}
add_action( 'widgets_init', 'mineco_registrar_widget' );
