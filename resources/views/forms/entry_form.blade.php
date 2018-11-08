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
                    <div class="form-group mx-2">
                        <label for="no_orden" class="col-form-label-sm mb-0">Número de orden</label>
                        <input type="number" name="no_orden" id="no_orden" class="form-control form-control-sm" min="1" placeholder="Orden de pago">
                    </div>
                    <div class="form-group mx-2">
                        <label for="fecha_ingreso" class="col-form-label-sm mb-0">Fecha de ingreso</label>
                        <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control form-control-sm" value="{{old('fecha_ingreso', $now->format('Y-m-d'))}}">
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-default my-1">
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
        </div>
        <div class="card card-default my-1">
            <div class="card-header py-1">
                <div class="card-title">Información de la orden de pago</div>
            </div>
            <div class="card-body">
                <div class="table-responsive border border-secondary rounded">
                    <table id="order_entry" class="table table-bordered table-striped scroll-x">
                        <thead>
                            <th>Código</th>
                            <th>Descripción</th>
                            <th>Valor unitario</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="card card-default my-2">
                    <div class="card-header">
                        <div class="card-title">Información de pago</div>
                    </div>
                    <div class="card-body">
                        <!-- Información sobre el tipo de pago (Cuotas o Contado) -->
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
                                    <i class="far fa-id-card"></i>
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
</form>
