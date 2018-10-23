var newLaboratory = false;
var updateLaboratory = false;
var idInterval = "";

$(document).ready(function (e) {
    listLab('lista/laboratorios/');
    idLaboratory();
    idInterval = setInterval(idLaboratory, 5000);
    disabledInputsLab();

    $('#laboratory_search').on('click', function (e) {
        listLab('lista/laboratorios/');
        disabledButtonsDeleteEditLab();
    });

    $('#lab_name_search').on('keyup', function (e) {
        var id = $(this).val();
        listLab('lista/laboratorios/'+id);
        disabledButtonsDeleteEditLab();
    });

    $('#lab_edit').on('click', function (e) {
        updateLaboratory = true;
        newLaboratory = false;
        enabledInputsLab();
        showLab($(this).attr('data-id_lab'));
    });

    $('#lab_delete').on('click', function (e) {
        e.preventDefault();
        var id = $(this).attr('data-id_lab');
        $('#formDelete_lab p').text("¿Desea eliminar el laboratorio?");
        $('#destroy_lab').attr('data-id_lab',id);
    });

    $('#destroy_lab').on('click', function (e) {
        var id = $('#destroy_lab').attr('data-id_lab');
        destroyLab(id);
    });
    
    $('#btnAddLab').on('click', function (e) {
        var code = $('#select_product_lab').val();
        var cost = $('#costo').val();

        if (validateAddProductLab()){
            addRowProductToLab(code, cost);
            $('#select_product_lab').val('');
            $('#select_product_lab option[value="'+ code + '"]').css('display','none');
            $('#cantidad_lab').val('');
            $('#costo').val('');
        }
    });
    
    $('#save_laboratory').on('click', function (e) {
        e.preventDefault();
        var route = "addlaboratorio";
        var token = $('#tokenLab').val();
        saveLab(route, token);
    });

    $('#update_lab').on('click', function (e) {
        e.preventDefault();
        var route = "laboratorios/"+$('#idLab').val();
        var token = $('#tokenLab').val();
        updateLab(route, token);
    });

    $('#laboratory_new').on('click', function (e) {
        e.preventDefault();
        newLaboratory = true;
        updateLaboratory = false;
        enabledInputsLab();
        disabledButtonsToNewLab();
    });

    $(document).on('click', '.item_lab',function () {
        $('tr.item_lab').removeClass('bg-info text-light');
        $(this).toggleClass('bg-info text-light');
        $('#lab_edit').attr('disabled',false);
        $('#lab_delete').attr('disabled',false);
        $('#lab_edit').attr('data-id_lab',$(':first-child input',this).val ());
        $('#lab_delete').attr('data-id_lab',$(':first-child input',this).val ());
    });

    /* ------------------------------------------------- */
    /*  Evento para eliminar el producto del laboratorio
    *   o sólo quitarlo de la vista                      */
    /* ------------------------------------------------- */

    $(document).on('click', '.btn-eliminar-item', function (e) {
        var code = $(this).attr('data-removeItem');
        if (newLaboratory && !updateLaboratory){
            $('#select_product_lab option[value="'+ code + '"]').css('display','block');
            $(this).parents('tr').remove();
        } else if (!newLaboratory && updateLaboratory) {
            var token = $("#formDelete_lab input[name='_token']").val();
            $.ajax({
                url: 'remove/'+code,
                headers: {'X-CSRF-TOKEN': token},
                type: 'DELETE',
                dataType: 'json',
                success: function (data) {
                    if (data.removeP == "true"){
                        $('#select_product_lab option[value="'+ code + '"]').css('display','block');
                        $('div.alert').removeClass('d-none alert-success text-success border-success');
                        $('div.alert').addClass('alert-danger text-danger border-danger');
                        $('div.alert').html("Se eliminó el producto del laboratorio");
                        $('div.alert').fadeIn(500).delay(3000).fadeOut(500);
                    } else if (data.removeP == "false"){
                        console.log('El producto no se pudo eliminar');
                    }
                }
            });
            $(this).parents('tr').remove();
        }
    });
});

/* ---------------------------------------------------- */
//      Funciones para realizar el CRUD de LABORATORIO  //
/* ---------------------------------------------------- */

    function listLab(route) {
        $.ajax({
            url: route,
            type: 'get',
            success: function(data){
                $('#lab_table table tbody').empty().html(data);
            }
        });
    }
    
    function idLaboratory() {
        $.ajax({
            url: 'laboratorio/nextid',
            type: 'get',
            dataType: 'json',
            success: function (data) {
                $('#idLab').val(data.laboratory);
            }
        });
    }

    function showLab(id){
        var route = 'laboratorios/' + id + '/edit';
        $.ajax({
            url: route,
            type: 'get',
            dataType: 'json',
            success: function (data) {
                $('#idLab').val(data.laboratory.ID);
                $('#name_lab').val(data.laboratory.NAME);
                $('#rep_legal').val(data.laboratory.LEGAL_REPRE);
                $('#dire_lab').val(data.laboratory.ADDRESS);
                $('#tel_lab').val(data.laboratory.TEL);
                $('#cel_lab').val(data.laboratory.CEL);
                $('#email_lab').val(data.laboratory.EMAIL);
                $('table#table_lab_product tbody').empty();
                $.each(data.product, function (i, item) {
                    $('table#table_lab_product tbody').append('<tr>' +
                        '<td> <input type="text" name="codigo_prod['+i+']" class="codigo_prod form-control form-control-sm" readonly value="' + item.PRODUCT_CODE + '"> </td>' +
                        '<td>' + item.PRODUCT_NAME + '</td>' +
                        '<td> <input type="number" name="costo_prod['+i+']" id="cost_product" class="form-control form-control-sm" readonly value="' + item.pivot.COST + '"> </td>' +
                        '<td><button type="button" class="btn btn-danger btn-sm btn-eliminar-item" data-removeItem="' + item.PRODUCT_CODE + '"><i class="fas fa-trash-alt"></i> Eliminar</button></td>' +
                        '</tr>');
                    $('#select_product_lab option[value="'+ item.PRODUCT_CODE + '"]').css('display','none');
                });
                clearInterval(idInterval);
                disabledButtonsToEditLab();
            }
        });
    }

    function updateLab(route, token){
        $.ajax({
            url: route,
            type: 'PATCH',
            headers: {'X-CSRF-TOKEN':token},
            dataType: 'json',
            data: $('#formLaboratory').serialize(),
            success: function (data) {

                if (data.update == "true") {
                    $('div.alert').removeClass('d-none alert-danger text-danger border-danger');
                    $('div.alert').addClass('alert-success text-success border-success border-success');
                    $('div.alert').html('El laboratorio <strong>' + $('#name_lab').val() + '</strong> fue modificado con exito.');
                    $('div.alert').fadeIn(500).delay(4000).fadeOut(500);
                    clearFormLab();
                    disabledButtonsToSaveLab();
                } else if (data.update == "false") {
                    $('div.alert').removeClass('d-none');
                    $('div.alert').addClass('alert-danger text-danger border-danger');
                    $('div.alert').text('Verifica que los datos estén correctos.');
                    $('div.alert').fadeIn(500).delay(4000).fadeOut(500);
                } else if (data.email == "exist")  {
                    $('div.alert').removeClass('d-none');
                    $('div.alert').addClass('alert-danger text-danger border-danger');
                    $('div.alert').html('Ya existe un correo con esta dirección:<strong>' + $('#email_lab').val() +'</strong>');
                    $('div.alert').fadeIn(500).delay(4000).fadeOut(500);
                }

                if (data.errors){

                    if (data.errors.tel_lab){
                        $('#error_telLab').removeClass('d-none');
                        $('#error_telLab').text(data.errors.tel_lab[0]);
                        $('#error_telLab').fadeIn(500).delay(4000).fadeOut(500);
                    }

                    if (data.errors.cel_lab){
                        $('#error_celLab').removeClass('d-none');
                        $('#error_celLab').text(data.errors.cel_lab[0]);
                        $('#error_celLab').fadeIn(500).delay(4000).fadeOut(500);
                    }

                    if (data.errors.email_lab) {
                        $('#error_email').removeClass('d-none');
                        $('#error_email').text(data.errors.email_lab[0]);
                        $('#error_email').fadeIn(500).delay(4000).fadeOut(500);
                    }
                    if (data.errors.dire_lab) {
                        $('#error_direcLab').removeClass('d-none');
                        $('#error_direcLab').text(data.errors.dire_lab[0]);
                        $('#error_direcLab').fadeIn(500).delay(4000).fadeOut(500);
                    }
                }
            },
            error: function () {
                $('div.alert').removeClass('d-none');
                $('div.alert').addClass('alert-danger text-danger border-danger');
                $('div.alert').text('Verifica que los datos estén correctos.');
                $('div.alert').fadeIn(500).delay(2000).fadeOut(500);
            }
        });
    }

    function saveLab(route, token){
        var ok = false;
        $.ajax({
            url: route,
            type: 'POST',
            headers: {'X-CSRF-TOKEN':token},
            dataType: 'json',
            data: $('#formLaboratory').serialize(),
            success: function (data) {
                if (data.errors){
                    if (data.errors.dire_lab){
                        $('#error_direcLab').removeClass('d-none');
                        $('#error_direcLab').text(data.errors.dire_lab[0]);
                        $('#error_direcLab').fadeIn(500).delay(4000).fadeOut(500);
                    }

                    if (data.errors.email_lab) {
                        $('#error_email').removeClass('d-none');
                        $('#error_email').text(data.errors.email_lab[0]);
                        $('#error_email').fadeIn(500).delay(4000).fadeOut(500);
                    }
                }
                
                if (data.save == "true"){
                    $('div.alert').removeClass('d-none alert-danger text-danger border-danger');
                    $('div.alert').addClass('alert-success text-success border-success');
                    $('div.alert').html('Laboratorio <strong>' + $('#name_lab').val() + '</strong> ha sido guardado con exito.');
                    $('div.alert').fadeIn(500).delay(4000).fadeOut(500);
                    clearFormLab();
                    disabledButtonsToSaveLab();
                } else if (data.save == "false"){
                    $('div.alert').removeClass('d-none alert-success text-success border-success');
                    $('div.alert').addClass('alert-danger text-danger border-danger');
                    $('div.alert').html('No se pudo guardar el laboratorio <strong>' + $('#name_lab').val() + '</strong>.');
                    $('div.alert').fadeIn(500).delay(4000).fadeOut(500);
                }
            },
        });
            /*var route2 = "addProductosLab";
            $.ajax({
                url: route2,
                type: 'POST',
                headers: {'X-CSRF-TOKEN':token},
                dataType: 'json',
                data: $('#formLaboratory').serialize(),
                success: function (data) {
                    if (data.save == "true"){
                        $('div.alert').removeClass('d-none');
                        $('div.alert').addClass('alert-success text-success border-success');
                        $('div.alert').html('Laboratorio <strong>' + $('#name_lab').val() + '</strong> ha sido guardado con exito.');
                        $('div.alert').fadeIn(500).delay(4000).fadeOut(500);
                        clearFormLab();
                        disabledButtonsToSaveLab();
                    } else {
                        console.log("Error 2");
                    }
                }
            })*/
    }
    
    function destroyLab(id) {
        var route = "laboratorios/"+id;
        var token = $("#formDelete_lab input[name='_token']").val();

        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': token},
            type: 'DELETE',
            dataType: 'json',
            success: function (data) {
                listLab('lista/laboratorios');
                $('div.alert').removeClass('d-none alert-success text-success border-success');
                $('div.alert').addClass('alert-danger text-danger border-danger');
                $('div.alert').html("Se eliminó el laboratorio <strong>" + data.name + "</strong>");
                $('div.alert').fadeIn(500).delay(3000).fadeOut(500);
                clearFormLab();
            }
        });
    }
    
    function addRowProductToLab(code, cost) {
        var route = "/productos/"+ code +"/edit";
        $.ajax({
            url: route,
            type: 'get',
            dataType: 'json',
            success: function (data) {
                $('table#table_lab_product tbody').append('<tr>' +
                    '<td> <input type="text" name="codigo_prod[]" class="codigo_prod form-control form-control-sm" readonly value="' + data.PRODUCT_CODE + '"> </td>' +
                    '<td>' + data.PRODUCT_NAME + '</td>' +
                    '<td> <input type="number" name="costo_prod[]" id="cost_product" class="form-control form-control-sm" readonly value="' + cost + '"> </td>' +
                    '<td><button type="button" class="btn btn-danger btn-sm btn-eliminar-item" data-removeItem="' + data.PRODUCT_CODE + '"><i class="fas fa-trash-alt"></i> Eliminar</button></td>' +
                    '</tr>');
            }
        });
    }

/* ---------------------------------------------------- */
/* ---------------------------------------------------- */

//------------------------------------------------------------------------------------ //

/* ---------------------------------------------------- */
//   Funciones para manejar el estado de los elementos  //
/* ---------------------------------------------------- */

    function validateAddProductLab(){
        var ok = true;

        if ($('#select_product_lab').val() == ""){
            $('div.error-add-product').fadeIn(500).delay(2000).fadeOut(500);
            ok = false;
        }
        
        if ($('#costo').val() == ""){
            $('div.error-add-cost').fadeIn(500).delay(2000).fadeOut(500);
            ok = false;
        }

        return ok;
    }

    function enabledInputsLab() {
        $('#formLaboratory input, #formLaboratory select').attr('disabled',false);
    }

    function disabledInputsLab() {
        $('#formLaboratory input, #formLaboratory select').attr('disabled',true);
    }

    function disabledButtonsToNewLab(){
        enabledInputsLab();
        $('#laboratory_new').attr('disabled',true);
        $('#save_laboratory').attr('disabled',false);
        $('#update_lab').attr('disabled',true);
    }

    function disabledButtonsToSaveLab(){
        newLaboratory = false;
        updateLaboratory = false;
        $('#save_laboratory').attr('disabled', true);
        $('#laboratory_new').attr('disabled',false);
        $('#update_lab').attr('disabled',true);
    }

    function disabledButtonsToEditLab() {
        disabledButtonsDeleteEditLab();
        $('#laboratory_new').attr('disabled',true);
        $('#save_laboratory').attr('disabled',true);
        $('#update_lab').attr('disabled',false);
    }

    function disabledButtonsDeleteEditLab(){
        $('#lab_delete').attr('data-id_lab','');
        $('#lab_edit').attr('data-id_lab','');
        $('#lab_delete').attr('disabled',true);
        $('#lab_edit').attr('disabled',true);
    }

    function clearFormLab(){
        $('#formLaboratory')[0].reset();
        disabledInputsLab();
        clearInterval(idInterval);
        disabledButtonToCloseLab();
        receiptProductList('recibo/producto');
        $('table#table_lab_product tbody').empty();
    }

    function disabledButtonToCloseLab(){
        disabledInputsLab();
        idInterval = setInterval(idLaboratory, 5000);
        $('#laboratory_new').attr('disabled',false);
        $('#update_lab').attr('disabled',true);
        $('#save_laboratory').attr('disabled', true);
    }

/* ---------------------------------------------------- */
/* ---------------------------------------------------- */

