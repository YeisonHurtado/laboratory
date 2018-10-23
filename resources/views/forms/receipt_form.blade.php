<form action="" id="receipt_form" class="form p-1">
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <input type="hidden" name="fechaIngreso" id="fechaIngreso" value="">
    <div class="modal-header">
      <h4 class="modal-title">LABORATORIO PINTO - RECIBO DE CONSIGNACIÓN</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="row">
        <div class="modal-body col-md-12">
          <div class="card card-default my-1">
            <div class="card-header">
              <div class="card-title">
                Información del estudiante
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="form-group col-md-6 col-xs-6">
                  <label for="code_student">Código</label>
                  <input type="text" name="code_student" id="code_student" class="form-control form-control-sm col-md-12">
                </div>
                <div class="form-group col-md-6 col-xs-6">
                  <label for="name_student">Nombre</label>
                  <input type="text" name="name_student" id="name_student" class="form-control form-control-sm col-md-12">
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-6 col-xs-6">
                  <label for="email">Correo electrónico</label>
                  <input type="email" name="email" id="email" class="form-control form-control-sm">
                </div>
                <div class="form-group col-md-6 col-xs-6">
                  <label for="telefono">Teléfono</label>
                  <input type="text" name="telefono" id="telefono" class="form-control form-control-sm">
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-6 col-xs-6">
                  <label for="semestre">Semestre</label>
                  <select name="semestre" id="semestre" class="form-control form-control-sm">
                    <option value="I">I</option>
                    <option value="II">II</option>
                    <option value="III">III</option>
                    <option value="IV">IV</option>
                    <option value="V">V</option>
                    <option value="VI">VI</option>
                    <option value="VII">VII</option>
                    <option value="VIII"><VIII></VIII></option>
                  </select>
                </div>
                <div class="form-group col-md-6 col-xs-6"></div>
              </div>
            </div>
          </div>
          <div class="card card-default my-1">
            <div class="card-header">
              <div class="card-title">
                Información del paciente
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="form-group col-md-6 col-xs-6">
                  <label for="nhc">Núm. H.C.</label>
                  <input type="text" name="nhc" id="nhc" class="form-control form-control-sm col-md-12" value="">
                </div>
                <div class="form-group col-md-6 col-xs-6">
                  <label for="name_patient">Nombre completo</label>
                  <input type="text" name="name_patient" id="name_patient" class="form-control form-control-sm col-md-12">
                </div>
              </div>
            </div>
          </div>
          <div class="card card-default my-1">
              <div class="card-header">
                <div class="card-title">
                  <strong>Información del producto</strong>
                </div>
              </div>
              <div id="lista_productos" class="col-md-12 my-4 form-inline">
                <div class="form-group form-inline col-md-6 p-0">
                  <label for="select_product" class="mr-2">Producto</label>
                  <select name="select_product" id="select_product" class="form-control form-control-sm col-md-8 mr-2">
                  </select>
                </div>
                <div class="form-group form-inline col-md-6 p-0">
                  <input type="number" id="cantidad" class="form-control form-control-sm col-md-6 mr-2" min="1" placeholder="Cantidad:" value="">
                  <button type="button" id="btnAdd" class="btn btn-primary btn-sm"><i class="fas fa-cart-plus"></i> Añadir</button>
                </div>
                <div class="col-md-12">
                  <div class="error-add error-add-product">¡Escoge un producto!</div>
                  <div class="error-add error-add-quantity">¡Ingresa la cantidad!</div>
                </div>
              </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-sm table-striped table-bordered table-hover" id="product_adds">
                  <thead>
                    <th>Código</th>
                    <th>Descripción</th>
                    <th>V. unitario</th>
                    <th>Cantidad</th>
                    <th>Total a pagar</th>
                    <th>Quitar</th>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="modal-footer">
      <div class="">
        <button type="button" name="new_reciept" id="new_reciept" class="btn btn-success"><i class="fas fa-user-plus"></i> Nuevo</button>
        <button type="button" name="save_receipt" id="save_receipt" class="btn btn-primary"><i class="fa fa-database"></i> Guardar</button>
        <button type="button" name="print_reciept" id="print_reciept" class="btn btn-primary"><i class="fas fa-print"></i> Imprimir</button>
        <button type="button" name="update_receipt" id="update_receipt" class="btn btn-success"><i class="fa fa-redo-alt"></i> Modificar</button>
        <button type="button" name="exit_reciept" id="exit_reciept" class="btn btn-danger" data-dismiss="modal" onclick="clearReceiptForm()"><i class="fas fa-times"></i> Cerrar</button>
      </div>
    </div>
  </form>