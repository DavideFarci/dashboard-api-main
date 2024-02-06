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
        main, .products{
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .products{
            gap: 5px !important;
        }
        .product{
            display: flex;
            flex-wrap: wrap;

        }
        .name, .counter{
            width: 40%;
            font-size: 18px;
            font-weight: bold;
        }
        .variation{
            width: 100%;
            display: flex;
            justify-content: space-between;
        }
        .add, .remove{
            width: 40%;
            display: flex;
            flex-direction: column;
            gap: 10px;

        }
    </style>
</head>
<body>

    <img src="" alt="">
    <h1>Il sign/gr {{ $data['name'] }}, ha prenotato un asporto!</h1>
    <p>Data prenotata: {{ $data['date_slot'] }}</p>
    <h3>I prodotti:</h3>
    <div class="products"  style="width: 100%, margin-bottom: 30px;">

        @foreach ($arrvar2 as $p)
            <div class="product" style="width: 100%; margin-top: 20px; margin-bottom: 5px">
                <div>

                    <span style="padding:10px" class="counter">* {{$p['counter']}}</span>
                    <span style="padding:10px" class="name">{{$p['name']}}</span>
                </div>
                <br>
                <div class="variation">
                    @if (count($p['deselected']) !==0)
                        <div class="remove">
                            <h5>Ingredienti tolti:</h5>      
                            @foreach ($p['deselected'] as $var)
                                    - {{$var}}
                            @endforeach
                        </div>
                    @endif
                    @if (count($p['addicted']) !==0)
                        <div class="add">
                            <h5>Ingredienti aggiunti:</h5>
                            @foreach ($p['addicted'] as $var)
                                + {{$var}}
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
            <hr>
        @endforeach
    </div>
    <h4>Totale carrello: €{{intval($data['totPrice']) / 100}}</h4>
    <h4>Messaggio:</h4>
    <p>{{$data['message']}}</p>
    <p>Contatta {{$data['name']}}</p>
    <a href="tel:{{$data['phone']}}" class="btn btn-danger">Chiama {{$data['name']}}</a>
</body>
</html>