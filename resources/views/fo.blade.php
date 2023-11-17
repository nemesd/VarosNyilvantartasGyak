<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <script src="{{ asset('js/VarosEdit.js') }}" defer></script>
        <script src="{{ asset('js/MegyeValasztas.js') }}" defer></script>
        <script src="{{ asset('js/UjVarosHozzad.js') }}" defer></script>
        <script src="{{ asset('js/AlertMessage.js') }}" defer></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
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

    <div class="container hidden" id="ujVarosBlock"> 
        <h3>Város hozzáadása:</h3> {{-- Itt adható meg az új város az kiválasztott megyéhez --}}
        <input type="text" class="form-control mb-3" name="ujVaros" id="ujVaros">
        <button class="btn btn-primary" id="ujVarosKuldes" onclick="varosHozzaAd()">Küldés</button>
    </div>

    <div id="alertContainer" class="position-fixed top-0 end-0 p-3">
        <!-- Értesítések helye -->
    </div>
</body>
</html>