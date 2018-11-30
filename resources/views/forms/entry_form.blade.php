<form action="" method="post" id="entryForm" class="p-0">
    <input type="hidden" name="token_entry" id="token_entry" value="{{csrf_token()}}">
    <div class="modal-body">
        <div class="card card-default my-1">
            <div class="card-header py-1">
                <div class="card-title">
                    Consulta orden de pago
                </div>
            </div>
            <div class="card-body">
                <div class="row justify-content-start">
                    <div class="form-group col-md-5 mx-4">
                        <label for="no_orden" class="col-form-label-sm mb-0">Número de orden *</label>
                        <div class="input-group input-group-mini">
                            <input type="number" name="no_orden" id="no_orden" class="form-control form-control-sm" min="1" placeholder="Orden de pago">
                            <i class="fa fa-search"></i>
                        </div>
                        <div class="error-orden text-danger d-none">
                            Ingresa el número de orden.
                        </div>
                        <div class="not-order p-2 pl-4 alert alert-warning border-warning mt-2 text-warning d-none">
                            <strong>Éste número de orden no existe.</strong>
                        </div>
                    </div>
                    <div class="form-group col-md-5 mx-4">
                        <label for="fecha_ingreso" class="col-form-label-sm mb-0">Fecha de ingreso *</label>
                        <div class="input-group input-group-mini">
                            <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control form-control-sm" value="{{old('fecha_ingreso', $now->format('Y-m-d'))}}">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <div class="error-fechaIng text-danger d-none">
                            Fecha de ingreso incorrecta
                        </div>
                    </div>
                    <div class="form-group col-md-5 mx-4">
                        <label for="laboratoio" class="col-form-label-sm mb-0">Laboratorio *</label>
                        <div class="input-group input-group-mini">
                            <select name="laboratorio" id="laboratorio" class="form-control form-control-sm">

                            </select>
                            <i class="fas fa-flask"></i>
                        </div>
                        <div class="error-laboratorio text-danger d-none">
                            Debes escoger un proveedor.
                        </div>
                    </div>
                    <div class="form-group col-md-5 mx-4">
                        <label for="no_caja" class="col-form-label-sm mb-0">Número de caja</label>
                        <div class="input-group input-group-mini">
                            <select name="no_caja" id="no_caja" class="form-control form-control-sm">

                            </select>
                            <i class="fas fa-box"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--<div class="card card-default my-1">
            <div class="card-header py-1">
                <div class="card-title">
                    Información de factura
                </div>
            </div>
            <div class="card-body">
                <div class="row justify-content-start">
                    <div class="form-group mx-2">
                        <label for="no_factura" class="col-form-label-sm mb-0">Número de factura</label>
                        <input type="number" name="no_factura" id="no_factura" placeholder="Factura" min="1" class="form-control form-control-sm">
                    </div>
                    <div class="form-group mx-2">
                        <label for="recibo_caja" class="col-form-label-sm mb-0">Número recibo de caja</label>
                        <input type="number" name="recibo_caja" id="recibo_caja" placeholder="Recibo de caja" min="1" class="form-control form-control-sm">
                    </div>
                </div>
            </div>
        </div>-->
        <div class="card card-default my-1">
            <div class="card-header py-1">
                <div class="card-title">Información de la orden de pago</div>
            </div>
            <div class="card-body">
                <div class="card card-default my-2">
                    <div class="card-header">
                        <div class="card-title">
                            Producto(s)
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-danger text-danger border-danger error-factura d-none">
                            Debes ingresar el número de la factura, es obligatorio.
                        </div>
                        <div class="alert alert-danger text-danger border-danger error-caja d-none">
                            Debes ingresar el número de recibo de caja, es obligatorio.
                        </div>
                        <div class="table-responsive border border-secondary rounded">
                            <table id="order_entry" class="table table-bordered table-striped scroll-x">
                                <thead>
                                <th>Código</th>
                                <th>Descripción</th>
                                <th>Valor unitario</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                                <th>Factura</th>
                                <th>Recibo de caja</th>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <div class="form-group my-2">
                            <label for="preescripcion" class="col-form-label-sm mb-0">Preescripción</label>
                            <textarea name="preescripcion" id="preescripcion" class="form-control h-75"></textarea>
                            <div class="error-preescripcion text-danger d-none">
                                Ingresa la preescripción.
                            </div>
                        </div>
                        <div class="card card-default my-2">
                            <div class="card-header">
                                <div class="card-title">
                                    Articulador
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row p-1">
                                    <div class="alert alert-danger text-danger border-danger error-articulador col-md-12 d-none">
                                        Ingrese la información completa de los articuladores.
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="cant_art" class="col-form-label-sm mb-0">Número de articuladores</label>
                                        <select name="cant_art" id="cant_art" class="form-control form-control-sm">
                                            <option value="NA">N/A</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12" id="articulador_1">
                                            <label for="cod_art_1" class="col-form-label-sm mb-0">Código</label>
                                            <input type="text" name="cod_art[0]" id="cod_art_1" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="ob_art_1" class="col-form-label-sm mb-0">Observaciones del 1er articulador</label>
                                            <textarea name="ob_art[0]" id="ob_art_1" class="form-control form-control-sm h-75"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12" id="articulador_2">
                                            <label for="cod_art_2" class="col-form-label-sm mb-0">Código</label>
                                            <input type="text" name="cod_art[1]" id="cod_art_2" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="ob_art_2" class="col-form-label-sm mb-0">Observaciones del 2do articulador</label>
                                            <textarea name="ob_art[1]" id="ob_art_2" class="form-control form-control-sm h-75"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-default my-2">
                    <div class="card-header">
                        <div class="card-title">Información de pago</div>
                    </div>
                    <div class="card-body d-flex">
                        <!-- Información sobre el tipo de pago (Cuotas o Contado) -->
                        <div class="form-group col-md-6">
                            <label for="tipo_pago" class="col-form-label-sm mb-0">Tipo de pago</label>
                            <input type="text" name="tipo_pago" id="tipo_pago" class="form-control form-control-sm" value="" readonly>
                            <input type="hidden" name="id_payment" id="id_payment">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="total_cancelado" class="col-form-label-sm mb-0">Total cancelado</label>
                            <div class="input-group input-group-mini">
                                <input type="text" name="total_cancelado" id="total_cancelado" class="form-control form-control-sm" value="" readonly>
                                <i class="fa fa-dollar-sign"></i>
                            </div>
                        </div>
                        <div class="form-group"></div>
                        <input type="hidden" name="metodo_pago" id="metodo_pago">
                    </div>
                </div>
                <div class="card card-default my-2">
                    <div class="card-header">
                        <div class="card-title">
                            Información del estudiante
                        </div>
                    </div>
                    <div class="card-body lock">
                        <div class="screen-lock"></div>
                        <div class="row justify-content-start px-2">
                            <div class="form-group col-md-4">
                                <label for="codigo_est" class="col-form-label-sm mb-0">Código</label>
                                <div class="input-group input-group-mini">
                                    <input type="text" name="codigo_est" placeholder="Código de estudiante" id="codigo_est" class="form-control form-control-sm">
                                    <i class="fa fa-id-card"></i>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="nombre_est" class="col-form-label-sm mb-0">Nombre del estudiante</label>
                                <div class="input-group input-group-mini">
                                    <input type="text" name="nombre_est" placeholder="Nombre del estudiante" id="nombre_est" class="form-control form-control-sm">
                                    <i class="fa fa-user-graduate"></i>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="correo_est" class="col-form-label-sm mb-0">Correo</label>
                                <div class="input-group input-group-mini">
                                    <input type="email" name="correo_est" placeholder="Correo institucional" id="correo_est" class="form-control form-control-sm">
                                    <i class="fa fa-at"></i>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="tel_est" class="col-form-label-sm mb-0">Teléfono</label>
                                <div class="input-group input-group-mini">
                                    <input type="text" name="tel_est" placeholder="Teléfono o celular" id="tel_est" class="form-control form-control-sm">
                                    <i class="fa fa-mobile-alt"></i>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="semestre_est" class="col-form-label-sm mb-0">Semestre</label>
                                <div class="input-group input-group-mini">
                                    <select name="semestre_est" id="semestre_est" class="form-control form-control-sm">
                                        <option value="I">I</option>
                                        <option value="II">II</option>
                                        <option value="III">III</option>
                                        <option value="IV">IV</option>
                                        <option value="V">V</option>
                                        <option value="VI">VI</option>
                                        <option value="VII">VII</option>
                                        <option value="VIII">VIII</option>
                                    </select>
                                    <i class="fa fa-calendar-alt"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-default my-2">
                    <div class="card-header">
                        <div class="card-title">
                            Información del paciente
                        </div>
                    </div>
                    <div class="card-body lock">
                        <div class="screen-lock"></div>
                        <div class="row justify-content-start px-2">
                            <div class="form-group col-md-6">
                                <label for="doc_paciente" class="col-form-label-sm mb-0">Número de historia clínica</label>
                                <div class="input-group input-group-mini">
                                    <input type="text" name="doc_paciente" placeholder="Historia clínica" id="doc_paciente" class="form-control form-control-sm">
                                    <i class="far fa-file-alt"></i>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nombre_paciente" class="col-form-label-sm mb-0">Nombre del paciente</label>
                                <div class="input-group input-group-mini">
                                    <input type="text" name="nombre_paciente" placeholder="Nombre" id="nombre_paciente" class="form-control form-control-sm">
                                    <i class="far fa-user"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer flex-wrap">
        <div id="success_entry" class="alert alert-success text-success border-success col-md-12 col-sm-12 d-none">
            ¡Ingreso de trabajo guardado!
        </div>
        <div id="error_entry" class="alert alert-danger text-danger border-danger col-md-12 col-sm-12 d-none">
            No se pudo guardar. Intentelo de nuevo.
        </div>
        <div class="form-group">
            <button type="button" name="save_entry" id="save_entry" class="btn btn-primary btn-sm"><i class="fa fa-database"></i> Guardar</button>
            <button type="button" name="search_payment" id="search_payment" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> Segundo pago</button>
            <button type="button" name="exit_entry" id="exit_entry" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Salir</button>
        </div>
    </div>
</form>
