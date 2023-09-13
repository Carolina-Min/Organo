<?php
	/*
	 * Template Name: Administrador de aplicación
	 */

get_header('admin');
$id_user = obtener_informacion_usuario_loggeado();
if($id_user['Profile'] === 'genero'){
?>

<main class="mb-5">
    <div class="container">
        <div class="card mt-5">
            <div class="card-body">
                <form role="form" id="periodos_data">
                    <div class="mb-3">
                        <label for="periodo_name" class="form-label">Periodo:</label>
                        <input type="text" class="form-control" id="periodo_name" name="periodo_name" required>
                        <div class="invalid-feedback">Por favor, ingresa el periodo.</div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <span>Fecha Inicial:</span>
                            <input type="date" class="form-control" placeholder="Fecha Ingreso" id="date_init" name="date_init" required>
                            <div class="invalid-feedback">Por favor, ingresa la fecha inicial.</div>
                        </div>
                        <div class="col-6">
                            <span>Fecha Final:</span>
                            <input type="date" class="form-control" placeholder="Fecha Ingreso" id="date_finish" name="date_finish" required>
                            <div class="invalid-feedback">Por favor, ingresa la fecha final.</div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary submit">Enviar</button>
                </form>
            </div>
        </div>

        <table class="table mt-5 table-bordered table-striped custom-border" id="tabla-periodos">
            <thead class="custom-table text-center">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Periodo</th>
                <th scope="col">Inicia</th>
                <th scope="col">Finaliza</th>
                <th scope="col">Opciones</th>
            </tr>
            </thead>
            <tbody class="text-center table-group-divider">
            </tbody>
        </table>

        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Editar Registro</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formularioEditar" role="form">
                            <div class="mb-3">
                                <input type="hidden" class="form-control" id="id_update" name="id_update">
                            </div>
                            <div class="mb-3">
                                <label for="edit_periodo_name" class="form-label">Periodo:</label>
                                <input type="text" class="form-control" id="edit_periodo_name" name="edit_periodo_name" required>
                                <div class="invalid-feedback">Por favor, ingresa el periodo.</div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <span>Fecha Inicial:</span>
                                    <input type="date" class="form-control" id="edit_date_init" name="edit_date_init" required>
                                    <div class="invalid-feedback">Por favor, ingresa la fecha inicial.</div>
                                </div>
                                <div class="col-6">
                                    <span>Fecha Final:</span>
                                    <input type="date" class="form-control" id="edit_date_finish" name="edit_date_finish" required>
                                    <div class="invalid-feedback">Por favor, ingresa la fecha final.</div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" form="formularioEditar">Guardar</button>
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
