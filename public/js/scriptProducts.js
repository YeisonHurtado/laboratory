$(document).ready(function(e){
    productList('lista/productos');

    disabledInputs();

    $('#product_search').on('click', function (e) {
        productList('lista/productos');
        disabledButtonsDeleteEdit();
    });
    
    $(document).on('click', '.item',function () {
        $('tr.item').removeClass('bg-info text-light');
        $(this).toggleClass('bg-info text-light');
        $('#product_edit').attr('disabled',false);
        $('#product_delete').attr('disabled',false);
        $('#product_edit').attr('data-cod_prod',$(':first-child',this).text());
        $('#product_delete').attr('data-cod_prod',$(':first-child',this).text());
    });

    $('#product_edit').on('click', function (e) {
        e.preventDefault();
        enabledInputs();
        showProduct($(this).attr('data-cod_prod'));
    });

    $('#new_product').on('click', function (e) {
        e.preventDefault();
        enabledInputs();
        disabledButtonToNew();
    });
    
    $('#save_product').on('click', function (e) {
        e.preventDefault();
        var route = "addproductos";
        var token = $("#token").val();
        saveProduct(route, token);
    })

    $('#update_product').on('click', function (e) {
        e.preventDefault();
        var code = $('#cod_product').val();
        var route = "productos/"+code;
        var token = $("#token").val();
        updateProduct(route, token);
    });

    $('#product_delete').on('click', function (e) {
        e.preventDefault();
        var code = $(this).attr('data-cod_prod');
        $('#formDelete_product p').text("¿Desea eliminar el producto con el código: " + code + "?");
        $('#destroy_product').attr('data-cod_prod',code);
    });
    
    $('#destroy_product').click(function (e) {
        var code = $(this).attr('data-cod_prod');
        deleteProduct(code);
    });

    $('#cod_producto').on('keyup', function (e) {
        var route = "lista/productos/"+$(this).val()+"/";
        disabledButtonsDeleteEdit();
        productList(route);
    });

    $('#nom_producto').on('keyup', function (e) {
        var route = "name/productos/"+$(this).val()+"/";
        var route = "name/productos/"+$(this).val()+"/";
        disabledButtonsDeleteEdit();
        productList(route);
    });
});



/* ---------------------------------------------------- */
//      Funciones para realizar el CRUD de PRODUCTOS    //
/* ---------------------------------------------------- */

    function productList(route) {
    $.ajax({
        url: route,
        type: 'get',
        success: function(data){
            $('#products_table table tbody').empty().html(data);
        }
    });
}

    function showProduct(code) {
    var route = "/productos/"+code+"/edit";
    var form = $('#productForm');
    $.get(route, function (data) {
        $('#cod_product').val(data.PRODUCT_CODE);
        $('#name_product').val(data.PRODUCT_NAME);
        $('#product_value').val(data.PRODUCT_VAL);
        enabledInputs();
        disabledButtonsToEdit();
    })
}

    function updateProduct(route, token) {
    $.ajax({
        url: route,
        type: 'PATCH',
        headers: {'X-CSRF-TOKEN':token},
        dataType: 'json',
        data: $('#product_form').serialize(),
        success: function (data) {
            productList("lista/productos");
            $('.message_product').addClass('success');
            $('.message_product').text('Producto actualizado exitosamente.');
            $('.message_product').fadeIn(500).delay(3000).fadeOut(500);
            clearForm();
            disabledButtonToSave();
        },
        error: function (data) {
            $('.message_product').addClass('error');
            $('.message_product').text('¡Ups! Verifica que todos los datos estén correctos.');
            $('.message_product').fadeIn(500).delay(3000).fadeOut(500);
        }
    });
}

    function saveProduct(route, token) {
        $.ajax({
            url: route,
            type: 'POST',
            headers: {'X-CSRF-TOKEN':token},
            dataType: 'json',
            data: $('#product_form').serialize(),
            success: function (data) {
                if (data.save == "true") {
                    productList("lista/productos");
                    $('.message_product').addClass('success');
                    $('.message_product').text('Producto guardado exitosamente.');
                    $('.message_product').fadeIn(500).delay(3000).fadeOut(500);
                    clearForm();
                    disabledButtonToSave();
                } else if (data.exists == "true") {
                    $('.message_product').addClass('error');
                    $('.message_product').text('Ya hay un producto con el mismo código.');
                    $('.message_product').fadeIn(500).delay(3000).fadeOut(500);
                }

            },
            error: function (data) {
                $('.message_product').addClass('error');
                $('.message_product').text('¡Ups! Verifica que todos los datos estén correctos.');
                $('.message_product').fadeIn(500).delay(3000).fadeOut(500);
            }
        });
    }

    function deleteProduct(code) {
        var route = "productos/"+code;
        var token = $("#token").val();

        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN':token},
            type: 'DELETE',
            dataType: 'json',
            success: function (data) {
                productList('lista/productos');
                $('div.alert').removeClass('d-none');
                $('div.alert').text("Se eliminó el producto con el código " + code + "");
                $('div.alert').fadeIn(500).delay(3000).fadeOut(500);
            }
        });
    }

/* ---------------------------------------------------- */
/* ---------------------------------------------------- */

//------------------------------------------------------------------------------------ //

/* ---------------------------------------------------- */
//   Funciones para manejar el estado de los elementos  //
/* ---------------------------------------------------- */

    function clearForm(){
        $('#product_form')[0].reset();
        disabledInputs();
        disabledButtonToClose();
    }

    function enabledInputs() {
        $('#product_form input').attr('disabled',false);
    }

    function disabledInputs() {
        $('#product_form input').attr('disabled',true);
    }

    function disabledButtonToNew(){
        $('#cod_product').attr('readonly', false);
        $('#save_product').attr('disabled', false);
        $('#new_product').attr('disabled',true);
        $('#update_product').attr('disabled',true);
    }

    function disabledButtonToSave(){
        $('#cod_product').attr('readonly', false);
        $('#save_product').attr('disabled', true);
        $('#new_product').attr('disabled',false);
        $('#update_product').attr('disabled',true);
    }

    function disabledButtonsToEdit() {
        $('#cod_product').attr('readonly', true);
        $('#new_product').attr('disabled',true);
        $('#update_product').attr('disabled',false);
    }

    function disabledButtonsDeleteEdit() {
        $('#product_delete').attr('data-cod_prod','');
        $('#product_edit').attr('data-cod_prod','');
        $('#product_delete').attr('disabled',true);
        $('#product_edit').attr('disabled',true);
    }

    function disabledButtonToClose(){
        $('#cod_product').attr('readonly', false);
        $('#new_product').attr('disabled',false);
        $('#update_product').attr('disabled',true);
        $('#save_product').attr('disabled', true);
    }

/* ---------------------------------------------------- */
/* ---------------------------------------------------- */

