$(document).ready(function (e) {
    $(document).on('click','#payments tbody tr.item-payment', function (e) {
        $('tr.item-payment').removeClass('bg-info text-light');
        $(this).toggleClass('bg-info text-light');
        $('#pending_payment').attr({
            'disabled': false,
            'data-id_orden':$(':first-child',this).text(),
            'data-id_factura':$(':nth-child(2)',this).text()
        });
    });

    $('#pending_payment').on('click', function (e) {
        var idOrden = $(this).attr('data-id_orden');
        var idFactura = $(this).attr('data-id_factura');
        $('#id_order').val(idOrden);
        $('#id_factura').val(idFactura);
        showOrder(idOrden);
        $('input#mto_pago2').prop('checked', true);
        $('input#mto_pago1, input#mto_pagoU').attr('disabled', true);
    });


    $('#ban_payment').on('click', function (e) {
        resetPaymentModal();
    });
});

function resetPaymentModal() {
    $('#pending_payment').attr({
        'disabled': true,
        'data-id_orden': '',
        'data-id_factura': ''
    });
    $('input[name="mto_pago"]').prop({
        'checked': false
    });
    unicoPago = false;
    segundoPago = false;
}

function showOrder(idOrder) {
    var route = "orden/"+idOrder+"/productos";
    $.ajax({
        url: route,
        type: 'get',
        dataType: 'json',
        success: function (data) {
            if (data.show == "false"){
                alert("Este número de orden no existe");
                return false;
            }
            $('#code_student').val(data.student.EST_COD);
            $('#name_student').val(data.student.NOMBRE_EST);
            $('#email').val(data.student.CORREO);
            $('#telefono').val(data.student.TEL_CEL);
            $('#semestre').val(data.student.SEMESTRE);
            $('#nhc').val(data.patient.NUM_PACIENTE);
            $('#name_patient').val(data.patient.NOMBRE);
            $('#total_pagar').val(porcentaje(data.order.TOTAL_ORDEN));
            $.each(data.product, function (i, item) {
                $('table#product_adds tbody').append(
                    '<tr>' +
                        '<td><input type="text" name="code_product[]" class="code_product form-control form-control-sm" readonly value="'+item.PRODUCT_CODE+'"></td>' +
                        '<td>'+item.PRODUCT_NAME+'</td>'+
                        '<td><i class="fa fa-dollar-sign"></i> '+item.PRODUCT_VAL+'</td>'+
                        '<td><input type="number" name="quantity[]" class="quantity_prod form-control form-control-sm" readonly value="'+item.pivot.CANTIDAD+'"></td>'+
                        '<td>' +
                            '<div class="input-group input-group-mini">' +
                                '<input type="number" name="total_item[]" class="total_item form-control form-control-sm" readonly value="'+item.pivot.TOTAL_ITEM+'">' +
                                '<i class="fa fa-dollar-sign"></i>'+
                            '</div>'+
                        '</td>' +
                        '<td hidden="hidden">' +
                        '<button type="button" class="btn btn-danger btn-sm btn-quitar-item"></button>' +
                        '</td>'+
                    '</tr>'
                );
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

function porcentaje(total) {
    var code = $('#code_student').val();
    var pref = code[0] + code[1]
    if (pref == "OD"){
        return Number(total) * 0.50;
    } else {
        return Number(total) * 0.20;
    }
}
