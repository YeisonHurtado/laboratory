$(document).ready(function (e) {
    showPending();
    $(document).on('click','#reception_table tbody tr button.send_work', function (e) {
        var reception = $(this).attr('data-id_recp');
        saveSend(reception);
    });
});
function showPending() {
    var route = "recepcion/pendientes";
    $.ajax({
        url: route,
        type: 'get',
        dataType: 'html',
        success: function (data) {
            $('table#reception_table tbody').html(data);
        }
    });
}

function saveSend(receptionId) {
    var token = $('input[name="_token"]').val();
    $.ajax({
        url: 'recepcion/guardar',
        type: 'post',
        headers: {'X-CSRF-TOKEN':token},
        data: { reception: receptionId },
        dataType: 'json',
        success: function (data) {
            if (data.save == true){
                showPending();
                $('div.success-envio').removeClass('d-none').fadeIn(200).delay(4000).fadeOut(200);
            } else if (data.save == false){
                alert('Ocurrió un error');
            }
        },
        error: function (request, status, error) {
            if (request && request.status == 500) {
                $('div.error-envio').text('Hubo un error en el servidor. No se pudo enviar.')
                $('div.error-envio').removeClass('d-none').fadeIn(200).delay(4000).fadeOut(200);
            }
        }
    });
}
