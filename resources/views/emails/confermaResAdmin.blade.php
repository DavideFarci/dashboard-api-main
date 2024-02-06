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

   
    <h1>Grazie {{ $data['name'] }} per aver ordinato dal {{env('APP_NAME')}}, la sua prenotazione è stata accolta!</h1>
    <p>Data prenotata: {{ $data['date_slot'] }}</p>
    <span>Numero ospiti:</span>
    <span style="font-size: 35px; font-weight:bolder">{{$data['n_person']}}</span>
    @if ($data['message'])
        
    <hr>
    <h4>Il suo messaggio:</h4>
    <p class="mes"> {{$data['message']}}</p>
    @endif    
    <hr>
    
    <p>Contatta {{$data['name']}}</p>
    <a href="tel:{{$data['phone']}}" class="btn btn-danger">Chiama {{$data['name']}}</a>
</body>
</html>