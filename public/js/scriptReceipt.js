$(document).ready(function (event) {
    receiptProductList('recibo/producto');

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

    $(document).on('click', '.btn-quitar-item', function (e) {
        var code = $(this).attr('data-removeItem');
        $('#select_product option[value="'+ code + '"]').css('display','block');
        $(this).parents('tr').remove();
    });
});

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

function validateAddProduct() {
    var ok = true;

    if ($('#select_product').val() == ""){
        $('div.error-add-product').fadeIn(500).delay(2000).fadeOut(500);
        ok = false;
    }
    
    if ($('#cantidad').val() == "") {
        $('div.error-add-quantity').fadeIn(500).delay(2000).fadeOut(500);
        ok = false;
    }

    return ok;
}

function receiptProductList(route) {
    $.ajax({
        url: route,
        type: 'get',
        success: function(data){
            $('#lista_productos #select_product, #select_product_lab').empty().html(data);
        }
    });
}

function clearReceiptForm(){
    $('#receipt_form')[0].reset();
    receiptProductList('recibo/producto');
    $('table#product_adds tbody').empty();
}
