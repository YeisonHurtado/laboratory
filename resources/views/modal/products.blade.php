<div class="modal fade" id="miModalProduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  	<div class="modal-dialog modal-lg" role="document">
  		<div class="modal-content">
        <form action="" id="product_form" class="form p-1">
          <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
          <div class="modal-header">
            <h4 class="modal-title">LABORATORIO PINTO - PRODUCTOS</h4>
            <button type="button" class="close" data-dismiss="modal" onclick="clearForm()">&times;</button>
          </div>
          <div class="modal-body row">
            <div class="col-md-6 d-flex align-items-center">
              <img src="{{asset('images/productos.jpg')}}" alt="" class="col-md-12 rounded">
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="cod_product">Código producto</label>
                <div class="input-group">
                  <input type="text" name="cod_product" id="cod_product" class="form-control">
                  <i class="fas fa-barcode"></i>
                </div>
              </div>
              <div class="form-group">
                <label for="name_product">Nombre del producto</label>
                <div class="input-group">
                  <input type="text" name="name_product" id="name_product" class="form-control">
                  <i class="fa fa-tooth"></i>
                </div>
              </div>
              <div class="form-group">
                <label for="product_value">Precio del producto</label>
                <div class="input-group">
                  <input type="number" name="product_value" id="product_value" class="form-control">
                  <i class="fa fa-dollar-sign"></i>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <div class="form-group">
              <div class="message_product">
              </div>
              <button type="button" name="new_product" id="new_product" class="btn btn-success btn-sm"><i class="fas fa-user-plus"></i> Nuevo</button>
              <button type="submit" name="save_product" id="save_product" class="btn btn-primary btn-sm" disabled><i class="fas fa-database"></i> Guardar</button>
              <button type="button" name="" id="product_search" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#miModalListProduct"><i class="fas fa-search"></i> Buscar</button>
              <button type="submit" id="update_product" class="btn btn-success btn-sm" disabled><i class="fas fa-redo-alt"></i> Actualizar</button>
              <button type="button" name="exit_modalProd" id="exit_modalProd" class="btn btn-danger btn-sm" data-dismiss="modal" onclick="clearForm()"><i class="fas fa-times"></i> Cerrar</button>
            </div>
          </div>
        </form>
  		</div>
  	</div>
  </div>
