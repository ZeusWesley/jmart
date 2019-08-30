const config = Object.freeze({
    baseUrl: window.origin,
    mode: 'production',
});

$(document).on('submit', '#product_store', function(e) {
    e.preventDefault();
    e.stopPropagation();
    var data = $(this).serialize();

    $.post(config.baseUrl + '/wp-json/jmart/product/store', data).done((res) => {
        swal('Sucesso!', 'Produto cadastrado com sucesso!', 'success');
        location.reload();
    }).fail((error) => {
        swal('Erro!', error, 'error');
    });
});

$(document).on('click', '#logout', function(e) {
    e.preventDefault();

    $.get(config.baseUrl + '/wp-json/jmart/logout').done((res) => {
        location.reload();
        console.log(res);
    }).fail((error) => {
        console.log(error);
    });
});

$(document).on('submit', '#filter', function(){
    var filter = $('#filter');
    $.ajax({
        url:filter.attr('action'),
        data:filter.serialize(), // form data
        type:filter.attr('method'), // POST
        beforeSend:function(xhr){
            filter.find('button').text('Processing...'); // changing the button label
        },
        success:function(data){
            filter.find('button').text('Apply filter'); // changing the button label back
            $('.blog_wrapper').html(data); // insert data
        }
    });
    return false;
});