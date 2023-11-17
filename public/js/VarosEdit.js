function varosEdit(varosId){ //Városok szerkesztéséhez használt menüpontok kezelése
    let eredetiText = $('#varos'+varosId).text();
    let eredetiLi = $('#varos'+varosId);
    let actionController = $('#varos'+varosId).siblings('div');
    let szovegDob = actionController.find('.szovegDoboz');
    let modosit = actionController.find('.modosit');
    let torol = actionController.find('.torol');
    let megse = actionController.find('.megse');

    eredetiLi.hide();
    actionController.show();
    szovegDob.val(eredetiText);

    megse.click(function(){ //Mégse gomb müködése
        actionController.hide();
        eredetiLi.show();
    });

    modosit.click(function(){ //Módosítás gomb működése
        let varosUjNeve = $('#ujVarosNev'+varosId).val();
        $.ajax({
            type: 'POST',
            url: '/varosModosit/',
            data: {
                _token: $("#csrf").val(),
                id: varosId,
                name: varosUjNeve,
            },
            success: function(response) {
                showAlert(response.message, 'success');
            },
            error: function(error) {
                console.error('Error:', error);
                showAlert(response.message);
            }
        });
        actionController.hide();
        eredetiLi.show();
        megyeValasztas($('#megyeValaszto').val());
    });

    torol.click(function(){ //Töröl gomb működése
        $.ajax({
            type: 'POST',
            url: '/varosTorol/',
            data: {
                _token: $("#csrf").val(),
                id: varosId,
            },
            success: function(response) {
                showAlert(response.message, 'success');
            },
            error: function(error) {
                console.error('Error:', error);
                showAlert(response.message);
            }
        });
        megyeValasztas($('#megyeValaszto').val());
    });
}