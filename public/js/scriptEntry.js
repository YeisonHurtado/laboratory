if ($('#cant_art').val() == "NA"){
    $('#cod_art_1, #cod_art_2, #ob_art_1, #ob_art_2').parent('div').attr({
        'disabled': true
    });
    $('#cod_art_1, #cod_art_2, #ob_art_1, #ob_art_2').parent('div').css({
        'display':'none'
    });
} else if ($('#cant_art').val() == "1") {
    $('#cod_art_1, #ob_art_1').parent('div').attr({
        'disabled': false
    });
    $('#cod_art_1, #ob_art_1').parent('div').css({
        'display':'block'
    });
}

var exist_orden = false;

$(document).ready(function (e) {
    laboratorios();
    cajas();

    $('#no_orden').on('keyup', function (e) {
        var keycode = (e.keyCode ? e.keyCode : e.which);
        var code = $(this).val();
        if (keycode == 13)
            showOrderEntry(code);
    });
    
    $('#cant_art').on('change', function (e) {
        var cantidad = $(this).val();
        changeArt(cantidad);
    });

    $('#save_entry').on('click', function (e) {
        searchOrder($('#no_orden').val());
    });

    /* Este evento removerá la clase is-invalid de los inputs cuando se escriba en ellos */
    $('#entryForm input, #entryForm textarea').on('keyup', function (e) {
        $(this).removeClass('is-invalid');
        $('.text-danger').addClass('d-none');
    });
});

function showOrderEntry(idOrder) {
    cajas();
    var route = "orden/"+idOrder+"/productos";
    var cantidad = 0;
    $.ajax({
        url: route,
        type: 'get',
        dataType: 'json',
        success: function (data) {
            if (data.show == "false"){
                $('#no_orden').focus();
                $('.not-order').removeClass('d-none').fadeIn(200).delay(4000).fadeOut(200);
                $('#entryForm')[0].reset();
                $('table#order_entry tbody').empty();
                exist_orden = false;
                return false;
            }

            exist_orden = true;
            $('#codigo_est').val(data.student.EST_COD);
            $('#nombre_est').val(data.student.NOMBRE_EST);
            $('#correo_est').val(data.student.CORREO);
            $('#tel_est').val(data.student.TEL_CEL);
            $('#semestre_est').val(data.student.SEMESTRE);
            $('#doc_paciente').val(data.patient.NUM_PACIENTE);
            $('#nombre_paciente').val(data.patient.NOMBRE);
            $('#metodo_pago').val(data.order.METODO_PAGO);
            if (data.box){
                $('#no_caja').val(data.box.ID);
                $('#no_caja option[value="'+data.box.ID+'"]').prop('disabled',false);
            }

            data.order.METODO_PAGO == 1 ? $('#tipo_pago').val('Crédito - Primer pago'): $('#tipo_pago').val('Contado - único pago');
            $('input#total_cancelado').val(data.payment[0].CONSIGNADO);
            $('#id_payment').val(data.payment[0].ID)
            $('table#order_entry thead tr').empty();
            $('table#order_entry thead tr').append(
                '<th>Código</th>' +
                '<th>Descripción</th>' +
                '<th>Valor unitario</th>' +
                '<th>Cantidad</th>' +
                '<th>Total</th>' +
                '<th>Factura</th>' +
                '<th>Recibo de caja</th>'
            );
            $('table#order_entry tbody').empty();
            $.each(data.product, function (i, item) {
                $('table#order_entry tbody').append(
                    '<tr>' +
                    '<td><input type="text" name="code_product" class="code_product form-control form-control-sm" readonly value="'+item.PRODUCT_CODE+'"></td>' +
                    '<td>'+item.PRODUCT_NAME+'</td>'+
                    '<td><i class="fa fa-dollar-sign"></i> '+item.PRODUCT_VAL+'</td>'+
                    '<td><input type="number" name="quantity" class="quantity_prod form-control form-control-sm" readonly value="'+item.pivot.CANTIDAD+'"></td>'+
                    '<td>' +
                    '<div class="input-group input-group-mini">' +
                    '<input type="number" name="total_item" class="total_item form-control form-control-sm" readonly value="'+item.pivot.TOTAL_ITEM+'">' +
                    '<i class="fa fa-dollar-sign"></i>'+
                    '</div>'+
                    '</td>' +
                    '<td>' +
                    '<div class="input-group input-group-mini">' +
                    '<input type="number" name="no_factura" id="no_factura" min="1" class="form-control form-control-sm">' +
                    '<i class="fas fa-file-invoice"></i>' +
                    '</div>' +
                    '</td>' +
                    '<td>' +
                    '<div class="input-group input-group-mini">' +
                    '<input type="number" name="recibo_caja" id="recibo_caja" min="1" class="form-control form-control-sm">' +
                    '<i class="fas fa-receipt"></i>' +
                    '</div>' +
                    '</td>'+
                    '</tr>'
                );
                cantidad = cantidad + Number(item.pivot.CANTIDAD);
            });
            for (i = 0; i < cantidad; i++){
                $('table#order_entry thead tr:last-child th:last-child').after(
                    '<th>Diente</th>'
                );
            }
            $.each(data.product, function (i, item) {
                for (i = 0; i < item.pivot.CANTIDAD; i++){

                    $('table#order_entry tbody tr:last-child td:last-child').after(
                        '<td>' +
                        '<div class="input-group input-group-mini">' +
                        '<select name="diente[]" id="diente" class="form-control form-control-sm">' +
                        '<option value="D11">D11</option>' +
                        '<option value="D12">D12</option>' +
                        '<option value="D13">D13</option>' +
                        '<option value="D14">D14</option>' +
                        '<option value="D15">D15</option>' +
                        '<option value="D16">D16</option>' +
                        '<option value="D17">D17</option>' +
                        '<option value="D18">D18</option>' +
                        '<option value="D21">D21</option>' +
                        '<option value="D22">D22</option>' +
                        '<option value="D23">D23</option>' +
                        '<option value="D24">D24</option>' +
                        '<option value="D25">D25</option>' +
                        '<option value="D26">D26</option>' +
                        '<option value="D27">D27</option>' +
                        '<option value="D28">D28</option>' +
                        '<option value="D31">D31</option>' +
                        '<option value="D32">D32</option>' +
                        '<option value="D33">D33</option>' +
                        '<option value="D34">D34</option>' +
                        '<option value="D35">D35</option>' +
                        '<option value="D36">D36</option>' +
                        '<option value="D37">D37</option>' +
                        '<option value="D38">D38</option>' +
                        '<option value="D41">D41</option>' +
                        '<option value="D42">D42</option>' +
                        '<option value="D43">D43</option>' +
                        '<option value="D44">D44</option>' +
                        '<option value="D45">D45</option>' +
                        '<option value="D46">D46</option>' +
                        '<option value="D47">D47</option>' +
                        '<option value="D48">D48</option>' +
                        '</select>' +
                        '<i class="fa fa-tooth"></i>' +
                        '</div>'+
                        '</td>'
                    );
                }
            });
            $('#pending_payment').attr({
                'disabled': true,
                'data-id_orden': '',
                'data-id_factura': ''
            });
            $('#select_product, #cantidad, #btnAdd').attr('disabled', true);
        }
    });
}

function searchOrder(code) {
    var route = "orden/"+code+"/productos";
    if (code != ""){
        $.ajax({
            url: route,
            type: 'get',
            dataType: 'json',
            success: function (data) {
                if (data.show == "false") {
                    $('#no_orden').focus();
                    $('.not-order').removeClass('d-none').fadeIn(200).delay(4000).fadeOut(200);
                    $('#entryForm')[0].reset();
                    $('table#order_entry tbody').empty();
                    exist_orden = false;
                    return false;
                }

                saveEntry();
            }
        });
    }
    else {
        $('.error-orden').removeClass('d-none').fadeIn(100).delay(5000).fadeOut(2000);
        $('#no_orden').addClass('is-invalid');
        $('#no_orden').focus();
        return false;
    }
}

function laboratorios() {
    var route = "proveedores";
    $.ajax({
        url: route,
        type: 'get',
        success: function (data) {
            $('select#laboratorio').html(data);
        }
    });
}

function cajas() {
    var route = "cajas";
    $.ajax({
        url: route,
        type: 'get',
        success: function (data) {
            $('select#no_caja').html(data);
        }
    });
}

function saveEntry() {
    var route = "addingreso";
    var token = $('#token_entry').val();

    if (validateArticulator()){
        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': token},
            type: 'POST',
            data: $('#entryForm').serialize(),
            dataType: 'json',
            success: function (data) {
                if (data.errors){
                    if (data.errors.no_orden){
                        $('.error-orden').removeClass('d-none').fadeIn(100).delay(5000).fadeOut(2000);
                        $('#no_orden').addClass('is-invalid');
                        $('#no_orden').focus();
                        return false;
                    }

                    if (data.errors.fecha_ingreso){
                        $('.error-fechaIng').removeClass('d-none').fadeIn(100).delay(5000).fadeOut(2000);
                        $('#fecha_ingreso').focus();
                        return false;
                    }
                    
                    if (data.errors.laboratorio){
                        $('.error-laboratorio').removeClass('d-none').fadeIn(100).delay(5000).fadeOut(2000);
                        $('select#laboratorio').focus();
                        return false;
                    }
                    
                    if (data.errors.no_factura){
                        $('.error-caja').addClass('d-none');
                        $('.error-factura').removeClass('d-none').fadeIn(100).delay(5000).fadeOut(2000);
                        $('table#order_entry #no_factura').focus();
                        return false;
                    }

                    if (data.errors.recibo_caja){
                        $('.error-factura').addClass('d-none');
                        $('.error-caja').removeClass('d-none').fadeIn(100).delay(5000).fadeOut(2000);
                        $('table#order_entry #recibo_caja').focus();
                        return false;
                    }

                    if (data.errors.preescripcion){
                        $('.error-caja').addClass('d-none');
                        $('.error-factura').addClass('d-none');
                        $('.error-preescripcion').removeClass('d-none').fadeIn(100).delay(5000).fadeOut(2000);
                        $('#preescripcion').focus();
                        return false;
                    }
                }

                if (data.invoice == "false"){
                    $('#success_entry').addClass('d-none');
                    $('#error_entry').removeClass('d-none').fadeIn(100).delay(5000).fadeOut(100);
                    $('#error_entry').text('Verifique que el número de factura no haya sido ingresado antes');
                }

                if (data.save == "true"){
                    $('#error_entry').addClass('d-none');
                    $('#success_entry').removeClass('d-none').fadeIn(100).delay(5000).fadeOut(100);
                    $('#entryForm')[0].reset();
                    cajas();
                    $('table#order_entry tbody').empty();
                } else if (data.save == "false") {
                    $('#success_entry').addClass('d-none');
                    $('#error_entry').removeClass('d-none').fadeIn(100).delay(5000).fadeOut(100);
                }
            },
            error: function (data) {
                $('#success_entry').addClass('d-none');
                $('#error_entry').removeClass('d-none').fadeIn(100).delay(5000).fadeOut(100);
                $('#error_entry').text('Verifique que el número de factura no haya sido ingresado antes');
            }
        });
    } else {
        $('.error-articulador').removeClass('d-none').fadeIn(200).delay(5000).fadeOut(200);
    }
}

function changeArt(val){
    if (val == "NA"){

        $('#cod_art_1, #cod_art_2, #ob_art_1, #ob_art_2').parent('div').attr({
            'disabled': true
        });
        $('#cod_art_1, #cod_art_2, #ob_art_1, #ob_art_2').parent('div').css({
            'display':'none'
        });
    } else if(val == 1){
        $('#cod_art_1, #ob_art_1').parent('div').attr({
            'disabled': false
        });
        $('#cod_art_1, #ob_art_1').parent('div').css({
            'display':'block'
        });

        $('#cod_art_2, #ob_art_2').parent('div').attr({
            'disabled': true
        });
        $('#cod_art_2, #ob_art_2').parent('div').css({
            'display':'none'
        });
    } else if(val == 2){
        $('#cod_art_1, #ob_art_1, #cod_art_2, #ob_art_2').parent('div').attr({
            'disabled': false
        });
        $('#cod_art_1, #ob_art_1, #cod_art_2, #ob_art_2').parent('div').css({
            'display':'block'
        });
    }
}

function validateArticulator(){
    var ok = false;
    var quantity = $('#cant_art').val();
    var code1 = $('#cod_art_1').val();
    var observation1 = $('#ob_art_1');

    if (quantity == "NA"){
        ok = true;
        return ok;
    }
    else if (quantity == 1){
        if (code1 == "" || observation1 == ""){
            ok = false;
            return ok;
        }
        else {
            ok = true;
            return ok;
        }
    }
    else if (quantity == 2){
        var code2 = $('#cod_art_2').val();
        var observation2 = $('#ob_art_2').val();

        if (code1 == "" && code2 == "" || observation1 == "" || observation2 == ""){
            ok = false;
            return ok;
        }
        else {
            ok = true;
            return ok;
        }
    }
}
