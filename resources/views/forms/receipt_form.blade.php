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
                  <div class="input-group input-group-mini">
                    <input type="text" name="code_student" id="code_student" class="form-control form-control-sm col-md-12">
                    <i class="far fa-id-card"></i>
                  </div>
                </div>
                <div class="form-group col-md-6 col-xs-6">
                  <label for="name_student">Nombre</label>
                  <div class="input-group input-group-mini">
                    <input type="text" name="name_student" id="name_student" class="form-control form-control-sm col-md-12">
                    <i class="fa fa-user-graduate"></i>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-6 col-xs-6">
                  <label for="email">Correo electrónico</label>
                  <div class="input-group input-group-mini">
                    <input type="email" name="email" id="email" class="form-control form-control-sm">
                    <i class="fa fa-at"></i>
                  </div>
                </div>
                <div class="form-group col-md-6 col-xs-6">
                  <label for="telefono">Teléfono</label>
                  <div class="input-group input-group-mini">
                    <input type="text" name="telefono" id="telefono" class="form-control form-control-sm">
                    <i class="fas fa-mobile-alt"></i>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-6 col-xs-6">
                  <label for="semestre">Semestre</label>
                  <div class="input-group input-group-mini">
                    <select name="semestre" id="semestre" class="form-control form-control-sm">
                      <option value="I">I</option>
                      <option value="II">II</option>
                      <option value="III">III</option>
                      <option value="IV">IV</option>
                      <option value="V">V</option>
                      <option value="VI">VI</option>
                      <option value="VII">VII</option>
                      <option value="VIII">VIII</option>
                    </select>
                    <i class="far fa-calendar-alt"></i>
                  </div>
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
                  <label for="nhc">Número de historia clínica</label>
                  <div class="input-group input-group-mini">
                    <i class="far fa-file-alt"></i>
                    <input type="text" name="nhc" id="nhc" class="form-control form-control-sm col-md-12" value="">
                  </div>
                </div>
                <div class="form-group col-md-6 col-xs-6">
                  <label for="name_patient">Nombre completo</label>
                  <div class="input-group input-group-mini">
                    <input type="text" name="name_patient" id="name_patient" class="form-control form-control-sm col-md-12">
                    <i class="far fa-user"></i>
                  </div>
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
                <div id="lista_productos" class="col-md-12 my-2 form-inline">
                    <div class="form-group form-inline col-md-6 my-1 p-0">
                        <label for="select_product" class="mr-2">Producto</label>
                        <select name="select_product" id="select_product" class="form-control form-control-sm col-md-8 col-sm-8 mr-2">
                        </select>
                    </div>
                    <div class="form-group form-inline col-md-6 p-0 mt-1">
                        <input type="number" id="cantidad" class="form-control form-control-sm col-md-6 mr-2" min="1" placeholder="Cantidad:" value="">
                        <button type="button" id="btnAdd" class="btn btn-primary btn-sm"><i class="fas fa-cart-plus"></i> Añadir</button>
                    </div>
                    <div class="col-md-12 my-2">
                        <div class="error-add error-add-product">¡Escoge un producto!</div>
                        <div class="error-add error-add-quantity">¡Ingresa la cantidad!</div>
                    </div>
                    <div class="row col-md-6">
                        <span class="col-md-4 col-sm-4 p-0">¿Vaciado?</span>
                        <div class="form-check col-md-3">
                            <label for="vaciado_si" class="form-check-label">
                                <input type="radio" name="vaciado" id="vaciado_si" class="vaciado form-check-input" value="1"> Sí
                            </label>
                        </div>
                        <div class="form-check col-md-3">
                            <label for="vaciado_no" class="form-check-label">
                                <input type="radio" name="vaciado" id="vaciado_no" class="vaciado form-check-input" value="0" checked> No
                            </label>
                        </div>
                        <div id="error_vaciado" class="text-warning col-md-12 col-sm-12 p-0 d-none"></div>
                    </div>
                    <div id="repeticion" class="row col-md-6">
                        <span class="col-md-4 col-sm-4 p-0">¿Repetición?</span>
                        <div class="form-check col-md-3">
                            <label for="repeticion_si">
                                <input type="radio" name="repeticion" id="repeticion_si" class="form-check-input" value="1"> Sí
                            </label>
                        </div>
                        <div class="form-check col-md-3">
                            <label for="repeticion_no">
                                <input type="radio" name="repeticion" id="repeticion_no" class="form-check-input" value="0" checked> No
                            </label>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="products_add table-responsive">
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
            <div class="card card-default my-1">
                <div class="card-header">
                    <div class="card-title">Forma de pago</div>
                </div>
                <div class="card-body row align-items-center pr-5 pl-5">
                    <div class="row justify-content-between col-md-12 col-sm-12 col-xs-12">
                        <div class="radio">
                            <label for="mto_pago1"><input type="radio" name="mto_pago" id="mto_pago1" value="1"> Primer pago 50%</label>
                        </div>
                        <div class="radio">
                            <label for="mto_pago2"><input type="radio" name="mto_pago" id="mto_pago2" value="1"> Segundo pago 50%</label>
                        </div>
                        <div class="radio">
                            <label for="mto_pagoU"><input type="radio" name="mto_pago" id="mto_pagoU" value="2"> Único pago</label>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="total_pagar">Total</label>
                            <div class="input-group input-group-mini">
                                <input type="number" name="total_pagar" id="total_pagar" class="form-control form-control-sm" placeholder="Total" readonly="readonly">
                                <i class="fa fa-dollar-sign"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
      <div class="">
        <button type="button" name="new_reciept" id="new_reciept" class="btn btn-success btn-sm my-1"><i class="fas fa-user-plus"></i> Nuevo</button>
        <button type="button" name="save_receipt" id="save_receipt" class="btn btn-primary btn-sm my-1"><i class="fa fa-database"></i> Guardar</button>
        <button type="button" name="print_reciept" id="print_reciept" class="btn btn-primary btn-sm my-1"><i class="fas fa-print"></i> Imprimir</button>
        <button type="button" name="update_receipt" id="update_receipt" class="btn btn-success btn-sm my-1"><i class="fa fa-redo-alt"></i> Modificar</button>
        <button type="button" name="exit_reciept" id="exit_reciept" class="btn btn-danger btn-sm my-1" data-dismiss="modal" onclick="clearReceiptForm()"><i class="fas fa-times"></i> Cerrar</button>
      </div>
    </div>
  </form>
