function varosHozzaad(){ //Új város felvételének működése
    let varosNeve = $('#ujVaros').val();
    let megyeId = $('#megyeValaszto').val();
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '/varosHozzaad/',
        data: {
            name: varosNeve,
            county_id: megyeId,
        },
        success: function(response) {
            if(response.type == 'success'){
                showAlert(response.message, 'success');
            } else {
                showAlert(response.message, 'danger');
            }
        },
        error: function(error) {
            console.error('Error:', error);
            showAlert('Sikertelen', 'danger');
        }
    });
    $('#ujVaros').val('');
    megyeValasztas($('#megyeValaszto').val());
}