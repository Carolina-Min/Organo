<?php

function mineco_api_periodo(): void {

	register_rest_route(
		"mineco/v1",
		"periodos",
		array(
			'methods' => 'GET',
			'callback' => 'mineco_periodos_callback'
		)
	);
	register_rest_route(
		"mineco/v1",
		"deptos",
		array(
			'methods' => 'GET',
			'callback' => 'mineco_deptos_callback'
		)
	);

	register_rest_route(
		"mineco/v1",
		'periodos/(?P<id>\d+)',
		array(
			'methods' => 'PUT',
			'callback' => 'mineco_update_callback'
		)
	);

	register_rest_route(
		"mineco/v1",
		"periodos",
		array(
			'methods' => 'POST',
			'callback' => 'mineco_periodos_post'
		)
	);

	register_rest_route(
		"mineco/v1",
		'periodos/(?P<id>\d+)',
		array(
			'methods' => 'POST',
			'callback' => 'mineco_periodos_by_id'
		)
	);

	register_rest_route(
		"mineco/v1",
		'periodo/(?P<id>\d+)',
		array(
			'methods' => 'PUT',
			'callback' => 'mineco_periodos_by_id_update'
		)
	);

	register_rest_route(
		"mineco/v1",
		"periodos-update",
		array(
			'methods' => 'POST',
			'callback' => 'mineco_update_by_id'
		)
	);

}

/**
 * Esta función, llamada `mineco_update_callback`, se encarga de actualizar un registro en la tabla de periodos en la base de datos.
 *
 * @param WP_REST_Request $request El objeto de solicitud que contiene los parámetros para la actualización, incluido el ID del periodo.
 * @return bool|null Retorna true si la actualización fue exitosa, o null si ocurrió un error.
 */

function mineco_update_callback($request): ?bool {
	global $wpdb;
	$table_periodos = $wpdb->prefix . 'periodos';
	$periodo_id = $request->get_param('id');
	$data = array(
		'estado_id' => 2
	);
	$where = array(
		'id' => $periodo_id
	);
	$updated = $wpdb->update($table_periodos, $data, $where);
	return $updated;
}

/**
 * Esta función, llamada `mineco_periodos_callback`, se encarga de obtener todos los periodos de la base de datos.
 *
 * @return array|null Retorna un array con los periodos encontrados en la base de datos, o un array vacío si no se encontraron resultados.
 */

function mineco_periodos_callback(): ?array {
	global $wpdb;

	$table_periodos = $wpdb->prefix . 'periodos';

	$query = "SELECT * FROM $table_periodos WHERE estado_id = 1";

	$results = $wpdb->get_results($query);

	if ($results) {
		$formatted_results = array();

		foreach ($results as $result) {
			$formatted_results[] = array(
				'id'    => $result->id,
				'periodo' => $result->descripcion,
				'fechainicio' => $result->fecha_inicio,
				'fechafin' => $result->fecha_fin
			);
		}

		return array('data' => $formatted_results);
	} else {
		return array('data' => array());
	}
}

function mineco_deptos_callback(): ?array {
	global $wpdb;

	$table_periodos = $wpdb->prefix . 'periodos';

	$query = "SELECT * FROM $table_periodos WHERE estado_id = 1";

	$results = $wpdb->get_results($query);

	if ($results) {
		$formatted_results = array();

		foreach ($results as $result) {
			$formatted_results[] = array(
				'id'    => $result->id,
				'periodo' => $result->descripcion,
				'fechainicio' => $result->fecha_inicio,
				'fechafin' => $result->fecha_fin
			);
		}

		return array('data' => $formatted_results);
	} else {
		return array('data' => array());
	}
}

/**
 * Esta función, llamada `mineco_periodos_post`, se encarga de crear un nuevo periodo en la base de datos.
 *
 * @param WP_REST_Request $request El objeto de solicitud que contiene los parámetros del periodo a crear.
 * @return int|false Retorna el número de filas afectadas por la operación de inserción en la base de datos, o false si ocurrió un error.
 */

function mineco_periodos_post($request) {

	global $wpdb;

	$table_periodos = $wpdb->prefix . 'periodos';

	$data = array(
		'descripcion' => $request->get_param('periodo_name'),
		'fecha_inicio' => $request->get_param('date_init'),
		'fecha_fin' => $request->get_param('date_finish'),
		'estado_id' => 1
	);

	$results = $wpdb->insert($table_periodos, $data);

	return $results;
}

/**
 * Esta función, llamada `mineco_periodos_by_id`, se encarga de obtener un periodo específico desde la base de datos según su ID.
 *
 * @param WP_REST_Request $request El objeto de solicitud que contiene los parámetros de la consulta, incluido el ID del periodo.
 * @return array|null Retorna un array asociativo con los datos del periodo encontrado, o null si no se encontró ningún periodo con el ID especificado.
 */

function mineco_periodos_by_id($request): ?array {

	global $wpdb;

	$table_periodos = $wpdb->prefix . 'periodos';
	$id = $request->get_param('id');

	$query = "SELECT * FROM $table_periodos WHERE id = $id";
	$result = $wpdb->get_row($query, ARRAY_A);

	return $result;
}

/**
 * Esta función, llamada `mineco_periodos_by_id_update`, se encarga de actualizar un periodo específico en la base de datos según su ID.
 *
 * @param WP_REST_Request $request El objeto de solicitud que contiene los parámetros de la actualización, incluido el ID del periodo.
 * @return array Retorna un array con información sobre el resultado de la actualización. Si la actualización fue exitosa, devuelve ['success' => true, 'message' => 'Actualización exitosa']. En caso de error, devuelve ['success' => false, 'message' => 'Error al realizar la actualización'].
 */

function mineco_periodos_by_id_update($request): ?array {

	global $wpdb;

	$table_periodos = $wpdb->prefix . 'periodos';
	$id = $request->get_param('id');

	$data = array(
		'descripcion' => $request->get_param('periodo_name'),
		'fecha_inicio' => $request->get_param('date_init'),
		'fecha_fin' => $request->get_param('date_finish'),
	);

	$where = array('id' => $id);

	$result = $wpdb->update($table_periodos, $data, $where);

	if ($result !== false) {
		return array('success' => true, 'message' => 'Actualización exitosa');
	} else {
		return array('success' => false, 'message' => 'Error al realizar la actualización');
	}

}

/**
 * Esta función, llamada `mineco_update_by_id`, se encarga de actualizar un periodo específico en la base de datos según su ID.
 *
 * @param WP_REST_Request $request El objeto de solicitud que contiene los parámetros de la actualización, incluido el ID del periodo.
 * @return bool|null Retorna true si la actualización fue exitosa, o null si ocurrió un error.
 */

function mineco_update_by_id($request): ?bool {
	global $wpdb;
	$table_periodos = $wpdb->prefix . 'periodos';
	$periodo_id = $request->get_param('id_update');
	$data = array(
		'descripcion' => $request->get_param('edit_periodo_name'),
		'fecha_inicio' => $request->get_param('edit_date_init'),
		'fecha_fin' => $request->get_param('edit_date_finish')
	);
	$where = array(
		'id' => $periodo_id
	);
	$updated = $wpdb->update($table_periodos, $data, $where);
	return $updated;
}

add_action("rest_api_init", "mineco_api_periodo");
