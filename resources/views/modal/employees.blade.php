<div class="modal fade" id="modalEmp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <form action="">
          <div class="modal-header">
            <strong>LABORATORIO PINTO - GESTIÓN DE EMPLEADOS</strong>
          </div>
          <div class="row">
            <div class="modal-body col-md-12">
              <div class="row col-md-12 col-lg-12 col-xs-12">
                <div class="form-group col-md-5 col-lg-5 col-xs-5">
                  <label for="id_empleado">Número de identificación</label>
                  <input type="text" name="id.empleado" id="id_empleado" class="form-control col-md-12 col-lg-12 col-xs-12">
                </div>
                <div class="form-group col-md-7">
                  <label for="name_empleado">Nombre Completo</label>
                  <input type="text" name="name.empleado" id="name_empleado" class="form-control col-md-12 col-lg-12 col-xs-12">
                </div>
              </div>
              <div class="row col-md-12 col-lg-12 col-xs-12">
                <div class="form-group col-md-8">
                  <label for="dir_empleado">Dirección</label>
                  <input type="text" name="dir.empleado" id="dir_empleado" class="form-control">
                </div>
                <div class="form-group col-md-4">
                  <label for="tel_empleado">Teléfono</label>
                  <input type="text" name="tel.empleado" id="tel_empleado" class="form-control">
                </div>
              </div>
              <div class="row col-md-12 col-lg-12 col-xs-12">
                <div class="form-group col-md-4">
                  <label for="cel_empleado">Celular</label>
                  <input type="text" name="cel.empleado" id="cel_empleado" class="form-control">
                </div>
                <div class="form-group col-md-8">
                  <label for="email_empleado">Email</label>
                  <input type="text" name="email.empleado" id="email_empleado" class="form-control">
                </div>
              </div>
              <div class="row col-md-12 col-lg-12 col-xs-12">
                <div class="form-group col-md-6">
                  <label for="user_empleado">Usuario</label>
                  <input type="text" name="user.empleado" id="user_empleado" class="form-control">
                </div>
                <div class="form-group col-md-6">
                  <label for="clave_empleado">Contraseña</label>
                  <input type="text" name="clave.empleado" id="clave_empleado" class="form-control">
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <div class="">
              <button type="submit" name="new.reciept" id="new_reciept" class="btn btn-success"><i class="fas fa-user-plus"></i> Nuevo</button>
              <button type="submit" name="print.reciept" id="print_reciept" class="btn btn-primary"><i class="fas fa-database"></i> Guardar</button>
              <button type="submit" name="new.reciept" id="new_reciept" class="btn btn-primary"><i class="fas fa-search"></i> Buscar</button>
              <button type="submit" name="print.reciept" id="print_reciept" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Eliminar</button>
              <button type="submit" name="new.reciept" id="new_reciept" class="btn btn-success"><i class="fas fa-redo-alt"></i> Actualizar</button>
              <button type="submit" name="exit.reciept" id="exit_reciept" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
