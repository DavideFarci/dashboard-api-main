<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Conferma Email</title>
    <style>
        *{
            margin: 0;
            padding: 5px;
            box-sizing: border-box;
        }
        .mes{
            font-style: italic;
            padding: 15px 0;
        }


    </style>
</head>
<body>

    <img src="" alt="">
    <h1>Il sign/gr {{ $data['name'] }}, ha prenotato un tavolo!</h1>
    <p>Data prenotata: {{ $data['date_slot'] }}</p>
    <h3>Numero ospiti: <span style="font-size: 35px; font-weight:bolder">{{$data['n_person']}}</span></h3> 
    @if ($data['message'])
        
    <h4>Il suo messaggio:</h4>
    <hr>
    <p class="mes"> {{$data['message']}}</p>
    @endif    
    <hr>
    <p>Se desidera disdire la prenotazione la preghiamo di contattarci il prima possibile per avvisarci</p>
    <a href="tel:3271622244" class="btn btn-danger">Annulla prenotazione</a>
</body>
</html>