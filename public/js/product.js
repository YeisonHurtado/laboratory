$(document).on('ready', function(e){
    productList('productos');
});
function productList(route)
{
    $.ajax({
        url: route,
        type: 'get',
        success: function(data){
            $('#products_table').empty().html(data);
        }
    });
}