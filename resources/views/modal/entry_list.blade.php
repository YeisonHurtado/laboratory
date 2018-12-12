<div class="modal fade" id="entryListModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static" data-keyboard="false" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Trabajos recepcionados</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="entry_list" class="table-responsive">
                    <table id="entryListTable" class="table table-sm table-striped table-hover scroll-x">
                        <thead>
                        <tr>
                            <th>Número de orden</th>
                            <th>Código de estudiante</th>
                            <th>Estudiante</th>
                            <th>Documento del paciente</th>
                            <th>Paciente</th>
                        </tr>
                        <tbody>

                        </tbody>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                <button type="button" id="ok_orden" class="btn btn-success" data-dismiss="modal" data-idOrden="" disabled><i class="fas fa-check"></i> Ok</button>
            </div>
        </div>
    </div>
</div>
