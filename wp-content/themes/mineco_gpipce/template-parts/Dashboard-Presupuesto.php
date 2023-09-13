<?php
while( have_posts() ): the_post();
	if(has_post_thumbnail()) {
		the_post_thumbnail('full', array('class' => 'imagen-destacada'));
	}
	the_content();
endwhile;

?>
<main class="mt-5">
    <div class="presupuesto">
        <div class="row">
            <!-- Tarjeta de Ventas Totales -->
            <div class="col-sm-4">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="card-icon">&#x1F4B8;</div> <!-- Icono de dólar -->
                            <h5 class="card-title">Ventas Totales</h5>
                        </div>
                        <p class="card-text display-4">$10,000</p>
                    </div>
                </div>
            </div>
            <!-- Tarjeta de Usuarios Activos -->
            <div class="col-sm-4">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="card-icon">&#x1F465;</div> <!-- Icono de usuarios -->
                            <h5 class="card-title">Usuarios Activos</h5>
                        </div>
                        <p class="card-text display-4">1,200</p>
                    </div>
                </div>
            </div>
            <!-- Tarjeta de Metas Alcanzadas -->
            <div class="col-sm-4">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="card-icon">&#x1F3C1;</div> <!-- Icono de meta -->
                            <h5 class="card-title">Metas Alcanzadas</h5>
                        </div>
                        <div class="progress bg-dark">
                            <div class="progress-bar" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p class="card-text mt-2">75%</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-6">
            <div class="chart-container">
                <h2>Título del gráfico</h2>
                <canvas id="myChart" width="300" height="200" ></canvas>
            </div>
        </div>
        <div class="col-6">
            <div class="chart-container">
                <h2>Título del gráfico</h2>
                <canvas id="myChart2" width="300" height="200" ></canvas>
            </div>
        </div>
    </div>

</main>
