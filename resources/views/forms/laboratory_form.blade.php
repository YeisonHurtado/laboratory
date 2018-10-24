<form action="" id="formLaboratory" class="form p-1">
    <input type="hidden" name="_token" id="tokenLab" value="{{ csrf_token() }}">
    <input type="hidden" name="idLab" id="idLab">
    <div class="modal-header"><h4>LABORATORIO PINTO - GESTIÓN DE LABORATORIOS</h4>
        <button type="button" class="close" data-dismiss="modal" onclick="clearFormLab()">&times;</button>
    </div>
    <div class="modal-body">
        <div class="row col-md-12">
            <div class="form-group col-md-4">
                <label for="name_lab">Nombre comercial</label>
                <div class="input-group input-group-mini">
                    <input type="text" name="name_lab" id="name_lab" class="form-control form-control-sm col-md-12">
                    <i class="fas fa-flask"></i>
                </div>
                <span id="error_name" class="text-danger d-none"></span>
            </div>
            <div class="form-group col-md-4">
                <label for="rep_legal">Representante legal</label>
                <div class="input-group input-group-mini">
                    <input type="text" name="rep_legal" id="rep_legal" class="form-control form-control-sm col-md-12">
                    <i class="fas fa-user-tie"></i>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="dire_lab">Dirección laboratorio</label>
                <div class="input-group input-group-mini">
                    <input type="text" name="dire_lab" id="dire_lab" class="form-control form-control-sm col-md-12">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <span id="error_direcLab" class="text-danger d-none"></span>
            </div>
        </div>
        <div class="row col-md-12">
            <div class="form-group col-md-4">
                <label for="tel_lab">Teléfono</label>
                <div class="input-group input-group-mini">
                    <input type="text" name="tel_lab" id="tel_lab" class="form-control form-control-sm col-md-12">
                    <i class="fas fa-phone"></i>
                </div>
                <span id="error_telLab" class="text-danger d-none"></span>
            </div>
            <div class="form-group col-md-4">
                <label for="cel_lab">Celular</label>
                <div class="input-group input-group-mini">
                    <input type="text" name="cel_lab" id="cel_lab" class="form-control form-control-sm col-md-12">
                    <i class="fas fa-mobile-alt"></i>
                </div>
                <span id="error_celLab" class="text-danger d-none"></span>
            </div>
            <div class="form-group col-md-4">
                <label for="email_lab">Email</label>
                <div class="input-group input-group-mini">
                    <input type="email" name="email_lab" id="email_lab" class="form-control form-control-sm">
                    <i class="fa fa-at"></i>
                </div>
                <span id="error_email" class="text-danger d-none"></span>
            </div>
        </div>
        <div class="card card-default">
            <div class="card-header">
                <div class="card-title">
                    <strong>Productos que ofrece</strong>
                </div>
            </div>
            <div class="card-body">
                <div id="lista_productos" class="col-md-12 my-6 form-inline p-0">
                    <div class="form-group form-inline col-md-5 my-1 p-0">
                        <label for="select_product_lab" class="mr-2">Producto</label>
                        <select name="select_product_lab" id="select_product_lab" class="form-control form-control-sm col-md-8 col-lg-8 col-sm-8 col-xs-8 mr-2">
                        </select>
                    </div>
                    <div class="form-group form-inline col-md-6 my-1 p-0">
                        <div class="input-group input-group-mini col-md-8 p-0 my-2">
                            <input type="number" id="costo" class="form-control form-control-sm col-md-12 mr-2" min="1" placeholder="Costo:" value="">
                            <i class="fa fa-dollar-sign"></i>
                        </div>
                        <button type="button" id="btnAddLab" class="btn btn-primary btn-sm col-md-4 col-lg-4 col-sm-4 col-xs-4"><i class="fas fa-cart-plus"></i> Añadir</button>
                    </div>
                    <div class="col-md-12">
                        <div class="error-add error-add-product">¡Escoge un producto!</div>
                        <div class="error-add error-add-cost">¡Ingresa el costo del producto!</div>
                    </div>
                </div>
                <div id="products_laboratory" class="table-responsive">
                    <table id="table_lab_product" class="table table-striped">
                        <thead>
                        <tr>
                            <th>Código</th>
                            <th>Descripción</th>
                            <th>Costo</th>
                            <th>Eliminar</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <div class="form-group">
            <div class="alert d-none">
            </div>
            <button type="button" id="laboratory_new" class="btn btn-success btn-sm"><i class="fas fa-user-plus"></i> Nuevo</button>
            <button type="button" id="save_laboratory" class="btn btn-primary btn-sm" disabled><i class="fas fa-database"></i> Guardar</button>
            <button type="button" id="laboratory_search" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalListLab"><i class="fas fa-search"></i> Buscar</button>
            <!--<button type="button" id="print_reciept" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Eliminar</button>-->
            <button type="button" id="update_lab" class="btn btn-success btn-sm" disabled><i class="fas fa-redo-alt"></i> Actualizar</button>
            <button type="button" id="exit_lab" class="btn btn-danger btn-sm" onclick="clearFormLab()" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
        </div>
    </div>
</form>
