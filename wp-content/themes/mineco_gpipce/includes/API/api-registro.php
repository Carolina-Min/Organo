<?php

function mineco_api_registro(): void {
	register_rest_route(
		"mineco/v1",
		"registro",
		array(
			'methods' => 'POST',
			'callback' => 'mineco_registro_callback'
		)
	);
}

function mineco_registro_callback($request): string {
	global $wpdb;

	$table_name = $wpdb->prefix . 'detalles';
	$table_form = $wpdb->prefix . 'formulario_unidades';

	$form = array(
		'estado_id' => 2
	);

	$where = array('formulario_id' => $request["formulario_id"], 'unidad_id' => $request["unidad_id"]);


	$data = array(
		'nombre_accion' => $request["nombre_actividad"],
		'descripcion_actividad' => $request["descripcion_actividad"],
		'territorio_intervenido' => $request["territorio_actividad"],
		'presupuesto_invertido' => $request["presupuesto_actividad"],
		'retos' => $request["retos_actividad"],
		'desafios' => $request["desafios_actividad"],
		'medio_verificacion' => $request["medio_actividad"],
		'formulario_id' => $request["formulario_id"],
		'unidad_id' => $request["unidad_id"]
	);

	$result = $wpdb->insert($table_name, $data);
	$wpdb->update($table_form, $form, $where);

	if ($result) {
		return 'Registro Correcto!.';
	} else {
		return 'Error al insertar los datos.';
	}
}

function mineco_formularios_items(): ?array {
	global $wpdb;
	$user_id = get_current_user_id();
	$unidad_user_id = get_the_author_meta( 'unidad_id', $user_id );
	$table_formulario = $wpdb->prefix . 'formularios';
	$table_periodos = $wpdb->prefix . 'periodos';
	$table_tipo = $wpdb->prefix . 'tipo';
	$table_formulario_unidades = $wpdb->prefix . 'formulario_unidades';
	$query = "SELECT t.id, t.instrucciones, CONCAT('Del ',DATE_FORMAT(p.fecha_inicio, '%d/%m/%Y'), ' Al ', DATE_FORMAT(p.fecha_fin, '%d/%m/%Y')) as periodo, tt.descripcion as tipo FROM $table_formulario AS t INNER JOIN $table_periodos AS p ON t.periodo_id = p.id  INNER JOIN $table_tipo AS tt ON t.tipo_ingreso_id = tt.id  INNER JOIN $table_formulario_unidades AS fu ON t.id = fu.formulario_id WHERE fu.estado_id = 1 AND fu.unidad_id = $unidad_user_id";
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

function mineco_get_unidades(): ?array{
	global $wpdb;
	$table_unidades = $wpdb->prefix . 'unidades';
	$query = "SELECT id, descripcion FROM $table_unidades WHERE estado_id = 1";
	return $wpdb->get_results($query);

}



add_action("rest_api_init", "mineco_api_registro");
