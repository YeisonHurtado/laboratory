$(document).ready(function (event) {
    orderProductList('orden/producto');
    disabledAllInputs();
    disabledButtons();

    $('#new_reciept').on('click', function (e) {
        e.preventDefault();
        enabledAllInputs();
        $('#new_reciept').attr('disabled', true);
        $('#save_receipt, #print_reciept').attr('disabled', false);
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

    $('#btnAdd').on('click', function (e) {
        var code = $('#select_product').val();
        var quantity = $('#cantidad').val();
        if (validateAddProduct()){
            addRowProduct(code, quantity);
            $('#select_product').val('');
            $('#select_product option[value="'+ code + '"]').css('display','none');
            $('#cantidad').val('');
        }

    });

    $('#save_receipt').on('click', function (e) {
        saveStudent();
    });

    $(document).on('click', '.btn-quitar-item', function (e) {
        var code = $(this).attr('data-removeItem');
        $('#select_product option[value="'+ code + '"]').css('display','block');
        $(this).parents('tr').remove();
    });
    
    $(document).on('click', '.patient_item', function (e) {
        $('tr.patient_item').removeClass('bg-info text-light');
        $(this).toggleClass('bg-info text-light');
        $('#show_patient').attr('disabled', false);
        $('#show_patient').attr('data-numHC',$(':first-child',this).text())
    });

    $(document).on('click', '.patients_items', function (e) {
        $('#num_hc').val($(':first-child',this).text());
        $('tr.patients_items').removeClass('bg-info text-light');
        $(this).toggleClass('bg-info text-light');
        $('#change_student').attr('disabled', false);
        $('#change_student').attr('data-numHC',$(':first-child',this).text())
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

    function validateAddProduct() {
        var ok = true;

        if ($('#select_product').val() == ""){
            $('div.error-add-product').fadeIn(500).delay(2000).fadeOut(500);
            ok = false;
        }

        if ($('#cantidad').val() == "" || $('#cantidad').val() == 0) {
            $('div.error-add-quantity').fadeIn(500).delay(2000).fadeOut(500);
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
                    '<td> <input type="text" name="receipt[codigo_prod]" class="codigo_prod form-control form-control-sm" readonly value="' + data.PRODUCT_CODE + '"> </td>' +
                    '<td>'+data.PRODUCT_NAME+'</td>' +
                    '<td><i class="fa fa-dollar-sign"></i> '+data.PRODUCT_VAL+'</td>' +
                    '<td> <input type="number" name="receipt[cantidad]" class="cantidad_prod form-control form-control-sm" readonly value="' + quantity + '"> </td>' +
                    '<td class="">' +
                    '<div class="input-group input-group-mini">' +
                    '<input type="number" name="receipt[cantidad]" class="total_prod form-control form-control-sm" readonly value="' + data.PRODUCT_VAL * quantity + '">' +
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
                if (data.save == "true"){

                } else if (data.save == "false") {
                    
                }
                
                if (data.errors) {
                    if (data.errors.code_student) {
                        $('.error-codestd').removeClass('d-none');
                        $('.error-codestd').text(data.errors.code_student[0]);
                        $('.error-codestd').fadeIn(500).delay(2000).fadeOut(500);
                    }

                    if (data.errors.name_student) {
                        $('.error-namestd').removeClass('d-none');
                        $('.error-namestd').text(data.errors.name_student[0]);
                        $('.error-namestd').fadeIn(500).delay(2000).fadeOut(500);
                    }

                    if (data.errors.email) {
                        $('.error-emailstd').removeClass('d-none');
                        $('.error-emailstd').text(data.errors.email[0]);
                        $('.error-emailstd').fadeIn(500).delay(2000).fadeOut(500);
                    }

                    if (data.errors.telefono) {
                        $('.error-telstd').removeClass('d-none');
                        $('.error-telstd').text(data.errors.telefono[0]);
                        $('.error-telstd').fadeIn(500).delay(2000).fadeOut(500);
                    }

                    if (data.errors.semestre) {
                        $('.error-semestre').removeClass('d-none');
                        $('.error-semestre').text(data.errors.semestre[0]);
                        $('.error-semestre').fadeIn(500).delay(2000).fadeOut(500);
                    }
                }
            }
        });
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
        $('#save_receipt, #print_reciept, #update_receipt, #update_receipt').attr({'disabled':true});
    }

    function enabledAllInputs() {
        $('#order_form input, #order_form select').attr('disabled', false);
    }

    function clearOrderForm(){
        $('#order_form')[0].reset();
        disabledAllInputs();
        disabledButtons();
        orderProductList('orden/producto');
        $('table#product_adds tbody').empty();
    }

// ---------------------------------------------------------------- //
// ---------------------------------------------------------------- //
