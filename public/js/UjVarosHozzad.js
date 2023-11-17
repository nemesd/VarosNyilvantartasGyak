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
        url: 'api/varosHozzaAd/',
        data: {
            name: varosNeve,
            county_id: megyeId,
        },
        success: function(response) {
            if(response.type == 'danger'){
                showAlert(response.message, response.type);
            } else {
                showAlert(response.message);
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