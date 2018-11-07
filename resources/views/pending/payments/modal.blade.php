<div class="modal fade" id="paymentsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pagos</h4>
                <button type="button" class="close" data-dismiss="modal" onclick="resetPaymentModal()">&times;</button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="payments" class="table table-sm table-hover scroll-x">
                        <thead>
                            <th>No. Factura</th>
                            <th>Código estudiante</th>
                            <th>Estudiante</th>
                            <th>Historia clínica</th>
                            <th>Paciente</th>
                            <th>Consignado</th>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <button type="button" id="pending_payment" class="btn btn-sm btn-success" data-id_orden="" data-id_factura="" data-dismiss="modal" disabled><i class="fa fa-check"></i> Listo</button>
                    <button type="button" id="ban_payment" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fa fa-ban"></i> Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>
