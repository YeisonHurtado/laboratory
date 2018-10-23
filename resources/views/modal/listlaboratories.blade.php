<div class="modal fade" id="modalListLab" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="" id="listLabform">
                <div class="modal-header">
                    <h4 class="modal-title">Laboratorio</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="lab_name_search">Laboratorio</label>
                            <div class="input-group input-group-mini">
                                <input type="text" name="lab_name_search" id="lab_name_search" class="form-control form-control-sm">
                                <i class="fa fa-search"></i>
                            </div>
                        </div>
                    </div>
                    <div id="lab_table" class="table-responsive">
                        <table id="labs_add" class="table table-sm table-hover table-striped table-bordered">
                            <thead>
                                <th>Laboratorio</th>
                                <th>Dirección</th>
                                <th>Teléfono</th>
                                <th>E-mail</th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <div class="alert alert-danger text-danger border-danger d-none">
                            Laboratorio eliminado
                        </div>
                        <div class="form-group">
                            <button type="button" id="lab_edit" class="btn btn-block btn-primary" data-id_lab="" data-dismiss="modal" disabled><i class="fa fa-edit"></i>Editar</button>
                        </div>
                        <div class="form-group">
                            <button type="button" id="lab_delete" data-id_lab="" class="btn btn-danger" data-toggle="modal" data-target="#modalDeleteLab" disabled><i class="fas fa-trash-alt"></i> Eliminar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>