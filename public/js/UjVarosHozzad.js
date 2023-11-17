// Figyeli hogy entert lenyomodik e a textboxban ha igen meghivja a varosHozzaAd();
let input = $('#ujVaros').on("keypress", function(event){
    if(event.key == "Enter"){
        varosHozzaAd();
    }
});
function varosHozzaAd(){ // Új város felvételének működése
    let varosNeve = $('#ujVaros').val();
    if(varosNeve == ""){ // Ha üres nevet addnak meg egyböl leáll
        return;
    }
    let megyeId = $('#megyeValaszto').val();
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '/varosHozzaAd/',
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