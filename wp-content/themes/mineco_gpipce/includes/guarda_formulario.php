<?php

require_once( ABSPATH . 'wp-load.php' );

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	// Recuperar los datos del formulario
	$campo1 = sanitize_text_field($_POST["campo1"]);
	$campo2 = sanitize_textarea_field($_POST["campo2"]);
	$campo3 = intval($_POST["campo3"]);

	// Validar y limpiar los datos (agrega tus validaciones aquí)

	// Insertar los datos en la tabla personalizada
	global $wpdb;
	$nombre_tabla = $wpdb->prefix . 'mi_tabla'; // Agrega el mismo prefijo que usaste para crear la tabla
	$wpdb->insert(
		$nombre_tabla,
		array(
			'campo1' => $campo1,
			'campo2' => $campo2,
			'campo3' => $campo3,
		)
	);

	// Enviar la respuesta de vuelta a JavaScript
	echo json_encode(array('status' => 'success'));
}
