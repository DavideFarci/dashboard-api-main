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
        
        .products{
            width: 100%;
            margin-bottom: 30px;
        }
        .product{
            width: 100%;
            margin-top: 20px; 
            margin-bottom: 5px

        }
        .name, .counter{

            font-size: 18px;
            font-weight: bold;
        }
        .variation{
        }
        .add, .remove{

        }
    </style>
</head>
<body>

    <img src="" alt="">
    <h1>Grazie per aver ordinato dal {{env('APP_NAME')}} {{ $data['name'] }}, stiamo elaborando la sua richiesta!</h1>
    <p>Data prenotata: {{ $data['date_slot'] }}</p>
    <h3>I suoi prodotti:</h3>
    <div class="products"  style="">
      
        @foreach ($arrvar2 as $p)
            <div class="product" >
                <div>

                    <span style="padding:10px" class="counter">* {{$p['counter']}}</span>
                    <span style="padding:10px" class="name">{{$p['name']}}</span>
                </div>
                <br>
                <div class="variation">
                    @if (count($p['deselected']) !==0)
                        <h5>Ingredienti tolti:</h5>      
                        @foreach ($p['deselected'] as $var)
                            <div class="remove">
                                - {{$var}}
                            </div>
                        @endforeach
                    @endif
                    @if (count($p['addicted']) !==0)
                        <h5>Ingredienti aggiunti:</h5>
                        @foreach ($p['addicted'] as $var)
                            <div class="add">
                                + {{$var}}
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <hr>
        @endforeach
        </div>
        <h4>Totale carrello: €{{intval($data['totPrice']) / 100}}</h4>
    <p>Se desidera disdire la prenotazione la preghiamo di contaatrci il prima possibile per avvisarci</p>
    <a href="tel:3271622244" class="btn btn-danger">Annulla prenotazione</a>
</body>
</html>