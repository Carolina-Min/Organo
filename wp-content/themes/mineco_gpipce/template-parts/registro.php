<?php

	while( have_posts() ): the_post();
		if(has_post_thumbnail()){
			the_post_thumbnail();
		}
		the_content();
	endwhile;
?>
<div class="container mt-5">
    <div class="row">
        <h2>Instrucciones:</h2>
    </div>
</div>

<div class="row">
	<div class="col">
		<div class="card mt-5">
			<div class="card-header text-left text-bg-primary">
				Formulario de Registro
			</div>
			<div class="card-body">
				<form role="form" class="form-horizontal" id="registro_data">
					<div class="form-group row">
						<div class="mb-3">
							<label for="nombre_actividad" class="form-label">Nombre de la Acción Realizada:</label>
							<input type="text" class="form-control input" id="nombre_actividad" name="nombre_actividad">
						</div>

                        <div class="mb-3">
                            <label for="descripcion_actividad" class="form-label">Descripción de la Actividad:</label>
                            <input type="text" class="form-control input" id="descripcion_actividad" name="descripcion_actividad">
                        </div>
					</div>
					<div class="form-group row">
                        <div class="mb-3">
                            <label for="territorio_actividad" class="form-label">Territorio Intervenido:</label>
                            <input type="text" class="form-control input" id="territorio_actividad" name="territorio_actividad">
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
							<button type="submit" class="btn btn-primary submit">enviar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

