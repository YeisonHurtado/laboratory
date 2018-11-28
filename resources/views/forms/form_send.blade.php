<form action="">
    {{ csrf_field() }}
    <div class="modal-body">
        <div class="card card-default">
            <div class="card-header">
                <div class="card-title">Trabajos pendientes para despachar</div>
            </div>
            <div class="card-body">
                <div class="table-responsive" id="reception">
                    <table id="reception_table" class="table table-bordered table-sm table-striped table-dark">
                        <thead>
                        <tr>
                            <th>Fecha de ingreso</th>
                            <th>Orden de pago</th>
                            <th>Factura</th>
                            <th>Metodo de pago</th>
                            <th>Código estudiante</th>
                            <th>Nombre estudiante</th>
                            <th>Número historia clínica</th>
                            <th>Nombre paciente</th>
                            <th>Laboratorio</th>
                            <th>Preescripción</th>
                            <th>Despachar</th>
                            <th>No despachar</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="success-envio alert alert-success border-success text-success my-3 d-none">
                    ¡Trabajo listo para despachar!
                </div>
                <div class="error-envio alert alert-danger border-danger text-danger my-3 d-none">

                </div>
            </div>
        </div>
    </div>
</form>
