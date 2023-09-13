// Wrap every letter in a span

var textWrapper = document.querySelector('.ml2');
if(textWrapper){
    textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

    anime.timeline({loop: true})
        .add({
            targets: '.ml2 .letter',
            scale: [4,1],
            opacity: [0,1],
            translateZ: 0,
            easing: "easeOutExpo",
            duration: 950,
            delay: (el, i) => 70*i
        }).add({
        targets: '.ml2',
        opacity: 0,
        duration: 1000,
        easing: "easeOutExpo",
        delay: 1000
    });
}

/**
 * Crea un gráfico de barras utilizando la biblioteca Chart.js y lo muestra en un elemento de lienzo HTML5.
 * @param {string} name - El ID del elemento de lienzo HTML5 donde se mostrará el gráfico.
 */
function chartTable(name){
    var ctx = document.getElementById(name).getContext('2d');
    if(ctx){
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

}

/**
 * Agrega un registro enviando datos a través de una solicitud POST y muestra una notificación de éxito o error utilizando la biblioteca Swal.
 * La solicitud se realiza a la URL especificada en la variable `url` utilizando los datos del formulario con el ID `#registro_data`.
 */





jQuery(document).ready(function($) {
    /**
     * Funciones utilizadas para mostrar graficas representativas
     * dentro de los ingresos al sistema
     */

        var myChartElement = document.getElementById('myChart');
        if (myChartElement) {
            chartTable('myChart');
        }

        var myChart2Element = document.getElementById('myChart2');
        if (myChart2Element) {
            chartTable('myChart2');
        }


    /**
     * Llamado a la función de ingreso de Datos
     */


        let $select = document.getElementsByClassName('select_unit');
        if($select){
            jQuery('.select_unit').select2();
        }

})


