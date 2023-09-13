<?php

/*
    Plugin Name: Género, Pueblos Indigenas y Personas Con Capacidades Especiales - Migración de datos
    Plugin URI: https://mineco.gob.gt/
    Description: Departamento de Desarrollo -MINECO-
    Version: 1.0.0
	Requires at least: 5.8
	Requires PHP:      7.4
    Author: Juan José Jolón Granados
    Author URI: https://mineco.gob.gt/
	License: GPL2 v2 or later
	License URI:       https://www.gnu.org/licenses/gpl-2.0.html
    Text Domain: mineco
*/


if(!defined('ABSPATH')) die();

function insert_estados($table): void {
	global $wpdb;

	$wpdb->insert($table, array(
		'descripcion'   =>  'Activo'
	));

	$wpdb->insert($table, array(
		'descripcion'   =>  'Inactivo'
	));

}

function insert_tipos($table): void {
	global $wpdb;

	$wpdb->insert($table, array(
		'descripcion'   =>  'Género'
	));

	$wpdb->insert($table, array(
		'descripcion'   =>  'Pueblo'
	));

	$wpdb->insert($table, array(
		'descripcion'   =>  'Discapacidad'
	));

}

function insert_estados_formularios($table): void {
	global $wpdb;

	$wpdb->insert($table, array(
		'descripcion'   =>  'Borrador'
	));

	$wpdb->insert($table, array(
		'descripcion'   =>  'Completo'
	));

	$wpdb->insert($table, array(
		'descripcion'   =>  'Incompleto'
	));

	$wpdb->insert($table, array(
		'descripcion'   =>  'Finalizado'
	));

}

function insert_unidades($table): void {
	global $wpdb;

	$wpdb->query("INSERT INTO $table (`descripcion`, `estado_id`) VALUES ('Despacho Superior', 1)");
	$wpdb->query("INSERT INTO $table (`descripcion`, `estado_id`) VALUES ('Tecnologías de la Información', 1)");
	$wpdb->query("INSERT INTO $table (`descripcion`, `estado_id`) VALUES ('Asuntos Jurídicos', 1)");
	$wpdb->query("INSERT INTO $table (`descripcion`, `estado_id`) VALUES ('Secretaría General', 1)");
	$wpdb->query("INSERT INTO $table (`descripcion`, `estado_id`) VALUES ('Genero, Pueblos Indígenas y Personas con Capacidades Especiales', 1)");
	$wpdb->query("INSERT INTO $table (`descripcion`, `estado_id`) VALUES ('Planificación, Proyectos y Cooperación', 1)");
	$wpdb->query("INSERT INTO $table (`descripcion`, `estado_id`) VALUES ('Política y Análisis Económico', 1)");
	$wpdb->query("INSERT INTO $table (`descripcion`, `estado_id`) VALUES ('Comunicación Social', 1)");
	$wpdb->query("INSERT INTO $table (`descripcion`, `estado_id`) VALUES ('Auditoría Interna', 1)");
	$wpdb->query("INSERT INTO $table (`descripcion`, `estado_id`) VALUES ('Dirección de Servicios al Comercio y la Inversión', 1)");
	$wpdb->query("INSERT INTO $table (`descripcion`, `estado_id`) VALUES ('Dirección del Sistema Nacional de la Calidad', 1)");
	$wpdb->query("INSERT INTO $table (`descripcion`, `estado_id`) VALUES ('Dirección de Promoción a la Competencia', 1)");
	$wpdb->query("INSERT INTO $table (`descripcion`, `estado_id`) VALUES ('Dirección de Atención y Asistencia al Consumidor', 1)");
	$wpdb->query("INSERT INTO $table (`descripcion`, `estado_id`) VALUES ('Programa Nacional de la Competitividad', 1)");
	$wpdb->query("INSERT INTO $table (`descripcion`, `estado_id`) VALUES ('Registro del Mercado de Valores y Mercancías', 1)");
	$wpdb->query("INSERT INTO $table (`descripcion`, `estado_id`) VALUES ('Registro Mercantil General de la República', 1)");
	$wpdb->query("INSERT INTO $table (`descripcion`, `estado_id`) VALUES ('Registro de la Propiedad Intelectual', 1)");
	$wpdb->query("INSERT INTO $table (`descripcion`, `estado_id`) VALUES ('Registro de Garantías Mobiliarias', 1)");
	$wpdb->query("INSERT INTO $table (`descripcion`, `estado_id`) VALUES ('Registro de Prestadores de Servicios de Certificación', 1)");
	$wpdb->query("INSERT INTO $table (`descripcion`, `estado_id`) VALUES ('Dirección de Política de Comercio Exterior', 1)");
	$wpdb->query("INSERT INTO $table (`descripcion`, `estado_id`) VALUES ('Dirección de Administración del Comercio Exterior', 1)");
	$wpdb->query("INSERT INTO $table (`descripcion`, `estado_id`) VALUES ('Misión Permanente de Guatemala Ante la Organización Mundial del Comercio', 1)");
	$wpdb->query("INSERT INTO $table (`descripcion`, `estado_id`) VALUES ('Dirección de Servicios Financieros Empresariales', 1)");
	$wpdb->query("INSERT INTO $table (`descripcion`, `estado_id`) VALUES ('Dirección de Servicios de Desarrollo Empresarial', 1)");
	$wpdb->query("INSERT INTO $table (`descripcion`, `estado_id`) VALUES ('Dirección Administrativa', 1)");
	$wpdb->query("INSERT INTO $table (`descripcion`, `estado_id`) VALUES ('Dirección de Adquisiciones y Contrataciones', 1)");
	$wpdb->query("INSERT INTO $table (`descripcion`, `estado_id`) VALUES ('Dirección Financiera', 1)");
	$wpdb->query("INSERT INTO $table (`descripcion`, `estado_id`) VALUES ('Dirección de Recursos Humanos', 1)");
	$wpdb->query("INSERT INTO $table (`descripcion`, `estado_id`) VALUES ('Dirección de Desarrollo Institucional', 1)");
	$wpdb->query("INSERT INTO $table (`descripcion`, `estado_id`) VALUES ('Unidad Ejecutora del Programa de apoyo al Comercio Exterior y la Integración', 1)");
}

function mineco_wp_organo_tables(): void {
	global $wpdb;

	/**
	 * Configuración de nombres de tablas
	 */

		$table_estados_general = $wpdb->prefix . 'estados'; // Activo, Inactivo , no necesita formulario frontend - ya
		$table_periodos = $wpdb->prefix . 'periodos'; // si necesita formuario -ya
		$table_tipo_ingresos = $wpdb->prefix . 'tipo'; // Genero, Pueblo y discapacidad, no necesita formulario - ya
		$table_estados_formulario = $wpdb->prefix . 'estado_formulario'; // Borrador, Completo, Incompleto, Finalizado no necesita formulario - ya
		$table_formularios = $wpdb->prefix . 'formularios'; // descripcion general del formulario. instrucciones generales
		$table_unidades = $wpdb->prefix . 'unidades'; // no necesita formulario - ya
		$table_detalles_formulario = $wpdb->prefix . 'detalles'; // los formularios ingresados con su estado,
		$table_formulario_unidades = $wpdb->prefix . 'formulario_unidades'; // asociación de formulario con unidades,


	/**
	 *  Configuración de Esquema
	 */


		if ( $wpdb->get_var( "SHOW TABLES LIKE '$table_estados_general'" ) != $table_estados_general ) {

			$sql = "CREATE TABLE $table_estados_general (
		        id INT NOT NULL AUTO_INCREMENT,
		        descripcion NVARCHAR(50) NULL,
		        PRIMARY KEY (id)
		    ) ENGINE = InnoDB;";

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta($sql);

			insert_estados($table_estados_general);
		}

		if ( $wpdb->get_var( "SHOW TABLES LIKE '$table_periodos'" ) != $table_periodos ) {

			$sql = "CREATE TABLE $table_periodos (
	        id INT NOT NULL AUTO_INCREMENT,
	        descripcion VARCHAR(45) NULL,
	        fecha_inicio DATE NULL,
	        fecha_fin DATE NULL,
	        estado_id INT NOT NULL,
	        PRIMARY KEY (id),
	        INDEX fk_periodos_EstadosG1_idx (estado_id ASC),
	        CONSTRAINT fk_periodos_EstadosG1
	            FOREIGN KEY (estado_id)
	            REFERENCES $table_estados_general (id)
	            ON DELETE NO ACTION
	            ON UPDATE NO ACTION
	    ) ENGINE = InnoDB;";

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta($sql);
		}

		if ( $wpdb->get_var( "SHOW TABLES LIKE '$table_tipo_ingresos'" ) != $table_tipo_ingresos ) {

			$sql = "CREATE TABLE $table_tipo_ingresos (
		          id INT NOT NULL AUTO_INCREMENT,
				  descripcion NVARCHAR(50) NULL,
				  PRIMARY KEY (id))
				ENGINE = InnoDB;";

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta($sql);

			insert_tipos($table_tipo_ingresos);
		}

		if ( $wpdb->get_var( "SHOW TABLES LIKE '$table_estados_formulario'" ) != $table_estados_formulario  ) {

			$sql = "CREATE TABLE $table_estados_formulario  (
		          id INT NOT NULL AUTO_INCREMENT,
				  descripcion VARCHAR(45) NULL,
				  PRIMARY KEY (id))
				ENGINE = InnoDB;";

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta($sql);

			insert_estados_formularios($table_estados_formulario);
		}

		if ( $wpdb->get_var( "SHOW TABLES LIKE '$table_formularios'" ) != $table_formularios  ) {

			$sql = "CREATE TABLE $table_formularios  (
	        id INT NOT NULL AUTO_INCREMENT,
	        instrucciones VARCHAR(450) NULL,
	        periodo_id INT NOT NULL,
	        tipo_ingreso_id INT NOT NULL,
	        estado_id INT NOT NULL,
	        PRIMARY KEY (id),
	        INDEX fk_formularios_periodos1_idx (periodo_id ASC) ,
	        INDEX fk_formularios_TipoIngreso1_idx (tipo_ingreso_id ASC) ,
	        INDEX fk_formularios_EstadosFormulario1_idx (estado_id ASC) ,
	        CONSTRAINT fk_formularios_periodos1
	            FOREIGN KEY (periodo_id)
	            REFERENCES $table_periodos (id)
	            ON DELETE NO ACTION
	            ON UPDATE NO ACTION,
	        CONSTRAINT fk_formularios_TipoIngreso1
	            FOREIGN KEY (tipo_ingreso_id)
	            REFERENCES $table_tipo_ingresos (id)
	            ON DELETE NO ACTION
	            ON UPDATE NO ACTION,
	        CONSTRAINT fk_formularios_EstadosFormulario1
	            FOREIGN KEY (estado_id)
	            REFERENCES $table_estados_formulario (id)
	            ON DELETE NO ACTION
	            ON UPDATE NO ACTION
	    ) ENGINE = InnoDB;";

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta($sql);
		}

		if ( $wpdb->get_var( "SHOW TABLES LIKE '$table_unidades'" ) != $table_unidades  ) {

			$sql = "CREATE TABLE $table_unidades  (
	        id INT NOT NULL AUTO_INCREMENT,
	        descripcion VARCHAR(255) NULL,
	        estado_id INT NOT NULL,
	        PRIMARY KEY (id),
	        INDEX fk_Unidades_EstadosG1_idx (estado_id ASC) ,
	        CONSTRAINT fk_Unidades_EstadosG1
	            FOREIGN KEY (estado_id)
	            REFERENCES $table_estados_general (id)
	            ON DELETE NO ACTION
	            ON UPDATE NO ACTION
	    ) ENGINE = InnoDB;";

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta($sql);

			insert_unidades($table_unidades);
		}

		if ( $wpdb->get_var( "SHOW TABLES LIKE '$table_detalles_formulario'" ) != $table_detalles_formulario  ) {

			$sql = "CREATE TABLE $table_detalles_formulario  (
	        id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	        nombre_accion NVARCHAR(1000) NULL,
	        descripcion_actividad NVARCHAR(1000) NULL,
	        territorio_intervenido NVARCHAR(1000) NULL,
	        presupuesto_invertido DECIMAL(18,2) NULL,
	        retos NVARCHAR(1000) NULL,
	        desafios NVARCHAR(1000) NULL,
	        medio_verificacion NVARCHAR(1000) NULL,
	        formulario_id INT NOT NULL,
	        unidad_id INT NOT NULL,
	        PRIMARY KEY (id),
	        INDEX fk_DetallesFormulario_formularios1_idx (formulario_id ASC),
	        INDEX fk_DetallesFormulario_Unidades1_idx (unidad_id ASC),
	        CONSTRAINT fk_DetallesFormulario_formularios1
	            FOREIGN KEY (formulario_id)
	            REFERENCES $table_formularios (id)
	            ON DELETE NO ACTION
	            ON UPDATE NO ACTION,
	        CONSTRAINT fk_DetallesFormulario_Unidades1
	            FOREIGN KEY (unidad_id)
	            REFERENCES $table_unidades (id)
	            ON DELETE NO ACTION
	            ON UPDATE NO ACTION
	    ) ENGINE = InnoDB;";

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta($sql);
		}

		if ( $wpdb->get_var( "SHOW TABLES LIKE '$table_formulario_unidades'" ) != $table_formulario_unidades  ){
				$sql = "CREATE TABLE $table_formulario_unidades  (
			        id INT UNSIGNED NOT NULL AUTO_INCREMENT,
			        formulario_id INT NOT NULL,
			        unidad_id INT NOT NULL,
			        estado_id INT NOT NULL DEFAULT 1,
			        PRIMARY KEY (id),
			        INDEX fk_DetallesFormulario_formularios1_idx (formulario_id ASC),
			        INDEX fk_DetallesFormulario_Unidades1_idx (unidad_id ASC),
			        INDEX fk_Unidades_EstadosG1_idx (estado_id ASC) ,
			        CONSTRAINT fk_formulario_unidades
			            FOREIGN KEY (formulario_id)
			            REFERENCES $table_formularios (id)
			            ON DELETE NO ACTION
			            ON UPDATE NO ACTION,
			        CONSTRAINT fk_unidades_formulario
			            FOREIGN KEY (unidad_id)
			            REFERENCES $table_unidades (id)
			            ON DELETE NO ACTION
			            ON UPDATE NO ACTION,
                	CONSTRAINT fk_estados_unidades_formularios
			            FOREIGN KEY (estado_id)
			            REFERENCES $table_estados_formulario (id)
			            ON DELETE NO ACTION
			            ON UPDATE NO ACTION
			    ) ENGINE = InnoDB;";

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta($sql);
		}


}

register_activation_hook(__FILE__, 'mineco_wp_organo_tables');

function mineco_qp_organo_dropTable(): void {

	global $wpdb;

	/**
	 * Configuración de nombres de tablas
	 */

	$table_estados_general = $wpdb->prefix . 'estados';
	$table_periodos = $wpdb->prefix . 'periodos';
	$table_tipo_ingresos = $wpdb->prefix . 'tipo';
	$table_estados_formulario = $wpdb->prefix . 'estado_formulario';
	$table_formularios = $wpdb->prefix . 'formularios';
	$table_unidades = $wpdb->prefix . 'unidades';
	$table_detalles_formulario = $wpdb->prefix . 'detalles';
	$table_formulario_unidades = $wpdb->prefix . 'formulario_unidades';

	$tablas = array(
		$table_estados_general,
		$table_periodos,
		$table_tipo_ingresos,
		$table_estados_formulario,
		$table_formularios,
		$table_unidades,
		$table_detalles_formulario,
		$table_formulario_unidades
	);

	foreach ($tablas as $tabla) {
		$consulta = "DROP TABLE IF EXISTS $tabla;";
		$wpdb->query($consulta);
	}
}

register_uninstall_hook(__FILE__, 'mineco_qp_organo_dropTable');

//if(! function_exists('mineco_option_page')){
//	function mineco_option_page(){
//		add_menu_page(
//			''
//		);
//	}
//}


