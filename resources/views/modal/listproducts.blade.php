<div class="modal fade" id="miModalListProduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" onclick="clearForm()">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="" id="productForm">
                <div class="modal-header">
                    <h4 class="modal-title">Listado de productos</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 row">
                        <div class="form-group col-md-6">
                            <label for="cod_producto">Código</label>
                            <input type="text" name="cod_producto" id="cod_producto" class="form-control form-control-sm">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nom_producto">Concepto</label>
                            <input type="text" name="nom_producto" id="nom_producto" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div id="products_table" class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="products">
                            <thead>
                            <tr>
                                <th>Código del producto</th>
                                <th>Concepto</th>
                                <th>Valor unitario</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <div class="alert alert-danger text-danger border-danger d-none">
                            Producto eliminado
                        </div>
                        <div class="form-group">
                            <button type="button" id="product_edit" class="btn btn-block btn-primary" data-cod_prod="" data-dismiss="modal" disabled><i class="fa fa-edit"></i>Editar</button>
                        </div>
                        <div class="form-group">
                            <button type="button" id="product_delete" data-cod_prod="" class="btn btn-danger" data-toggle="modal" data-target="#modalDeleteProduct" disabled><i class="fas fa-trash-alt"></i> Eliminar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>