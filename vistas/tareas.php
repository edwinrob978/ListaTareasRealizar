<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php">Inicio </a></li>
                    <li class="breadcrumb-item active">Tareas </li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <!-- Row para criterios de busqueda -->
        <div class="row">
            <!-- Row para listado de busqueda -->
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-striped w-100 shadow" id="tbl_Tareas">
                        <thead class="bg-info">
                            <tr>
                                <th id="micelda">Id</th>
                                <th>Tarea</th>
                                <th>Descripción</th>
                                <th>Id Estado</th>
                                <th id="estadoTarea">Estado</th>
                                <th class="text-center">Opciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-small">

                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

    <!-- Ventana modal para ingresar o modificar un Producto -->
    <div class="modal fade" id="mdlGestionarProducto" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- cabecera del modal -->
                <div class="modal-header bg-gray py-1 align-items-center">
                    <h5 class="modal-title">Agregar Tarea</h5>
                    <button type="button" class="btn btn-outline-primary text-white border-0 fs-5"
                        data-bs-dismiss="modal" id="btnCerrarModal">
                        <i class="far fa-times-circle"></i>
                    </button>
                </div>

                <!-- cuerpo del modal -->
                <div class="modal-body">

                    <form class="needs-validation" novalidate>

                        <!-- inicio de fila -->
                        <div class="row">

                            <!-- Nombre tarea-->
                            <div class="col-lg-5">
                                <div class="form-group mb-2">
                                    <label class="" for="iptNomTarea">
                                        <span class="small">Nombre tarea</span><span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control form-control-sm" id="iptNomTarea"
                                        name="iptNomTarea" placeholder="Nombre de la tarea" required>

                                    <div class="invalid-feedback">Ingrese el nombre de la tarea</div>
                                </div>
                            </div>

                            <!-- Descripción-->
                            <div class="col-lg-6">
                                <div class="form-group mb-2">
                                    <label class="" for="iptDescrip">
                                        <span class="small">Descripción</span><span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control form-control-sm" id="iptDescrip"
                                        name="iptDescrip" placeholder="Descrición" required>

                                    <div class="invalid-feedback">Ingrese la descripción</div>
                                </div>
                            </div>

                            <!-- Estado de la tarea-->
                            <div class="col-lg-6">
                                <div class="form-group mb-2">
                                    <label class="" for="selEstadoReg">
                                        <span class="small">Estado</span><span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                        id="selEstadoReg">
                                    </select>
                                    <span id="validate_categoria" class="text-danger small fst-italic"
                                        style="display:none">Debe ingresar el estado de la tarea</span>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <!-- Boton para guardar y cancelar el registro-->
                                <button type="button" class="btn btn-danger mt-4 mx-3" style="width:170px;"
                                    data-bs-dismiss="modal" id="btnCancelarRegistro">Cancelar</button>
                                <button type="button" class="btn btn-primary mt-4 mx-3" style="width:170px;"
                                    id="btnGuardarRegistro"> Guardar</button>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>


    <script>
    var accion;
    var table;

    var Toast = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        timer: 3000
    });

    $(document).ready(function() {

        //cargar select de categorias
        $.ajax({
            url: "ajax/estado.ajax.php",
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(respuesta) {

                var options = '<option selected value="">Seleccione un estado</option>';

                for (let index = 0; index < respuesta.length; index++) {
                    options = options + '<option value=' + respuesta[index][0] + '>' + respuesta[
                        index][
                        1
                    ] + '</option>';
                }

                $("#selEstadoReg").append(options);
            }
        });


        table = $("#tbl_Tareas").DataTable({

            dom: 'Bfrtip',
            buttons: [{
                    text: 'Agregar Tarea',
                    className: 'addNewRecord',
                    action: function(e, dt, mode, config) {

                        $("#mdlGestionarProducto").modal('show');
                        accion = 2;
                    }
                },
                'excel', 'print', 'pageLength'
            ],
            pageLength: [5, 10, 15, 30, 50, 100],
            pageLength: 10,
            ajax: {
                url: "ajax/tarea.ajax.php",
                dataSrc: '',
                type: 'POST',
                data: {
                    'accion': 1 //listar tareas
                },
            },
            responsive: {
                details: {
                    type: 'column'
                }
            },
            columnDefs: [{
                    targets: 0,
                    orderable: false,
                    className: 'control'
                },
                {
                    targets: 3,
                    orderable: false,
                    className: 'control'
                },
                {
                    targets: 5,
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return "<center>" +

                            "<span class='btnEditarTarea text-primary px-1' style='cursor:pointer;'>" +
                            "<i class='fas fa-pencil-alt fs-5'></i>" +
                            "</span>" +

                            "<span class='btnEliminarTarea text-danger px-1' style='cursor:pointer;'>" +
                            "<i class='fas fa-trash fs-5'></i>" +
                            "</span>" +

                            "</center>"
                    }
                }
            ],
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
            }
        });

        $("#btnCancelarRegistro, #btnCerrarModal").on('click', function() {

            $("#iptNomTarea").val('');
            $("#iptDescrip").val('');
            $("#selEstadoReg").val(0);

        })

    })

    //ACCION BOTON EDITAR TAREAS

    $('#tbl_Tareas tbody').on('click', '.btnEditarTarea', function() {

        $('#btnEditarTarea').attr('disabled', 'disabled');



        var data = table.row($(this).parents('tr')).data();

        $("#selEstadoReg").val(data["id_estado"]);



        if ($("#selEstadoReg").val() === '3') {

            $('#btnEditarTarea').attr('disabled', 'disabled');

        } else {

            $('#btnEditarTarea').removeAttr("disabled");

            accion = 4;

            $("#mdlGestionarProducto").modal('show');

            var data = table.row($(this).parents('tr')).data();

            $("#micelda").val(data["id"]);
            $("#iptNomTarea").val(data["nombre_tarea"]);
            $("#iptDescrip").val(data["descripcion_tarea"]);
            $("#selEstadoReg").val(data["id_estado"]);

        }

    })

    //ACCION BOTON BORRAR TAREAS
    $('#tbl_Tareas').on('click', '.btnEliminarTarea', function() {

        accion = 5;

        var data = table.row($(this).parents('tr')).data();

        var id = data["id"];

        Swal.fire({
            title: 'Estas seguro de eliminar esta tarea?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, deseo eliminarlo!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {

                var data = table.row($(this).parents('tr')).data();

                $("#selEstadoReg").val(data["id_estado"]);

                if ($("#selEstadoReg").val() === '3') {

                    var datos = new FormData();

                    datos.append("accion", accion);
                    datos.append("id", id);

                    $.ajax({
                        url: "ajax/tarea.ajax.php",
                        method: 'POST',
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(respuesta) {

                            if (respuesta == "ok") {

                                Toast.fire({
                                    icon: 'success',
                                    title: 'Se eliminó la tarea correctamente'
                                });

                                table.ajax.reload();

                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'La tarea no se pudo eliminar '
                                });
                            }
                        }
                    });

                } else {
                    Toast.fire({
                        icon: 'error',
                        title: 'La tarea no se puede eliminar (no esta finalizada)'
                    });

                }


            }
        })
    })

    //GUARDAR O ACTUALIZAR LAS TAREAS

    document.getElementById("btnGuardarRegistro").addEventListener("click", function() {

        var forms = document.getElementsByClassName('needs-validation');

        var validation = Array.prototype.filter.call(forms, function(form) {

            if (form.checkValidity() == true) {
                console.log("Listo para registrar la tarea")

                Swal.fire({
                    title: 'Estas seguro de registrar esta tarea?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, deseo registralo!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    
                    if (result.isConfirmed) {

                        var datos = new FormData();

                        datos.append("accion", accion);
                        datos.append("id", $("#micelda").val());
                        datos.append("nombre_tarea", $("#iptNomTarea").val());
                        datos.append("descripcion_tarea", $("#iptDescrip").val());
                        datos.append("id_estado", $("#selEstadoReg").val());

                        if (accion == 2) {
                            var titulo_msj = "La tarea se registró correctamente"
                        }

                        if (accion == 4) {
                            var titulo_msj = "La tarea se actualizó correctamente"
                        }


                        $.ajax({
                            url: "ajax/tarea.ajax.php",
                            method: 'POST',
                            data: datos,
                            cache: false,
                            contentType: false,
                            processData: false,
                            dataType: 'json',
                            success: function(respuesta) {

                                if (respuesta == "ok") {

                                    Toast.fire({
                                        icon: 'success',
                                        title: titulo_msj
                                    });

                                    table.ajax.reload();

                                    $("#mdlGestionarProducto").modal('hide');

                                    $("#iptNomTarea").val("");
                                    $("#iptDescrip").val("");
                                    $("#selEstadoReg").val(0);

                                } else {
                                    Toast.fire({
                                        icon: 'error',
                                        title: 'La tarea no se pudo registrar'
                                    });
                                }
                            }
                        });

                    }
                })
            } else {
                console.log("No paso la validación")
            }
            form.classList.add('was-validated');
        });
    });

    document.getElementById("btnCancelarRegistro").addEventListener("click", function() {
        $(".needs-validation").removeClass("was-validated");
    });
    </script>