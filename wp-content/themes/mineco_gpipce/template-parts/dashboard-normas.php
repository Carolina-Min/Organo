<?php
while( have_posts() ): the_post();
	if(has_post_thumbnail()) {
		the_post_thumbnail('full', array('class' => 'imagen-destacada'));
	}
	the_content();
endwhile;

?>
<main class="mt-5 mb-5">
    <div class="presupuesto">
        <div class="row">
            <!-- Artículo de Ley 1 -->
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ley de Propiedad Intelectual</h5>
                        <p class="card-text">Esta ley regula los derechos de autor, patentes y marcas en el país.</p>
                        <a href="#" class="btn btn-primary">Leer más</a>
                    </div>
                </div>
            </div>
            <!-- Artículo de Ley 2 -->
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ley de Protección de Datos</h5>
                        <p class="card-text">Esta ley establece las normas para el manejo y protección de datos personales.</p>
                        <a href="#" class="btn btn-primary">Leer más</a>
                    </div>
                </div>
            </div>
            <!-- Artículo de Ley 3 -->
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ley de Derechos del Consumidor</h5>
                        <p class="card-text">Esta ley protege los derechos e intereses de los consumidores y usuarios.</p>
                        <a href="#" class="btn btn-primary">Leer más</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
