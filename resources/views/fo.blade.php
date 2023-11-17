<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
                <option value="{{$megye['id']}}">{{$megye['name']}}</option>
            @endforeach
        </select>
    </div>

    <div class="container" id="varosLista">
        {{-- Városok helye --}}
    </div>

    <div class="container" id="ujVarosBlock" style="display: none"> 
        <h3>Város hozzáadása:</h3> {{-- Itt adható meg az új város az kiválasztott megyéhez --}}
        <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
        <input type="text" class="form-control mb-3" name="ujVaros" id="ujVaros">
        <button class="btn btn-primary" id="ujVarosKuldes" onclick="varosHozzaad()">Küldés</button>
    </div>




<script>
    megyeValasztas($('#megyeValaszto').val()); // Mikor betölt az oldal ne legyen üres a városok listája
    function megyeValasztas(megyeId) { // Kilistázza a városokat amikor a select értéke változik
        if (megyeId) {
            // Ajax kérés a városok lekéréséhez a kiválasztott megye alapján
            $('#ujVarosBlock').show();
            $.ajax({
                type: 'GET',
                url: '/varosLekerese/' + megyeId,
                success: function (data) {
                    let varosLista = $('#varosLista');
                    varosLista.empty();

                    $.each(data.varosok, function (index, city) {
                          varosLista.append(
                              '<div class="mb-3 mt-3">\n'+
                                  '<span class="city-name" id="'+city.id+'" data-cityid="'+city.id+'">'+
                                    city.name+
                                  '</span>\n'+
                                  '<div class="city-action" style="display:none">\n'+
                                      '<input type="text" class="szovegDoboz form-control mb-3" id="ujVarosNev'+city.id+'">\n'+
                                      '<button class="modosit btn btn-primary">Módosítás</button>\n'+
                                      '<button class="torol btn btn-danger">Törlés</button>\n'+
                                      '<button class="megse btn btn-secondary">Mégsem</button>\n'+
                                  '</div>\n'+
                              '</div>\n'
                         );
                        document.getElementById(city.id).addEventListener("click", varosEdit);
                    });
                }
            });
        }
    };
    function varosEdit(){ //Városok szerkesztéséhez használt menüpontok kezelése
        let varosId = $(this).data('cityid');
        let eredetiText = $(this).text();
        let eredetiLi = $(this);
        let actionController = $(this).siblings('div');
        let szovegDob = actionController.find('.szovegDoboz');
        let modosit = actionController.find('.modosit');
        let torol = actionController.find('.torol');
        let megse = actionController.find('.megse');
        let alert = document.getElementById('alert');

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
                url: '{{ route('varosModosit') }}',
                data: {
                    _token: $("#csrf").val(),
                    id: varosId,
                    name: varosUjNeve,
                },
                success: function(response) {
                    //alert(response.message);
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
                    //alert(response.message);
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
            megyeValasztas($('#megyeValaszto').val());
        });
    }
    function varosHozzaad(){ //Új város felvételének működése
        let varosNeve = $('#ujVaros').val();
        let megyeId = $('#megyeValaszto').val();
        $.ajax({
            type: 'POST',
            url: '{{ route('varosHozzaad') }}',
            data: {
                _token: $("#csrf").val(),
                name: varosNeve,
                county_id: megyeId,
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