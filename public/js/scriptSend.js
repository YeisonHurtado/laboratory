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
            } else if (data.save == false){
                alert('Ocurrió un error');
            }
        }
    });
}
