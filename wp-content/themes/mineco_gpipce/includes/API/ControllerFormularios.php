<?php

function mineco_api_formulario(): void {
	register_rest_route(
		"mineco/v1",
		"formularios",
		array(
			'methods' => 'GET',
			'callback' => 'mineco_get_formularios',
		)
	);

	register_rest_route(
		"mineco/v1",
		"formularios/(?P<id>\d+)",
		array(
			'methods' => 'GET',
			'callback' => 'mineco_get_formulario',
		)
	);

	register_rest_route(
		"mineco/v1",
		"formularios",
		array(
			'methods' => 'POST',
			'callback' => 'mineco_create_formulario',
		)
	);

	register_rest_route(
		"mineco/v1",
		"formularios/(?P<id>\d+)",
		array(
			'methods' => 'PUT',
			'callback' => 'mineco_update_formulario',
		)
	);

	register_rest_route(
		"mineco/v1",
		"formularios/(?P<id>\d+)",
		array(
			'methods' => 'DELETE',
			'callback' => 'mineco_delete_formulario',
		)
	);
}

/**
 * Esta función, llamada mineco_get_formularios, se encarga de obtener una lista de formularios desde la base de datos.
 * @return array|null Retorna un array con los formularios obtenidos desde la base de datos, o null si no se encontraron resultados.
 */

function mineco_get_formularios(): ?array {
	global $wpdb;
	$table_formulario = $wpdb->prefix . 'formularios';
	$table_periodos = $wpdb->prefix . 'periodos';
	$table_tipo = $wpdb->prefix . 'tipo';
	$query = "SELECT t.id, t.instrucciones, p.descripcion as periodo, tt.descripcion as tipo FROM $table_formulario AS t INNER JOIN $table_periodos AS p ON t.periodo_id = p.id  INNER JOIN $table_tipo AS tt ON t.tipo_ingreso_id = tt.id WHERE t.estado_id = 1";

	$results = $wpdb->get_results($query);

	if ($results) {
		$formatted_results = array();

		foreach ($results as $result) {
			$formatted_results[] = array(
				'id'    => $result->id,
				'instrucciones' => $result->instrucciones,
				'periodo' => $result->periodo,
				'tipo' => $result->tipo
			);
		}

		return array('data' => $formatted_results);
	} else {
		return array('data' => array());
	}

}

/**
 * Esta función, llamada mineco_get_formulario, se encarga de obtener un formulario específico desde la base de datos según su ID.
 * @param WP_REST_Request $request El objeto de solicitud que contiene los parámetros de la ruta, incluido el ID del formulario.
 * @return array|null Retorna un array asociativo con los datos del formulario encontrado, o null si no se encontró ningún formulario con el ID especificado.
 */

function mineco_get_formulario($request): ?array {
	global $wpdb;

	$table_formulario = $wpdb->prefix . 'formularios';
	$id = $request['id'];
	$query = "SELECT t.id, t.instrucciones, t.periodo_id as periodo, t.tipo_ingreso_id as tipo FROM $table_formulario AS t WHERE t.estado_id = 1 and t.id = $id";
	$result = $wpdb->get_row($query, ARRAY_A);

	if ($result) {
		return $result;
	} else {
		return null;
	}
}

/**
 * Esta función, llamada `mineco_create_formulario`, se encarga de crear un nuevo formulario en la base de datos.
 *
 * @param WP_REST_Request $request El objeto de solicitud que contiene los parámetros del formulario.
 * @return int|false Retorna el número de filas afectadas por la operación de inserción en la base de datos, o false si ocurrió un error.
 */

function mineco_create_formulario($request): ?int{
	global $wpdb;

	$table_formulario = $wpdb->prefix . 'formularios';
	$table_formulario_unidad = $wpdb->prefix . 'formulario_unidades';

	$data = array(
		'instrucciones' => $request->get_param('instrucciones'),
		'periodo_id' => $request->get_param('periodo_id'),
		'tipo_ingreso_id' => $request->get_param('tipo_id'),
		'estado_id' => 1
	);

	$id = $wpdb->insert($table_formulario, $data);

	if ($id !== false) {
		$form_id = $wpdb->insert_id;

		foreach ($request->get_param('unit') as $data_unit) {
			$form_data = array(
				'formulario_id' => $form_id,
				'unidad_id' => $data_unit
			);
			$wpdb->insert($table_formulario_unidad, $form_data);
		}

		return $wpdb->insert_id;
	} else {
		return null;
	}
}

/**
 * Esta función, llamada `mineco_update_formulario`, se encarga de actualizar un formulario existente en la base de datos.
 *
 * @param WP_REST_Request $request El objeto de solicitud que contiene los parámetros del formulario a actualizar, incluyendo el ID del formulario.
 *
 * @return array|null Retorna un array con información sobre el resultado de la actualización. Si la actualización fue exitosa, devuelve ['success' => true, 'message' => 'Actualización exitosa']. En caso de error, devuelve ['success' => false, 'message' => 'Error al realizar la actualización'].
 */
function mineco_update_formulario($request): ?array {
	global $wpdb;

	$table_formulario = $wpdb->prefix . 'formularios';
	$id = $request['id_update_form'];
	$data = array(
		'instrucciones' => $request->get_param('edit_form_name'),
		'periodo_id' => $request->get_param('periodo_id_edit'),
		'tipo_ingreso_id' => $request->get_param('tipo_id_edit'),
	);

	$where = array('id' => $id);

	$result = $wpdb->update($table_formulario, $data, $where);

	if ($result !== false) {
		return array('success' => true, 'message' => 'Actualización exitosa');
	} else {
		return array('success' => false, 'message' => 'Error al realizar la actualización');
	}

}


/**
 * Esta función, llamada `mineco_delete_formulario`, se encarga de marcar un formulario como eliminado en la base de datos.
 *
 * @param WP_REST_Request $request El objeto de solicitud que contiene los parámetros del formulario a eliminar, incluyendo el ID del formulario.
 *
 * @return array|null Retorna un array con información sobre el resultado de la eliminación. Si la eliminación fue exitosa, devuelve ['success' => true, 'message' => 'Actualización exitosa']. En caso de error, devuelve ['success' => false, 'message' => 'Error al realizar la actualización'].
 */
function mineco_delete_formulario($request): ?array {
	global $wpdb;

	$table_formulario = $wpdb->prefix . 'formularios';
	$id = $request['id'];
	$data = array(
		'estado_id' => 2
	);

	$where = array('id' => $id);

	$result = $wpdb->update($table_formulario, $data, $where);

	if ($result !== false) {
		return array('success' => true, 'message' => 'Actualización exitosa');
	} else {
		return array('success' => false, 'message' => 'Error al realizar la actualización');
	}
}


add_action("rest_api_init", "mineco_api_formulario");
