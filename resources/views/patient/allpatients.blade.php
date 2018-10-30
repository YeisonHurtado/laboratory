<div class="modal fade" id="patients" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" id="patients">
            <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Pacientes</h4>
                    <button type="button" class="close" data-dismiss="modal" onclick="">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="num_hc" id="num_hc">
                    <input type="hidden" name="student_code" id="student_code">
                    <div class="table-responsive">
                        <table id="all_patients" class="table table-sm table-hover">
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
                        <button type="submit" name="change_student" id="change_student" data-numHC="" class="btn btn-sm btn-success" data-dismiss="modal"><i class="fa fa-check"></i> Remitir paciente</button>
                        <button type="button" id="none" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fa fa-ban"></i> Cancelar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
