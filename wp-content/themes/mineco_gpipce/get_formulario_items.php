<?php
	$items = mineco_formularios_items();
	$profile = get_user_unit_by_id();

	$response = array(
		'items' => $items,
		'profile' => $profile
	);

	echo json_encode($response);

