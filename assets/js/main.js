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