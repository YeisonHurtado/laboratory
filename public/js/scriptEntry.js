if ($('#cant_art').val() == "NA"){
    $('#cod_art_1, #cod_art_2, #ob_art_1, #ob_art_2').parent('div').attr({
        'disabled': true
    });
    $('#cod_art_1, #cod_art_2, #ob_art_1, #ob_art_2').parent('div').css({
        'display':'none'
    });
}
else if ($('#cant_art').val() == "1") {
    $('#cod_art_1, #ob_art_1').parent('div').attr({
        'disabled': false
    });
    $('#cod_art_1, #ob_art_1').parent('div').css({
        'display':'block'
    });
}

var exist_entry = false;

$(document).ready(function (e) {
    laboratorios();
    entryList();
    cajas();

    $('#no_orden').on('keyup', function (e) {
        var keycode = (e.keyCode ? e.keyCode : e.which);
        var code = $(this).val();
        if (keycode == 13){
            if (code != '')
                showOrderEntry(code);
        }
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

    $('button#ok_orden').on('click', function (e) {
        var order = $(this).attr('data-idOrden');
        repReception(order);
        $(this).attr({
            'data-idOrden' : '',
            'disabled' : true
        });
        $('#entryListModal').modal('hide');
        entryList();
    });

    $(document).on('click','table#entryListTable tbody tr', function (e) {
        var idOrder = $('td:first-child', this).text()
        $('#ok_orden').attr({
            'data-idOrden':idOrder,
            'disabled' : false
        });
        $('table#entryListTable tbody tr').removeClass('bg-info text-light');
        $(this).toggleClass('bg-info text-light');
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
                exist_entry = false;
                return false;
            }

            /*if (data.exists == true){
                alert("Este número de orden ya fue recepcionado, actulizar");
                return false;
            }*/

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
            $('input#total_cancelado').val(data.payment.CONSIGNADO);
            $('#id_payment').val(data.payment.ID);
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
            if ((data.exists) && (data.exists = true)) {
                exist_entry = true;
                var factura = !isNaN(data.invoice.IDFACTURA) ? data.invoice.IDFACTURA : data.invoice.ID;
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
                        '<input type="number" name="no_factura" id="no_factura" min="1" class="form-control form-control-sm" value="' + factura + '" readonly>' +
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
            }
            else {
                $.each(data.product, function (i, item) {
                    exist_entry = false;
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
            }

            // Ciclo para colocar los encabezados de "Diente" para una cantidad determinada
            for (i = 0; i < cantidad; i++){
                $('table#order_entry thead tr:last-child th:last-child').after(
                    '<th>Diente</th>'
                );
            }

            // Ciclo para colocar los selects de los dientes para determinada cantidad
            $.each(data.product, function (i, item) {
                for (i = 0; i < item.pivot.CANTIDAD; i++){
                    $('table#order_entry tbody tr:last-child td:last-child').after(
                        '<td>' +
                        '<div class="input-group input-group-mini">' +
                        '<select name="diente[]" class="diente form-control form-control-sm">' +
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

            // Condicional y  ciclo para seleccionar los dientes segun la base de datos
            if ((data.exists) && (data.exists = true)){
                chooseTeeth(8,data.entry);
            }
            $('#pending_payment').attr({
                'disabled': true,
                'data-id_orden': '',
                'data-id_factura': ''
            });
            $('#select_product, #cantidad, #btnAdd').attr('disabled', true);
        }
    });
}

function repReception(idOrder) {
    cajas();
    var route = "orden/"+idOrder+"/productos";
    var cantidad = 0;
    $.ajax({
        url: route,
        type: 'get',
        dataType: 'json',
        success: function (data) {
            $('#no_orden').val(data.order.IDORDEN);
            $('select#laboratorio').val(data.entry.LABORATORIO_ID);
            $('textarea#preescripcion').val(data.entry.PREESCRIPCION);
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
            $('input#total_cancelado').val(data.payment.CONSIGNADO);
            $('#id_payment').val(data.payment.ID);
            $('table#order_entry thead tr').empty();
            $('table#order_entry thead tr').append(
                '<th>Código</th>' +
                '<th>Descripción</th>' +
                '<th>Valor unitario</th>' +
                '<th>Cantidad</th>' +
                '<th>Total</th>' +
                '<th>Factura</th>'
            );
            $('table#order_entry tbody').empty();
            exist_entry = true;
            var factura = !isNaN(data.invoice.IDFACTURA) ? data.invoice.IDFACTURA : data.invoice.ID;
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
                    '<input type="number" name="no_factura" id="no_factura" min="1" class="form-control form-control-sm" value="' + factura + '" readonly>' +
                    '<i class="fas fa-file-invoice"></i>' +
                    '</div>' +
                    '</td>' +
                    '<td>' +
                    '</tr>'
                );
                cantidad = cantidad + Number(item.pivot.CANTIDAD);
            });

            // Ciclo para colocar los encabezados de "Diente" para una cantidad determinada
            for (i = 0; i < cantidad; i++){
                $('table#order_entry thead tr th:last-child').after(
                    '<th>Diente</th>'
                );
            }

            // Ciclo para colocar los selects de los dientes para determinada cantidad
            $.each(data.product, function (i, item) {
                for (i = 0; i < item.pivot.CANTIDAD; i++){
                    $('table#order_entry tbody tr td:nth-child(6)').after(
                        '<td>' +
                        '<div class="input-group input-group-mini">' +
                        '<select name="diente[]" class="diente form-control form-control-sm">' +
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

            // Condicional y  ciclo para seleccionar los dientes segun la base de datos
            if ((data.exists) && (data.exists = true)){
                chooseTeeth(7,data.entry);
            }
            $('#pending_payment').attr({
                'disabled': true,
                'data-id_orden': '',
                'data-id_factura': ''
            });
        }
    });
}

function entryList() {
    $.ajax({
        url: 'lista/ingresos',
        type: 'get',
        success: function (data) {
            $('table#entryListTable tbody').html(data);
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
                    exist_entry = false;
                    return false;
                }
                if (exist_entry){
                    updateEntry(code)
                } else {
                    saveEntry();
                }
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

function chooseTeeth(i, data) {
    //$.each(data, function (index, item){
        if (data.D11 == "1") {
            $('table#order_entry tbody tr td:nth-child('+i+') select.diente').val('D11');
            i++;
        }
        if (data.D12 == "1") {
            $('table#order_entry tbody tr td:nth-child('+i+') select.diente').val('D12');
            i++;
        }
        if (data.D13 == "1") {
            $('table#order_entry tbody tr td:nth-child('+i+') select.diente').val('D13');
            i++;
        }
        if (data.D14 == "1") {
            $('table#order_entry tbody tr td:nth-child('+i+') select.diente').val('D14');
            i++;
        }
        if (data.D15 == "1") {
            $('table#order_entry tbody tr td:nth-child('+i+') select.diente').val('D15');
            i++;
        }
        if (data.D16 == "1") {
            $('table#order_entry tbody tr td:nth-child('+i+') select.diente').val('D16');
            i++;
        }
        if (data.D17 == "1") {
            $('table#order_entry tbody tr td:nth-child('+i+') select.diente').val('D17');
            i++;
        }
        if (data.D18 == "1") {
            $('table#order_entry tbody tr td:nth-child('+i+') select.diente').val('D18');
            i++;
        }
        if (data.D21 == "1") {
            $('table#order_entry tbody tr td:nth-child('+i+') select.diente').val('D21');
            i++;
        }
        if (data.D22 == "1") {
            $('table#order_entry tbody tr td:nth-child('+i+') select.diente').val('D22');
            i++;
        }
        if (data.D23 == "1") {
            $('table#order_entry tbody tr td:nth-child('+i+') select.diente').val('D23');
            i++;
        }
        if (data.D24 == "1") {
            $('table#order_entry tbody tr td:nth-child('+i+') select.diente').val('D24');
            i++;
        }
        if (data.D25 == "1") {
            $('table#order_entry tbody tr td:nth-child('+i+') select.diente').val('D25');
            i++;
        }
        if (data.D26 == "1") {
            $('table#order_entry tbody tr td:nth-child('+i+') select.diente').val('D26');
            i++;
        }
        if (data.D27 == "1") {
            $('table#order_entry tbody tr td:nth-child('+i+') select.diente').val('D27');
            i++;
        }
        if (data.D28 == "1") {
            $('table#order_entry tbody tr td:nth-child('+i+') select.diente').val('D28');
            i++;
        }
        if (data.D31 == "1") {
            $('table#order_entry tbody tr td:nth-child('+i+') select.diente').val('D31');
            i++;
        }
        if (data.D32 == "1") {
            $('table#order_entry tbody tr td:nth-child('+i+') select.diente').val('D32');
            i++;
        }
        if (data.D33 == "1") {
            $('table#order_entry tbody tr td:nth-child('+i+') select.diente').val('D33');
            i++;
        }
        if (data.D34 == "1") {
            $('table#order_entry tbody tr td:nth-child('+i+') select.diente').val('D34');
            i++;
        }
        if (data.D35 == "1") {
            $('table#order_entry tbody tr td:nth-child('+i+') select.diente').val('D35');
            i++;
        }
        if (data.D36 == "1") {
            $('table#order_entry tbody tr td:nth-child('+i+') select.diente').val('D36');
            i++;
        }
        if (data.D37 == "1") {
            $('table#order_entry tbody tr td:nth-child('+i+') select.diente').val('D37');
            i++;
        }
        if (data.D38 == "1") {
            $('table#order_entry tbody tr td:nth-child('+i+') select.diente').val('D38');
            i++;
        }
        if (data.D41 == "1") {
            $('table#order_entry tbody tr td:nth-child('+i+') select.diente').val('D41');
            i++;
        }
        if (data.D42 == "1") {
            $('table#order_entry tbody tr td:nth-child('+i+') select.diente').val('D42');
            i++;
        }
        if (data.D43 == "1") {
            $('table#order_entry tbody tr td:nth-child('+i+') select.diente').val('D43');
            i++;
        }
        if (data.D44 == "1") {
            $('table#order_entry tbody tr td:nth-child('+i+') select.diente').val('D44');
            i++;
        }
        if (data.D45 == "1") {
            $('table#order_entry tbody tr td:nth-child('+i+') select.diente').val('D45');
            i++;
        }
        if (data.D46 == "1") {
            $('table#order_entry tbody tr td:nth-child('+i+') select.diente').val('D46');
            i++;
        }
        if (data.D47 == "1") {
            $('table#order_entry tbody tr td:nth-child('+i+') select.diente').val('D47');
            i++;
        }
        if (data.D48 == "1") {
            $('table#order_entry tbody tr td:nth-child('+i+') select.diente').val('D48');
            i++;
        }
    //});
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

function updateEntry(idOrder) {
    var route = 'ingreso/'+idOrder+'/';
    var token = $('#token_entry').val();
    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'PATCH',
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

            if (data.update){
                $('#error_entry').addClass('d-none');
                $('#success_entry').removeClass('d-none').fadeIn(100).delay(5000).fadeOut(100);
                $('#entryForm')[0].reset();
                cajas();
                $('table#order_entry tbody').empty();
            }

            else if (!data.update){
                $('#success_entry').addClass('d-none');
                $('#error_entry').removeClass('d-none').fadeIn(100).delay(5000).fadeOut(100);
            }

        }
    });

    return false;
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
