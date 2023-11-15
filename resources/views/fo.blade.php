<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Város Nyilvántartás</title>
</head>
<body>
    <div class="container">
        <h1>Város Nyilvántartás</h1>
    </div>

    <div class="container">
        <select name="megyeValaszto" id="megyeValaszto" onchange="megyeValasztas(this.value)">
            <option value="" selected="selected" hidden>Válassz megyét</option>
            {{-- Belerakja a megyéket a select-be --}}
            @foreach($megyek as $megye)
                <option value="{{$megye['id']}}">{{$megye['nev']}}</option>
            @endforeach
        </select>
    </div>

    <div class="container" id="varosLista">
        {{-- Városok helye --}}
    </div>

    <div class="container" style="display: none" id="ujVarosBlock"> 
        <h3>Város hozzáadása:</h3> {{-- Itt adható meg az új város az kiválasztott megyéhez --}}
        <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
        <input type="text" class="form-control mb-3" name="ujVaros" id="ujVaros">
        <button class="btn btn-primary" id="ujVarosKuldes" onclick="varosHozzaad()">Küldés</button>
    </div>









<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    megyeValasztas($('#megyeValaszto').val()); //Mikor betölt az oldal ne legyen üres a városok listája
    document.getElementById('ujVarosKuldes').addEventListener("click", ujVaros);
    function megyeValasztas(megyeId) { //Kilistázza a városokat amikor a select értéke változik
        if (megyeId) {
            // Ajax kérés a városok lekéréséhez a kiválasztott megye alapján
            $('#ujVarosBlock').show();
            $.ajax({
                type: 'GET',
                url: '/varosLekerese/' + megyeId,
                success: function (data) {
                    var varosLista = $('#varosLista');
                    varosLista.empty();

                    $.each(data.varosok, function (index, varos) {
                          varosLista.append(
                              '<div class="mb-3 mt-3">\n'+
                                  '<span class="city-name" id="'+varos.id+'" data-cityid="'+varos.id+'">'+
                                      varos.nev+
                                  '</span>\n'+
                                  '<div class="city-action" style="display:none;">\n'+
                                      '<input type="text" class="szovegDoboz form-control mb-3" id="ujVarosNev'+varos.id+'">\n'+
                                      '<button class="modosit btn btn-primary">Módosítás</button>\n'+
                                      '<button class="torol btn btn-danger">Törlés</button>\n'+
                                      '<button class="megse btn btn-secondary">Mégsem</button>\n'+
                                  '</div>\n'+
                              '</div>\n'
                         );
                        document.getElementById(varos.id).addEventListener("click", varosEdit);
                    });
                }
            });
        }
    };
    function varosEdit(){ //Városok szerkesztéséhez használt menüpontok kezelése
        var varosId = $(this).data('cityid');
        var eredetiText = $(this).text();
        var eredetiLi = $(this);
        var actionController = $(this).siblings('div');
        var szovegDob = actionController.find('.szovegDoboz');
        var modosit = actionController.find('.modosit');
        var torol = actionController.find('.torol');
        var megse = actionController.find('.megse');

        eredetiLi.hide();
        actionController.show();
        szovegDob.val(eredetiText);

        megse.click(function(){ //Mégse gomb müködése
            actionController.hide();
            eredetiLi.show();
        });

        modosit.click(function(){ //Módosítás gomb működése
            var varosUjNeve = $('#ujVarosNev'+varosId).val();
            $.ajax({
                type: 'POST',
                url: '{{ route('varosModosit') }}',
                data: {
                    _token: $("#csrf").val(),
                    id: varosId,
                    nev: varosUjNeve,
                },
                success: function(response) {
                    alert(response.message);
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
            actionController.hide();
            eredetiLi.show();
            megyeValasztas($('#megyeValaszto').val());
        });

        torol.click(function(){ //Töröl gomb működése
            $.ajax({
                type: 'POST',
                url: '{{ route('varosTorol') }}',
                data: {
                    _token: $("#csrf").val(),
                    id: varosId,
                },
                success: function(response) {
                    alert(response.message);
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
            megyeValasztas($('#megyeValaszto').val());
        });
    }
    function varosHozzaad(){ //Új város felvételének működése
        var varosNeve = $('#ujVaros').val();
        var megyeId = $('#megyeValaszto').val();
        $.ajax({
            type: 'POST',
            url: '{{ route('varosHozzaad') }}',
            data: {
                _token: $("#csrf").val(),
                nev: varosNeve,
                megyeId: megyeId,
            },
            success: function(response) {
                alert(response.message);
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
        $('#ujVaros').val('');
        megyeValasztas($('#megyeValaszto').val());
    }
</script>
</body>
</html>