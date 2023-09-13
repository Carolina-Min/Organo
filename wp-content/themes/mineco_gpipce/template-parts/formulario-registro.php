<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $items = mineco_formularios_items();
    $profile = get_user_unit_by_id();
    $deptos = mineco_deptos_callback();
    
?>
<div class="blog-card-container">
<?php
    foreach ($items['data'] as $value) {
        echo '<div class="blog-card mt-5">
            <div class="meta">
                <div class="photo" style="background-image: url(https://aprende.guatemala.com/wp-content/uploads/2020/08/dia-nacional-pueblos-indigenas-guatemala-decreto-242006.jpg)"></div>
                <ul class="details">
                    <li class="author">' . esc_attr( $value["tipo"] ) . '</li>
                    <li class="date">' . esc_attr( $value["periodo"] ) . '</li>
                </ul>
            </div>
            <div class="description">
                <h1>Registro de Datos</h1>
                <h2>'. esc_attr($profile[0]->descripcion ) .'</h2>
                <p>'. esc_attr($value["instrucciones"]) .' </p>
                <p class="read-more registration_form" data-bs-toggle="modal" data-bs-target="#modal_formulario" data-formulario="'. $value['id'] .'" data-unidad="'. $profile[0]->id .'" id="form_modal">
                    <a href="#">Llenar</a>
                </p>
            </div>
        </div>';
    }
?>
</div>

<div class="modal fade" id="modal_formulario" tabindex="-1" aria-labelledby="modal_formulario_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 modal-size " id="modal_formulario_label">Formulario de Registro</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form role="form" class="form-horizontal" id="registro_data">
                    <div class="form-group row">
                        <div class="mb-3">
                            <input type="hidden" name="formulario_id" id="formulario_id">
                            <input type="hidden" name="unidad_id" id="unidad_id">
                        </div>
                        <div class="mb-3">
                            <label for="nombre_actividad" class="form-label">Nombre de la Acción Realizada:</label>
                            <input type="text" class="form-control input" id="nombre_actividad" name="nombre_actividad">
                        </div>

                        <div class="mb-3">
                            <label for="descripcion_actividad" class="form-label">Descripción de la Actividad:</label>
                            <input type="select" class="form-control input" id="descripcion_actividad" name="descripcion_actividad">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="mb-3 col-6">
                            <label for="territorio_actividad" class="form-label">Lugar de Actividad:</label>
                            <!-- <input type="text" class="form-control input" id="territorio_actividad" name="territorio_actividad"> -->
                            <select class="form-select select" aria-label="Default select example" id="periodo_id" name="periodo_id" required>
                                    <option selected>Seleccione un Departamento</option>
	                                <?php
                                        foreach ($deptos['data'] as $value) {
                                            echo '<option value="' . esc_attr($value['id']) . '">' . esc_html($value['periodo']) . '</option>';
                                        }
	                                ?>
                                </select>
                                
                        </div>
                        <div class="mb-3 col-6">
                            <label for="territorio_actividad" class="form-label">Lugar de Actividad:</label>
                            <!-- <input type="text" class="form-control input" id="territorio_actividad" name="territorio_actividad"> -->
                            <select class="form-select select" aria-label="Default select example" id="periodo_id" name="periodo_id" required>
                                    <option selected>Seleccione un Periodo</option>
	                                <?php
                                        foreach ($deptos['data'] as $value) {
                                            echo '<option value="' . esc_attr($value['id']) . '">' . esc_html($value['periodo']) . '</option>';
                                        }
	                                ?>
                                </select>
                                
                        </div>
                        <div class="mb-3">
                            <label for="presupuesto_actividad" class="form-label">Presupuesto Invertido:</label>
                            <input type="text" class="form-control input" id="presupuesto_actividad" name="presupuesto_actividad">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="retos_actividad" class="form-label">Retos:</label>
                                <textarea class="form-control textarea" aria-label="With textarea" rows="4" id="retos_actividad" name="retos_actividad"></textarea>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="desafios_actividad" class="form-label">Desafíos:</label>
                                <textarea class="form-control textarea" aria-label="With textarea" rows="4" id="desafios_actividad" name="desafios_actividad"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="medio_actividad" class="form-label">Medio de Verificación:</label>
                                <input type="text" class="form-control input" id="medio_actividad" name="medio_actividad">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                            <button type="submit" class="btn btn-primary modal-size">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="alert_items">
<?php
    if (empty($items['data'])) {
        ?>
        <div class="alert alert-success" role="alert">
            No tiene ningun formulario para presentar!
        </div>
<?php
    }
?>
</div>

