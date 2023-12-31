let editCounter = 0;
// Városok szerkesztéséhez használt menüpontok kezelése
function varosEdit(varosId){
    if(editCounter > 0){
        return;
    }
    editCounter++;
    let eredetiNev = $('#varos'+varosId).text();
    let eredetiLi = $('#varos'+varosId);
    let actionController = $('#varos'+varosId).siblings('div');
    let szovegDob = actionController.find('.szovegDoboz');
    let modosit = actionController.find('.modosit');
    let torol = actionController.find('.torol');
    let megse = actionController.find('.megse');

    // Szöveg eltüntetése és módosító panel megjelenítése
    eredetiLi.hide();
    actionController.show();
    szovegDob.val(eredetiNev);

    // Enter kezelése város módosító szövegdobozban
    szovegDob.on("keypress", function(event){
        if(event.key == "Enter"){
            modosit.click();
        }
    });

    // Mégse gomb müködése
    megse.click(function(){
        actionController.hide();
        eredetiLi.show();
        editCounter--;
    });
    
    // Módosítás gomb működése
    modosit.click(function(){
        let varosUjNeve = $('#ujVarosNev'+varosId).val();
        // Megnézni változott e a név
        if(eredetiNev == varosUjNeve){
            actionController.hide();
            eredetiLi.show();
            editCounter--;
            return;
        }
        $.ajaxSetup({
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
         });
        $.ajax({
            type: 'POST',
            url: 'api/varosModosit/',
            data: {
                id: varosId,
                name: varosUjNeve,
                county_id: $('#megyeValaszto').val(),
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
        actionController.hide();
        eredetiLi.show();
        editCounter--;
        megyeValasztas($('#megyeValaszto').val());
    });

    // Töröl gomb működése
    torol.click(function(){
        $.ajaxSetup({
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
         });
        $.ajax({
            type: 'POST',
            url: 'api/varosTorol/',
            data: {
                id: varosId,
            },
            success: function(response) {
                showAlert(response.message);
            },
            error: function(error) {
                console.error('Error:', error);
                showAlert('Sikertelen', 'danger');
            }
        });
        editCounter--;
        megyeValasztas($('#megyeValaszto').val());
    });
}