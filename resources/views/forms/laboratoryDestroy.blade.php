<form method="POST" action="" enctype="multipart/form-data" id="formDelete_lab">
    @csrf
    <p></p>
    <input type="hidden" name="_method" id="token" value="DELETE">
    <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
        <button type="button" id="destroy_lab" data-id_lab=""  data-dismiss="modal" class="btn btn-danger">Eliminar</button>
    </div>
</form>