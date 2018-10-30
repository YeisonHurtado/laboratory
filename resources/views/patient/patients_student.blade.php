<div class="modal fade" id="patientStudent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Paciente(s) del estudiante</h4>
                <button type="button" class="close" data-dismiss="modal" onclick="">&times;</button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="student_patients" class="table table-sm table-hover">
                        <thead>
                            <th>Documento</th>
                            <th>Paciente</th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <button type="button" id="show_patient" data-numHC="" class="btn btn-sm btn-primary" data-dismiss="modal"><i class="fa fa-check"></i> Listo</button>
                    <button type="button" id="search_other" data-code_std="" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#patients">Buscar otros</button>
                </div>
            </div>
        </div>
    </div>
</div>
