<?php

function mineco_api_tipos(): void {
	register_rest_route(
		"mineco/v1",
		"tipos",
		array(
			'methods' => 'GET',
			'callback' => 'mineco_get_tipos',
		)
	);

	register_rest_route(
		"mineco/v1",
		"tipos/(?P<id>\d+)",
		array(
			'methods' => 'GET',
			'callback' => 'mineco_get_tipo',
		)
	);

	register_rest_route(
		"mineco/v1",
		"tipos",
		array(
			'methods' => 'POST',
			'callback' => 'mineco_create_tipo',
		)
	);

	register_rest_route(
		"mineco/v1",
		"tipos/(?P<id>\d+)",
		array(
			'methods' => 'PUT',
			'callback' => 'mineco_update_tipo',
		)
	);
}

/**
 * Obtiene los tipos de ingresos de la base de datos.
 *
 * @return array|null Array de tipos de ingresos o NULL si no hay resultados.
 */

function mineco_get_tipos(): ?array {
	global $wpdb;
	$table_tipo_ingresos = $wpdb->prefix . 'tipo';
	$query = "SELECT * FROM $table_tipo_ingresos";
	$result = $wpdb->get_results($query);

	if ($result){
		return $result;
	}else{
		return $result;
	}

}

/**
 * Obtiene un tipo de ingreso específico de la base de datos.
 *
 * @param array $request Los datos de la solicitud que incluyen el ID del tipo de ingreso a obtener.
 *
 * @return array|null Array con los datos del tipo de ingreso o NULL si no se encuentra.
 */

function mineco_get_tipo( array $request): ?array {
	global $wpdb;

	$table_tipo_ingresos = $wpdb->prefix . 'tipo';
	$id = $request['id'];
	$query = "SELECT * FROM $table_tipo_ingresos WHERE id = $id";
	$result = $wpdb->get_row($query, ARRAY_A);

	if ($result) {
		return $result;
	} else {
		return null;
	}
}

/**
 * Crea un nuevo tipo de ingreso en la base de datos.
 *
 * @param array $request Los datos de la solicitud que incluyen la descripción del tipo de ingreso.
 *
 * @return bool|null Devuelve true si se crea el tipo de ingreso correctamente, de lo contrario devuelve false o null en caso de error.
 */

function mineco_create_tipo( array $request): ?bool {
	global $wpdb;

	$table_tipo_ingresos = $wpdb->prefix . 'tipo';

	$data = array(
		'descripcion' => $request->get_param('descripcion')
	);

	$results = $wpdb->insert($table_tipo_ingresos, $data);

	return $results;
}

/**
 * Actualiza un tipo de ingreso existente en la base de datos.
 *
 * @param array $request Los datos de la solicitud que incluyen el ID y la descripción del tipo de ingreso a actualizar.
 *
 * @return array|null Array con el resultado de la actualización (éxito o fallo) y un mensaje descriptivo.
 */

function mineco_update_tipo( array $request): ?array {
	global $wpdb;

	$table_tipo_ingresos = $wpdb->prefix . 'tipo';
	$id = $request['id'];
	$data = array(
		'descripcion' => $request->get_param('descripcion')
	);

	$where = array('id' => $id);

	$result = $wpdb->update($table_tipo_ingresos, $data, $where);

	if ($result !== false) {
		return array('success' => true, 'message' => 'Actualización exitosa');
	} else {
		return array('success' => false, 'message' => 'Error al realizar la actualización');
	}

}


add_action("rest_api_init", "mineco_api_tipos");
