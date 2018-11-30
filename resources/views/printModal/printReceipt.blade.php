<div class="modal fade" id="printReceiptModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="" id="printReceipt">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Imprimir ordenes de pago</h5>
                </div>
                <div class="modal-body">
                    <div class="row col-md-12 justify-content-center">
                        <div class="col-md-6">
                            <div class="card card-default mx-2 my-2">
                                <div class="card-header">
                                    <div class="card-title">
                                        Información del estudiante
                                    </div>
                                </div>
                                <div class="card-body lock">
                                    <div class="screen-lock"></div>
                                    <div class="form-group">
                                        <label for="printCodStu" class="col-form-label-sm mb-0">Código del estudiante</label>
                                        <div class="input-group input-group-mini">
                                            <input type="text" name="printCodStu" id="printCodStu" class="form-control form-control-sm">
                                            <i class="fa fa-id-card"></i>
                                        </div>
                                        <div class="form-group">
                                            <label for="printNameStudent" class="col-form-label-sm mb-0">Nombre del estudiante</label>
                                            <div class="input-group input-group-mini">
                                                <input type="text" name="printNameStudent" id="printNameStudent" class="form-control form-control-sm">
                                                <i class="fa fa-user-graduate"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-default mx-2 my-2">
                                <div class="card-header">
                                    <div class="card-title">
                                        Información del paciente
                                    </div>
                                </div>
                                <div class="card-body lock">
                                    <div class="screen-lock"></div>
                                    <div class="form-group">
                                        <label for="printCodPat" class="col-form-label-sm mb-0">Documento del paciente</label>
                                        <div class="input-group input-group-mini">
                                            <input type="text" name="printCodPat" id="printCodPat" class="form-control form-control-sm">
                                            <i class="fa fa-id-card"></i>
                                        </div>
                                        <div class="form-group">
                                            <label for="printNamePat" class="col-form-label-sm mb-0">Nombre del paciente</label>
                                            <div class="input-group input-group-mini">
                                                <input type="text" name="printNamePat" id="printNamePat" class="form-control form-control-sm">
                                                <i class="fa fa-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive my-4">
                        <table id="printReceiptTable" class="table table-striped">
                            <thead>
                            <tr>
                                <th>Código</th>
                                <th>Descripción</th>
                                <th>V. unitario</th>
                                <th>Cantidad</th>
                                <th>Imprimir</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" name="exit_print_reciept" id="exit_print_reciept" data-dismiss="modal" class="btn btn-danger btn-sm my-1"><i class="fas fa-ban"></i> Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
