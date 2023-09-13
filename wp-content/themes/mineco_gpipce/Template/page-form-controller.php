<?php
/*
 * Template Name: Formularios
 */

get_header('form');
$options = mineco_periodos_callback();
$tipos = mineco_get_tipos();
$id_user = obtener_informacion_usuario_loggeado();
$unidades = mineco_get_unidades();
if($id_user['Profile'] === 'genero'){
	?>

	<main class="mb-5">
		<div class="container">
			<div class="card mt-5">
				<div class="card-body">
					<form role="form" id="formulario_data">
                        <div class="row">
                            <div class="col">
                                <span>Instrucciones del Formulario:</span>
                                <textarea class="form-control textarea" id="instrucciones" name="instrucciones" rows="3" required></textarea>
                            </div>
                        </div>
						<div class="row">
							<div class="col-6">
								<span>Periodo Asignado:</span>
                                <select class="form-select select" aria-label="Default select example" id="periodo_id" name="periodo_id" required>
                                    <option selected>Seleccione un Periodo</option>
	                                <?php
                                        foreach ($options['data'] as $value) {
                                            echo '<option value="' . esc_attr($value['id']) . '">' . esc_html($value['periodo']) . '</option>';
                                        }
	                                ?>
                                </select>
							</div>
							<div class="col-6">
								<span>Tipo de Ingreso</span>
                                <select class="form-select select" aria-label="Default select example" id="tipo_id" name="tipo_id" required>
                                    <option selected>Seleccione un Tipo</option>
	                                <?php
	                                foreach ($tipos as $value) {
		                                echo '<option value="' . esc_attr($value->id) . '">' . esc_html($value->descripcion) . '</option>';
	                                }
	                                ?>
                                </select>
							</div>
						</div>
                        <div class="row">
                            <div class="col-12">
                                <span>Unidades Asignadas:</span>
                                <select class="select_unit form-control"  name="unit[]" multiple="multiple">
	                                <?php
	                                foreach ($unidades as $value) {
		                                echo '<option value="' . esc_attr($value->id) . '">' . esc_html($value->descripcion) . '</option>';
	                                }
	                                ?>
                                </select>
                            </div>
                        </div>
						<button type="submit" class="btn btn-primary submit mt-3">Guardar</button>
					</form>
				</div>
			</div>
			<table class="table mt-5 table-bordered table-striped custom-border" id="tabla-formulario">
				<thead class="custom-table text-center">
				<tr>
					<th scope="col">#</th>
					<th scope="col">Instrucciones</th>
					<th scope="col">Periodo Asignado</th>
					<th scope="col">Tipo de Ingreso</th>
					<th scope="col">Opciones</th>
				</tr>
				</thead>
				<tbody class="text-center table-group-divider">
				</tbody>
			</table>
			<div class="modal fade" id="modal_edit_form" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="editModalLabel">Editar Registro</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<form id="formulario_editar" role="form">
								<div class="mb-3">
									<input type="text" class="form-control" id="id_update_form" name="id_update_form">
								</div>
								<div class="mb-3">
									<label for="edit_periodo_name" class="form-label">Periodo:</label>
									<input type="text" class="form-control" id="edit_form_name" name="edit_form_name" required>
									<div class="invalid-feedback">Por favor, ingresa el periodo.</div>
								</div>
                                <div class="row">
                                    <div class="col-6">
                                        <span>Periodo Asignado:</span>
                                        <select class="form-select select" aria-label="Default select example" id="periodo_id_edit" name="periodo_id_edit" required>
                                            <option selected>Seleccione un Periodo</option>
											<?php
											foreach ($options['data'] as $value) {
												echo '<option value="' . esc_attr($value['id']) . '">' . esc_html($value['periodo']) . '</option>';
											}
											?>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <span>Tipo de Ingreso</span>
                                        <select class="form-select select" aria-label="Default select example" id="tipo_id_edit" name="tipo_id_edit" required>
                                            <option selected>Seleccione un Tipo</option>
											<?php
											foreach ($tipos as $value) {
												echo '<option value="' . esc_attr($value->id) . '">' . esc_html($value->descripcion) . '</option>';
											}
											?>
                                        </select>
                                    </div>
                                </div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
							<button type="submit" class="btn btn-primary" form="formulario_editar">Guardar</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>

	<?php
}
else{
	?>

	<?php
}
get_footer();
?>
