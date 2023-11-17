megyeValasztas($('#megyeValaszto').val());

function megyeValasztas(megyeId) { // Kilistázza a városokat amikor a select értéke változik
    if (megyeId) {
        // Ajax kérés a városok lekéréséhez a kiválasztott megye alapján
        $('#ujVarosBlock').show();
        $.ajax({
            type: 'GET',
            url: 'api/varosLekerese/' + megyeId,
            success: function (data) {
                let varosLista = $('#varosLista');
                varosLista.empty();

                $.each(data.varosok, function (index, city) {
                    varosLista.append( // Városok kilistázásához a html kód
                        '<div class="mb-3 mt-3">\n'+
                            '<span class="city-name" id="varos'+city.id+'" data-cityid="'+city.id+'">'+
                                city.name+
                            '</span>\n'+
                            '<div class="city-action hidden">\n'+
                                '<input type="text" class="szovegDoboz form-control mb-3" id="ujVarosNev'+city.id+'">\n'+
                                '<button class="modosit btn btn-primary">Módosítás</button>\n'+
                                '<button class="torol btn btn-danger">Törlés</button>\n'+
                                '<button class="megse btn btn-secondary">Mégsem</button>\n'+
                            '</div>\n'+
                        '</div>\n'
                    );
                    $('#varos'+city.id).on("click", function(){
                        varosEdit(city.id);
                    });
                });
            }
        });
    }
};