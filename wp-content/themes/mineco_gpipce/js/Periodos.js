

/**
 * Agrega un periodo enviando datos a través de una solicitud POST utilizando AJAX y muestra una notificación de éxito o error utilizando la biblioteca Swal.
 * La solicitud se realiza a la URL especificada en la variable `url` utilizando los datos del formulario pasado como parámetro.
 * Después de una respuesta exitosa, se reinicia el formulario y se actualiza la tabla de periodos.
 * En caso de error, se muestra una notificación de error.
 * @param {Element} form - El formulario que contiene los datos a enviar.
 */

function addPeriodo(form) {
    let url = `${mineco.rest_url}/periodos`;
    let $form = jQuery(form);

    jQuery(form).submit(function(e){
        e.preventDefault();
        let formData = new FormData(this);
        jQuery.ajax({
            data: formData,
            url: url,
            type: "post",
            processData: false,
            contentType: false,
            success: function(response){
                Swal.fire({
                    icon: 'success',
                    title: 'Registro de Información',
                    text: 'Se procedió a almacenar la información',
                    confirmButtonText: 'Aceptar'
                });
                $form[0].reset();
                table_periodos()
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error en la solicitud',
                    text: 'Ocurrió un error al enviar la información. Por favor, intenta nuevamente.',
                    confirmButtonText: 'Aceptar'
                });
            }
        });
    });
}

/**
 * Edita un periodo existente enviando datos a través de una solicitud POST utilizando AJAX y muestra una notificación de éxito o error utilizando la biblioteca Swal.
 * La solicitud se realiza a la URL especificada en la variable `url`, la cual se forma utilizando el ID del periodo pasado como parámetro y la URL base `mineco.rest_url`.
 * Se utiliza el formulario pasado como parámetro para obtener los datos a enviar.
 * Después de una respuesta exitosa, se reinicia el formulario y se actualiza la tabla de periodos.
 * En caso de error, se muestra una notificación de error.
 * @param {Element} form - El formulario que contiene los datos a enviar.
 * @param {string} id - El ID del periodo a editar.
 */

function editarPeriodo(form) {
    let $form = jQuery(form);

    jQuery(form).submit(function(e){
        e.preventDefault();
        let url = `${mineco.rest_url}/periodos-update`;
        let formData = new FormData(this);

        jQuery.ajax({
            data: formData,
            url: url,
            type: "post",
            processData: false,
            contentType: false,
            success: function(response){
                Swal.fire({
                    icon: 'success',
                    title: 'Registro de Información',
                    text: 'Dato actualizado',
                    confirmButtonText: 'Aceptar'
                });
                $form[0].reset();
                closeModal()
                table_periodos()
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error en la solicitud',
                    text: 'Ocurrió un error al enviar la información. Por favor, intenta nuevamente.',
                    confirmButtonText: 'Aceptar'
                });
            }
        });
    });
}

/**
 * Elimina un periodo mediante una solicitud PUT utilizando AJAX y muestra una notificación de éxito o error utilizando la biblioteca Swal.
 * La solicitud se realiza a la URL especificada en la variable `url`, la cual se forma utilizando el ID del periodo pasado como parámetro y la URL base `mineco.rest_url`.
 * @param {Event} event - El evento que desencadenó la llamada a la función.
 * @param {string} id - El ID del periodo a eliminar.
 */

function deletePeriodos(event, id) {
    event.preventDefault();

    let url = `${mineco.rest_url}/periodos/${id}`;
    jQuery.ajax({
        url: url,
        type: 'PUT',
        success: function(response) {
            Swal.fire({
                icon: 'success',
                title: 'Proceso realizado correctamente',
                text: 'Se procedió con exito',
                confirmButtonText: 'Aceptar'
            });
            table_periodos()
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}

/**
 * Crea una tabla interactiva utilizando el complemento DataTables y carga los datos de los periodos mediante una solicitud GET utilizando AJAX.
 * La tabla se genera en el elemento HTML con el ID 'tabla-periodos'.
 * Se realiza una destrucción previa de la tabla si ya existe para evitar conflictos.
 * Se definen las columnas de la tabla y se personalizan algunas configuraciones y estilos.
 * Se agregan botones de exportación a Excel y PDF utilizando los complementos Buttons, ExcelHtml5 y PdfHtml5.
 * Se utiliza la biblioteca Swal para mostrar notificaciones de éxito o error.
 */

function table_periodos(){
    let url = `${mineco.rest_url}/periodos`;

    if (jQuery.fn.DataTable.isDataTable('#tabla-periodos')) {
        jQuery('#tabla-periodos').DataTable().destroy();
    }

    jQuery('#tabla-periodos').DataTable({
        bDeferRender: true,
        searching: true,
        bLengthChange: true,
        pageLength: 5,
        sPaginationType: "full_numbers",
        ajax: {
            url: url,
            type: "GET"
        },
        columns: [
            { data: null },
            { data: "periodo" },
            { data: "fechainicio" },
            { data: "fechafin" },
            { data: "id"}
        ],
        rowCallback: function(row, data, index) {
            let api = this.api();
            jQuery('td:eq(0)', row).html(api.page.info().start + index + 1);
        },
        columnDefs: [
            {
                targets: 0,
                render: function(data, type, row, meta) {
                    return meta.row + 1;
                }
            },
            {
                targets: 4,
                render: function(data, type, row) {
                    return '<div class="button-group">' +
                        '<a href="#" onclick="deletePeriodos(event, ' + row.id + ')" data-id="' + row.id + '"><button type="button" class="editar btn btn-danger buttonExport"><i class="fa fa-trash-o" aria-hidden="true"></i></button></a>' +
                        '<a href="#" onclick="editPeriodosModal(' + row.id + ')" data-id="' + row.id + '"><button type="button" class="editar btn btn-primary buttonExport m-3"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>'
                    '</div>';
                }
            },
            { width: "40%", targets: 1 },
            { width: "20%", targets: 2 }
        ],
        language: {
            processing: "Procesando...",
            lengthMenu: 'Mostrar <select>' +
                '<option value="5">5</option>' +
                '<option value="10">10</option>' +
                '<option value="20">20</option>' +
                '<option value="30">30</option>' +
                '<option value="40">40</option>' +
                '<option value="50">50</option>' +
                '<option value="-1">All</option>' +
                '</select> registros',
            zeroRecords: "No se encontraron resultados",
            emptyTable: "Ningún dato disponible en esta tabla",
            info: "Mostrando del (_START_ al _END_) de un total de _TOTAL_ registros",
            infoEmpty: "Mostrando del 0 al 0 de un total de 0 registros",
            infoFiltered: "(filtrado de un total de _MAX_ registros)",
            infoPostFix: "",
            search: "Filtrar:",
            url: "",
            infoThousands: ",",
            loadingRecords: "Por favor espere - cargando...",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            },
            aria: {
                sortAscending: ": Activar para ordenar la columna de manera ascendente",
                sortDescending: ": Activar para ordenar la columna de manera descendente"
            }
        },
        initComplete: function() {
            jQuery('#tabla-periodos thead th').css('text-align', 'center');
            jQuery('.paginate_button').addClass('buttonExport');
        }
    });
}

/**
 * Carga los datos de un periodo específico mediante una solicitud POST utilizando AJAX y muestra un modal de edición con los datos cargados.
 * La solicitud se realiza a la URL especificada en la variable `url`, la cual se forma utilizando el ID del periodo pasado como parámetro y la URL base `mineco.rest_url`.
 * Los datos del periodo se asignan a los campos correspondientes en el modal de edición.
 * Se utiliza la biblioteca Bootstrap para mostrar el modal.
 * @param {string} id - El ID del periodo a editar.
 */

function editPeriodosModal(id){
    let url = `${mineco.rest_url}/periodos/${id}`;

    jQuery.ajax({
        url: url,
        method: 'POST',
        dataType: 'json',
        success: function(response) {
            document.getElementById('id_update').value = response.id;
            document.getElementById('edit_periodo_name').value = response.descripcion;
            document.getElementById('edit_date_init').value = response.fecha_inicio;
            document.getElementById('edit_date_finish').value = response.fecha_fin;

            const modal = new bootstrap.Modal(document.getElementById('editModal'));
            modal.show();
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });

}

/**

 Esta función, denominada closeModal, se utiliza para cerrar un modal en una página web.
 @description La función consta de los siguientes pasos:
 Utiliza getElementById() para obtener una referencia al elemento del DOM que representa el modal, identificado por el ID 'editModal'.
 Mediante getInstance(), obtiene la instancia del objeto Modal de Bootstrap asociado al elemento modal obtenido anteriormente.
 Finalmente, invoca el método hide() del objeto modal para ocultar el modal en la página web.
 @example
 closeModal();
 // Esta función se encarga de cerrar el modal con el ID 'editModal' en la página web.
 @returns {void} No devuelve ningún valor.
 @see bootstrap.Modal
 */
function closeModal(){
    const modalInstance = document.getElementById('editModal');
    var modal = bootstrap.Modal.getInstance(modalInstance)
    modal.hide();
}

jQuery(document).ready(function($) {


    /**
     * Llamado a la función para agregar datos del formulario hacia la tabla de periodos
     */

    if(document.getElementById('periodos_data')){
        addPeriodo('#periodos_data');
    }


    /**
     * Llamado a la función para mostrar el modal de edición
     */

    if(document.getElementById('formularioEditar')){
        editarPeriodo('#formularioEditar');
    }

    /**
     * Llamado a la función para mostrar el Datatable de Periodos
     */

    if(document.getElementById('tabla-periodos')){
        table_periodos()
    }


})
