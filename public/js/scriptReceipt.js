var vaciado = false;
var repeticion = false;
var segundoPago = false;
var unicoPago = false;

if ($('#vaciado_si').prop('checked'))
    vaciado = true;

if ($('#vaciado_no').prop('checked')){
    vaciado = false;
    repeticion = false;
}

if ($('#repeticion_si').prop('checked'))
    repeticion = true;

if ($('#repeticion_no').prop('checked'))
    repeticion = false;

if ($('#mto_pago2').prop('checked')){
    segundoPago = true;
    unicoPago = false;
} else {
    segundoPago = false;
}

$(document).ready(function (event) {
    orderProductList('orden/producto');
    disabledAllInputs();
    disabledButtons();

    $('#new_reciept').on('click', function (e) {
        e.preventDefault();
        enabledAllInputs();
        $('#btnAdd').attr('disabled', false);
        $('#new_reciept').attr('disabled', true);
        $('#save_receipt').attr('disabled', false);
        $('#code_student').focus();
    });

    $('#code_student').on('keyup', function (e) {
        var key = (e.keyCode ? e.keyCode : e.which);
        if (key == 13){
            var code = $(this).val();
            consultStudent(code);
            $('#show_patient').attr('disabled', true);
            $('#search_other').attr('data-code_std', code);
        }
    });

    $('#nhc').on('keyup', function (e) {
        var key = (e.keyCode ? e.keyCode : e.which);
        if (key == 13){
            var numhc = $(this).val();
            showOnePatient(numhc);
        }
    });
    
    $('#show_patient').on('click', function (e) {
        var num = $(this).attr('data-numHC');
        showOnePatient(num);
    });

    $('#search_other').on('click', function (e) {
        var code = $(this).attr('data-code_std');
        $('#student_code').val(code);
        $('#change_student').attr({
            'disabled':true,
            'data-numhc':''
        });
        showAllPatients(code);
    });

    $('#change_student').on('click', function (e) {
        e.preventDefault();
        var code = $('#num_hc').val();
        var token = $('#token').val();
        updatePatientStudent(code, token);
    });

    $('#vaciado_si, #vaciado_no').on('click', function (e) {
        if ($('#vaciado_si').prop('checked')){
            vaciado = true;
            $('#repeticion').css('display','inherit');
        }

        if ($('#vaciado_no').prop('checked')){
            vaciado = false;
            $('#repeticion').css('display','none');
            $('#repeticion_no').prop('checked', true);
            repeticion = false;
        }
    });

    $('#repeticion_si, #repeticion_no').on('click', function (e) {
        if ($('#repeticion_si').prop('checked'))
            repeticion = true;

        if ($('#repeticion_no').prop('checked'))
            repeticion = false;
    });

    $('#btnAdd').on('click', function (e) {
        var code = $('#select_product').val();
        var quantity = $('#cantidad').val();
        if (validateAddProduct()){
            addRowProduct(code, quantity);
            $('#select_product').val('');
            $('#select_product option[value="'+ code + '"]').css('display','none');
            $('#cantidad').val('');
            var row = Number(countProducts()) + 1;
            if (row > 0) {
                $('#mto_pago1, #mto_pago2, #mto_pagoU').prop({
                    'checked': false,
                    'disabled': false
                });
                $('#total_pagar').val('');
            }
        }

    });

    $('#mto_pago1, #mto_pago2').on('click', function (e) {
        if ($(this).prop('checked') == true){
            totalOrder(0.50);
        }
        if ($('#mto_pago1').prop('checked')){
            segundoPago = false;
            unicoPago = false;
        }

        if ($('#mto_pago2').prop('checked')){
            pendingPayment();
            segundoPago = true;
            unicoPago = false;
        } else {
            segundoPago = false;
        }
    });

    $('#mto_pagoU').on('click', function (e) {
        if ($(this).prop('checked')) {
            totalOrder(1);
        }
        unicoPago = true;
        segundoPago = false;
    });

    $('#save_receipt').on('click', function (e) {
        saveStudent();
    });

    $(document).on('click', '.btn-quitar-item', function (e) {
        var code = $(this).attr('data-removeItem');
        $('#select_product option[value="'+ code + '"]').css('display','block');
        $(this).parents('tr').remove();
        var row = Number(countProducts());
        
        if (row == 0) {
            $('#mto_pago1, #mto_pago2, #mto_pagoU').prop({
                'checked': false,
                'disabled': true
            });
            $('#total_pagar').val('');
        } else if (row > 0) {
            $('#mto_pago1, #mto_pago2, #mto_pagoU').prop({
                'checked': false,
                'disabled': false
            });
            $('#total_pagar').val('');
        }

    });
    
    $(document).on('click', '.patient_item', function (e) {
        $('tr.patient_item').removeClass('bg-info text-light');
        $(this).toggleClass('bg-info text-light');
        $('#show_patient').attr('disabled', false);
        $('#show_patient').attr('data-numHC',$(':first-child',this).text());
    });

    $(document).on('click', '.patients_items', function (e) {
        $('#num_hc').val($(':first-child',this).text());
        $('tr.patients_items').removeClass('bg-info text-light');
        $(this).toggleClass('bg-info text-light');
        $('#change_student').attr('disabled', false);
        $('#change_student').attr('data-numHC',$(':first-child',this).text());
    });


});

// ---------------------------------------------------------------- //
/*                Funciones para realizar el crud                  */
// ---------------------------------------------------------------- //

    function consultStudent(code) {
        var route = "estudiante/"+code;
        $.ajax({
            url: route,
            type: 'get',
            dataType: 'json',
            success: function (data) {
                if ($.isEmptyObject(data)){
                    $('#name_student').focus();
                    $('#name_student').val(data.NOMBRE_EST);
                    $('#email').val(data.CORREO);
                    $('#telefono').val(data.TEL_CEL);
                    $('#semestre option[value="I"]').attr('selected', true);
                } else {
                    $('#name_student').val(data.NOMBRE_EST);
                    $('#email').val(data.CORREO);
                    $('#telefono').val(data.TEL_CEL);
                    $('#semestre').val(data.SEMESTRE);
                    patients(code);
                    $('body').addClass('modal-open');
                    $('#patientStudent').modal('show');
                    //$('#patientStudent').attr('aria-hidden', false);
                    //$('#patientStudent').css('display','block');
                    //$('#semestre option[value="'+item.SEMESTRE+'"]').attr('selected', true);
                }
            }
        });
    }

    function patients(code) {
        var route = "estudiante/"+code+"/pacientes";
        $.ajax({
            url: route,
            type: 'get',
            success: function (data) {
                $('#student_patients tbody').empty().html(data);
            }
        });
    }

    function showOnePatient(numhc) {
        var route = "paciente/"+numhc+"/show";
        $.ajax({
            url: route,
            type: 'get',
            dataType: 'json',
            success: function (data) {
                $('#nhc').val(data.NUM_PACIENTE);
                $('#name_patient').val(data.NOMBRE);
            }
        });
    }

    function showAllPatients(code) {
        var route = "paciente/"+code+"/all";
        $.ajax({
            url: route,
            type: 'get',
            success: function (data) {
                $('#all_patients tbody').html(data);
            }
        });
    }

    function updatePatientStudent(code, token) {
        var route = "paciente/"+code;
        $.ajax({
            url: route,
            type: 'PATCH',
            headers: {'X-CSRF-TOKEN':token},
            dataType: 'json',
            data: $('form#patients').serialize(),
            success: function (data) {
                if (data.update == "true"){
                    $('#patientStudent').modal('toggle');
                    showOnePatient($('#num_hc').val());
                }
            }
        });
    }

    function orderProductList(route) {
        $.ajax({
            url: route,
            type: 'get',
            success: function(data){
                $('#lista_productos #select_product, #select_product_lab').empty().html(data);
            }
        });
    }

    function pendingPayment() {
        $.ajax({
            url: 'pagos',
            type: 'get',
            success: function (data) {
                $('#paymentsModal').modal('show');
                $('#payments tbody').html(data);
            }
        });
    }
    
    function validateAddProduct() {
        var ok = true;

        if ($('#select_product').val() == ""){
            $('div.error-add-product').fadeIn(500).delay(7000).fadeOut(500);
            ok = false;
        }

        if ($('#cantidad').val() == "" || $('#cantidad').val() == 0) {
            $('div.error-add-quantity').fadeIn(500).delay(7000).fadeOut(500);
            ok = false;
        }

        return ok;
    }

    function addRowProduct(code, quantity){
        var route = "/productos/"+code+"/edit";
        $.ajax({
            url: route,
            type: 'get',
            dataType: 'json',
            success: function (data) {
                $('table#product_adds tbody').append('<tr>' +
                    '<td> <input type="text" name="code_product[]" class="code_product form-control form-control-sm" readonly value="' + data.PRODUCT_CODE + '"> </td>' +
                    '<td>'+data.PRODUCT_NAME+'</td>' +
                    '<td><i class="fa fa-dollar-sign"></i> '+data.PRODUCT_VAL+'</td>' +
                    '<td> <input type="number" name="quantity[]" class="quantity_prod form-control form-control-sm" readonly value="' + quantity + '"> </td>' +
                    '<td class="">' +
                    '<div class="input-group input-group-mini">' +
                    '<input type="number" name="total_item[]" class="total_item form-control form-control-sm" readonly value="' + data.PRODUCT_VAL * quantity + '">' +
                    '<i class="fa fa-dollar-sign"></i>' +
                    '</div>' +
                    '</td>' +
                    '<td>' +
                    '<div class="input-group input-group-mini">' +
                    '<input type="number" name="total[]" class="total form-control form-control-sm" readonly>' +
                    '<i class="fa fa-dollar-sign"></i>' +
                    '</div>' +
                    '</td>' +
                    '<td><button type="button" class="btn btn-danger btn-sm btn-quitar-item" data-removeItem="' + data.PRODUCT_CODE + '"><i class="fas fa-trash-alt"></i> Quitar</button></td>' +
                    '</tr>');
            }

        });
    }

    /**   Guardar datos  */
    
    function saveStudent() {
        var route = "estudiante";
        var token = $('input[name="_token"]').val();

        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN':token},
            type: 'POST',
            dataType: 'json',
            data: $('#order_form').serialize(),
            success: function (data) {
                if (data.save == "true" || data.update == "true"){
                    savePatient(token);
                } else if (data.save == "false") {
                    
                }
                
                if (data.errors) {
                    if (data.errors.code_student) {
                        $('.error-codestd').removeClass('d-none');
                        $('.error-codestd').text(data.errors.code_student[0]);
                        $('.error-codestd').fadeIn(500).delay(7000).fadeOut(500);
                        $('#code_student').focus();
                    }

                    if (data.errors.name_student) {
                        $('.error-namestd').removeClass('d-none');
                        $('.error-namestd').text(data.errors.name_student[0]);
                        $('.error-namestd').fadeIn(500).delay(7000).fadeOut(500);
                        $('#name_student').focus();
                    }

                    if (data.errors.email) {
                        $('.error-emailstd').removeClass('d-none');
                        $('.error-emailstd').text(data.errors.email[0]);
                        $('.error-emailstd').fadeIn(500).delay(7000).fadeOut(500);
                        $('#email').focus();
                    }

                    if (data.errors.telefono) {
                        $('.error-telstd').removeClass('d-none');
                        $('.error-telstd').text(data.errors.telefono[0]);
                        $('.error-telstd').fadeIn(500).delay(7000).fadeOut(500);
                        $('#telefono').focus();
                    }

                    if (data.errors.semestre) {
                        $('.error-semestre').removeClass('d-none');
                        $('.error-semestre').text(data.errors.semestre[0]);
                        $('.error-semestre').fadeIn(500).delay(7000).fadeOut(500);
                    }
                }
            }
        });
    }
    
    function savePatient() {
        var route = "paciente";
        var token = $('input[name="_token"]').val();

        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN':token},
            type: 'POST',
            dataType: 'json',
            data: $('#order_form').serialize(),
            success: function (data) {
                if (data.save == "true" || data.update == "true"){
                    saveOrder();
                } else if (data.save == "false"){
                
                }

                if (data.errors){
                    if (data.errors.nhc){
                        $('.error-numhc').removeClass('d-none');
                        $('.error-numhc').text(data.errors.nhc[0]);
                        $('.error-numhc').fadeIn(500).delay(7000).fadeOut(500);
                    }
                    
                    if (data.errors.name_patient){
                        $('.error-namepatient').removeClass('d-none');
                        $('.error-namepatient').text(data.errors.name_patient[0]);
                        $('.error-namepatient').fadeIn(500).delay(7000).fadeOut(500);
                    }
                }
            },
            error: function (data) {
                console.log('Algo anda mal :(');
            }
        });
    }
    
    function saveOrder() {
        var route = "orden";
        var token = $('input[name="_token"]').val();

        if (!segundoPago) {
            $.ajax({
                url: route,
                headers: {'X-CSRF-TOKEN':token},
                type: 'POST',
                data: $('#order_form').serialize(),
                dataType: 'json',
                success: function (data) {
                    if (data.save == "true"){
                        $('#order_message').removeClass('d-none alert alert-danger border-danger text-danger');
                        $('#order_message').addClass('alert alert-success border-success text-success');
                        $('#order_message').text("Orden de pago guardada.");
                        $('#order_message').fadeIn(2000).delay(8000).fadeOut(2000);
                        readyToPrint(data.ID, '');
                        clearOrderForm();
                    } else if (data.save == "false"){
                        $('#order_message').removeClass('d-none alert alert-success border-success text-success');
                        $('#order_message').addClass('alert alert-danger border-danger text-danger');
                        $('#order_message').text("No se pudo guardar.");
                        $('#order_message').fadeIn(2000).delay(8000).fadeOut(2000);
                    }

                    if (data.products == "false"){
                        console.log('Escoge productos');
                    }

                    if (data.errors){
                        if (data.errors.mto_pago){
                            $('div.error-mpago').removeClass('d-none').fadeIn(100).delay(2000).fadeOut(200);
                        }
                    }
                },
            });
        }
        else if (segundoPago) {
            $.ajax({
                url: route+'/segunda',
                headers: {'X-CSRF-TOKEN':token},
                type: 'POST',
                data: $('#order_form').serialize(),
                dataType: 'json',
                success: function (data) {
                    if (data.save == "true"){
                        $('#order_message').removeClass('d-none alert alert-danger border-danger text-danger alert-success border-success text-success');
                        $('#order_message').addClass('alert alert-success border-success text-success');
                        $('#order_message').text("Segunda orden de pago guardada. Queda pendiente para pagar en caja.");
                        $('#order_message').fadeIn(2000).delay(8000).fadeOut(2000);
                        readyToPrint('', data.ID)
                        clearOrderForm();
                    } else if (data.save == "false"){
                        $('#order_message').removeClass('d-none alert alert-success border-success text-success');
                        $('#order_message').addClass('alert alert-danger border-danger text-danger');
                        $('#order_message').text("No se pudo guardar.");
                        $('#order_message').fadeIn(2000).delay(8000).fadeOut(2000);
                    }

                    if (data.errors){
                        if (data.errors.mto_pago){
                            $('div.error-mpago').removeClass('d-none').fadeIn(100).delay(2000).fadeOut(200);
                        }
                    }
                }
            });
        }
    }
    
    function readyToPrint(idConsult, idOrder) {
        if (idConsult != ""){
            $.ajax({
                url: 'consulta/'+idConsult,
                type: 'get',
                dataType: 'json',
                success: function (data) {
                    $('#printCodStu').val(data.student.EST_COD);
                    $('#printNameStudent').val(data.student.NOMBRE_EST);
                    $('#printCodPat').val(data.patient.NUM_PACIENTE);
                    $('#printNamePat').val(data.patient.NOMBRE);
                    $('#printReceiptModal').modal('show');
                    $.each(data.product, function (i, item) {
                        $.each(item, function (k, l) {
                            $('table#printReceiptTable tbody').append(
                                '<tr>' +
                                '<td><input type="text" name="printCodeProduct[]" class="printCodeProduct form-control form-control-sm" readonly value="'+l.PRODUCT_CODE+'"></td>' +
                                '<td><input type="hidden" name="printNameProd[]" value="'+ l.PRODUCT_NAME +'">'+l.PRODUCT_NAME+'</td>'+
                                '<td><i class="fa fa-dollar-sign"></i> '+l.PRODUCT_VAL+'</td>'+
                                '<td><input type="number" name="printQuantity[]" class="printQuantity form-control form-control-sm" readonly value="'+l.pivot.CANTIDAD+'"></td>' +
                                '<td>'+
                                //'<button type="button" name="print_reciept" data-print_order="'+l.pivot.ID_ORDEN+'" data-id_consult="'+data.consult.ID+'" class="print_reciept btn btn-success btn-sm my-1"><i class="fas fa-print"></i> Imprimir</button>' +
                                '<a href="consulta/'+ data.consult.ID +'/orden/'+ l.pivot.ID_ORDEN+'" class="print_reciept btn btn-success btn-sm my-1"><i class="fas fa-print"></i> Imprimir</a>' +
                                '</td>'+
                                '</tr>'
                            );
                        });

                    });
                }
            });
            return false;
        }
        else if (idOrder != ""){
            $.ajax({
                url: 'orden/'+idOrder,
                type: 'get',
                dataType: 'json',
                success: function (data) {
                    $('#printCodStu').val(data.student.EST_COD);
                    $('#printNameStudent').val(data.student.NOMBRE_EST);
                    $('#printCodPat').val(data.patient.NUM_PACIENTE);
                    $('#printNamePat').val(data.patient.NOMBRE);
                    $('#printReceiptModal').modal('show');
                    $.each(data.product, function (i, item) {
                        $('table#printReceiptTable tbody').append(
                            '<tr>' +
                            '<td><input type="text" name="printCodeProduct[]" class="printCodeProduct form-control form-control-sm" readonly value="'+item.PRODUCT_CODE+'"></td>' +
                            '<td><input type="hidden" name="printNameProd[]" value="'+ item.PRODUCT_NAME +'">'+item.PRODUCT_NAME+'</td>'+
                            '<td><i class="fa fa-dollar-sign"></i> '+item.PRODUCT_VAL+'</td>'+
                            '<td><input type="number" name="printQuantity[]" class="printQuantity form-control form-control-sm" readonly value="'+item.pivot.CANTIDAD+'"></td>' +
                            '<td>'+
                            //'<button type="button" name="print_reciept" data-print_order="'+l.pivot.ID_ORDEN+'" data-id_consult="'+data.consult.ID+'" class="print_reciept btn btn-success btn-sm my-1"><i class="fas fa-print"></i> Imprimir</button>' +
                            '<a href="consulta/'+ data.consult.ID +'/orden/'+ item.pivot.ID_ORDEN+'" class="print_reciept btn btn-success btn-sm my-1"><i class="fas fa-print"></i> Imprimir</a>' +
                            '</td>'+
                            '</tr>'
                        );
                    });
                }
            });
            return false;
        }
    }
    
    function totalOrder(percent) {
        var subTotal = 0;
        var total = Array();
        var i = 0;
        $('input.total_item').each(function () {
            subTotal = subTotal + Number($(this).val());
            total[i] = Number($(this).val()) * percent;
            i++;
        });

        var j = 0;
        $('input.total').each(function () {
            $(this).val(total[j]);
            j++;
        });
        return subTotal;
    }
    
    function countProducts() {
        var row = 0;
        $('table#product_adds tbody tr').each(function () {
            row ++;
        });

        return row;
    }

// ---------------------------------------------------------------- //
// ---------------------------------------------------------------- //

// ---------------------------------------------------------------- //
/*      Funciones para el comportamiento de los elementos           */
// ---------------------------------------------------------------- //

    function disabledAllInputs() {
        $('#order_form input, #order_form select').attr('disabled', true);
    }

    function disabledButtons() {
        $('#new_reciept').attr('disabled', false);
        $('#save_receipt, #update_receipt, #update_receipt').attr({'disabled':true});
    }

    function enabledAllInputs() {
        $('#order_form input, #order_form select').attr('disabled', false);
    }

    function clearOrderForm(){
        $('#order_form')[0].reset();
        segundoPago = false;
        disabledAllInputs();
        disabledButtons();
        orderProductList('orden/producto');
        $('table#product_adds tbody').empty();
    }

// ---------------------------------------------------------------- //
// ---------------------------------------------------------------- //
