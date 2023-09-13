
function addFormulario(form) {
    let url = `${mineco.rest_url}/formularios`;
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
                jQuery('.select_unit').val(null).trigger('change');
                table_Formularios()
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

function editarFormulario(form) {
    let $form = jQuery(form);

    jQuery(form).submit(function(e){
        e.preventDefault();
        let $id  = jQuery("#id_update_form").val();
        let url = `${mineco.rest_url}/formularios/${$id}`;
        let formData = jQuery(this).serialize()
        jQuery.ajax({
            data: formData,
            url: url,
            type: "put",
            success: function(response){
                Swal.fire({
                    icon: 'success',
                    title: 'Registro de Información',
                    text: 'Dato actualizado',
                    confirmButtonText: 'Aceptar'
                });
                $form[0].reset();
                closeModal()
                table_Formularios()
            },
            error: function(xhr, status, error) {
                console.log(error)
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

function deleteFormularios(event, id) {
    event.preventDefault();

    let url = `${mineco.rest_url}/formularios/${id}`;
    jQuery.ajax({
        url: url,
        type: 'DELETE',
        success: function(response) {
            Swal.fire({
                icon: 'success',
                title: 'Proceso realizado correctamente',
                text: 'Se procedió con exito',
                confirmButtonText: 'Aceptar'
            });
            table_Formularios()
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}

function table_Formularios(){
    let url = `${mineco.rest_url}/formularios`;

    if (jQuery.fn.DataTable.isDataTable('#tabla-formulario')) {
        jQuery('#tabla-formulario').DataTable().destroy();
    }

    jQuery('#tabla-formulario').DataTable({
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
            { data: "instrucciones" },
            { data: "periodo" },
            { data: "tipo" },
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
                        '<a href="#" onclick="deleteFormularios(event, ' + row.id + ')" data-id="' + row.id + '"><button type="button" class="editar btn btn-danger buttonExport"><i class="fa fa-trash-o" aria-hidden="true"></i></button></a>' +
                        '<a href="#" onclick="editFormulariosModal(' + row.id + ')" data-id="' + row.id + '"><button type="button" class="editar btn btn-primary buttonExport m-3"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>'
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
            jQuery('#tabla-formulario thead th').css('text-align', 'center');
            jQuery('.paginate_button').addClass('buttonExport');
        }
    });
}

function editFormulariosModal(id){
    let url = `${mineco.rest_url}/formularios/${id}`;

    jQuery.ajax({
        url: url,
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            document.getElementById('id_update_form').value = response.id;
            document.getElementById('edit_form_name').value = response.instrucciones;
            document.getElementById('periodo_id_edit').value = response.periodo;
            document.getElementById('tipo_id_edit').value = response.tipo;

            const modal = new bootstrap.Modal(document.getElementById('modal_edit_form'));
            modal.show();
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });

}

function closeModal(){
    const modalInstance = document.getElementById('modal_edit_form');
    var modal = bootstrap.Modal.getInstance(modalInstance)
    modal.hide();
}

function addRegistro() {
    let url = `${mineco.rest_url}/registro`
    let url_ajax = `${mineco.ajax_url}`
    let $form = document.querySelector("#registro_data");

    if($form){
        $form.addEventListener("submit",function(e){
            e.preventDefault();
            let datos = new FormData($form);
            let datosParse = new URLSearchParams(datos);
            fetch(url,
                {
                    method: "POST",
                    body: datosParse
                }
            )
                .then(res=>res.json())
                .then(json=>{
                    Swal.fire({
                        icon: 'success',
                        title: 'Registro de Información',
                        text: 'Se procedio a almacenar la información',
                        confirmButtonText: 'Aceptar'
                    })
                    $form.reset()

                    const modalInstance = document.getElementById('modal_formulario');
                    var modal = bootstrap.Modal.getInstance(modalInstance)
                    modal.hide();

                    jQuery.ajax({
                        url: url_ajax,
                        type: 'post',
                        dataType: 'json',
                        data: {
                            action: 'my_get_formulario_items',
                        },
                        success: function (data) {
                            var container = jQuery('.blog-card-container');
                            var alert_container = jQuery('.alert_items');
                            container.empty();
                            alert_container.empty();
                            if(data.data.items.data.length > 0) {
                                data.data.items.data.forEach(function (item) {
                                    let html = '<div class="blog-card mt-5">\n' +
                                        '            <div class="meta">\n' +
                                        '                <div class="photo" style="background-image: url(https://aprende.guatemala.com/wp-content/uploads/2020/08/dia-nacional-pueblos-indigenas-guatemala-decreto-242006.jpg)"></div>\n' +
                                        '                <ul class="details">\n' +
                                        '                    <li class="author">' + item.tipo + '</li>\n' +
                                        '                    <li class="date">' + item.periodo + '</li>\n' +
                                        '                </ul>\n' +
                                        '            </div>\n' +
                                        '            <div class="description">\n' +
                                        '                <h1>Registro de Datos</h1>\n' +
                                        '                <h2>' + data.data.profile[0].descripcion + '</h2>\n' +
                                        '                <p>' + item.instrucciones + ' </p>\n' +
                                        '                <p class="read-more registration_form" data-bs-toggle="modal" data-bs-target="#modal_formulario" data-formulario="' + item.id + '" data-unidad="' + data.data.profile[0].id + '" id="form_modal">\n' +
                                        '                    <a href="#">Llenar</a>\n' +
                                        '                </p>\n' +
                                        '            </div>\n' +
                                        '        </div>' +
                                        '';
                                    container.append(html);

                                });
                            }else{
                                let html = '<div class="alert alert-success" role="alert">\n' +
                                    '            Todos los formularios fueron presentados \n' +
                                    '        </div>';

                                alert_container.append(html)
                            }
                            jQuery('#modal_formulario').modal('handleUpdate');
                        },
                        error: function (xhr, status, error) {
                            console.error('Error al obtener los datos del formulario:', error);
                        }
                    });

                })
                .catch(err=>{
                    Swal.fire({
                        title: 'Error!',
                        text: `Hay un error: ${err}`,
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    })
                })

        })
    }

}

jQuery(document).ready(function($) {


    /**
     * Llamado a la función para agregar datos del formulario hacia la tabla de periodos
     */

    if(document.getElementById('formulario_data')){
        addFormulario('#formulario_data');
    }


    /**
     * Llamado a la función para mostrar el modal de edición
     */

    if(document.getElementById('formulario_editar')){
        editarFormulario('#formulario_editar');
    }

    /**
     * Llamado a la función para mostrar el Datatable de Periodos
     */

    if(document.getElementById('tabla-formulario')){
        table_Formularios()
    }

    /**
     * Llamado a la función para guardar la información del formulario
     */
    if(document.getElementById('registro_data')){
        addRegistro();
    }

    if(document.getElementById('form_modal')){
        jQuery(document).on('click', '.registration_form a' ,function(e) {
            e.preventDefault();

            document.getElementById('formulario_id').value = $(this).parent().data('formulario');
            document.getElementById('unidad_id').value = $(this).parent().data('unidad');
        })
    }


})
