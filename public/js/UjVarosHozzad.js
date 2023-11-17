function varosHozzaad(){ //Új város felvételének működése
    let varosNeve = $('#ujVaros').val();
    let megyeId = $('#megyeValaszto').val();
    $.ajax({
        type: 'POST',
        url: '/varosHozzaad/',
        data: {
            _token: $("#csrf").val(),
            name: varosNeve,
            county_id: megyeId,
        },
        success: function(response) {
            showAlert(response.message, 'success');
        },
        error: function(error) {
            console.error('Error:', error);
            showAlert(response.message, 'danger');
        }
    });
    $('#ujVaros').val('');
    megyeValasztas($('#megyeValaszto').val());
}