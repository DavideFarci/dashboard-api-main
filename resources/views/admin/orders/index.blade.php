@extends('layouts.base')

@section('contents')
    {{-- <img src="{{ Vite::asset('resources/img/picsum30.jpg') }}" alt=""> --}}
   

    
    <h1>PRENOTAZIONI D'ASPORTO</h1>
    <div class="myres-c">

        @foreach ($orders->reverse() as $order)
        <?php

        $data_ora = DateTime::createFromFormat('d/m/Y H:i', $order->date_slot);

        $ora_formatata = $data_ora->format('H:i');
        $data_formatata = $data_ora->format('d/m/Y');
        $giorno_settimana = $data_ora->format('l');
        ?>
        <div class="myres">
            <div class="mail-tel">
                <div class="mail">{{$order->email}}</div>
                <div class="tel">{{$order->phone}}</div>
            </div>
            <div class="body">
                <section class="myres-left">
                    <div class="name">{{$order->name}}</div>
                    <div class="time">{{$ora_formatata}}</div>
                    <div class="day_w">{{$giorno_settimana}}</div>
                    <div class="date">{{$data_formatata}}</div>
                </section>
                <section class="myres-center">
                    <h5>Prodotti</h5>

                    @foreach ($orderProject as $i)
                    
                    <div class="product">
                        <div class="counter"> {{$i->quantity_item}}</div>
      
                        <?php
             
    
                        ?>
                       
                            
                        <div class="name">{{$prodotto->name}}</div>
  
                        <div class="variations">
                            <div class="add">

                            </div>
                            <div class="removed">

                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="t_price">€{{$order->total_price / 100}}</div>
                    
                </section>
                <section class="myres-right">

                    <form class="d-inline" action="{{ route('admin.orders.confirmOrder', $order->id) }}" method="post">
                        @csrf
                        <button value="1" class="expire-mobile-s btn btn-warning">
                            Conferma
                        </button>
                    </form>
                    <form class="d-inline" action="{{ route('admin.orders.rejectOrder', $order->id) }}" method="post">
                        @csrf
                        <button value="2" class="expire-mobile-s btn btn-danger">
                            Annulla
                        </button>
                    </form>
                </section>
            </div>
            <div class="visible"></div>
        </div>

        
        @endforeach
    </div>
   


    {{ $orders->links() }}
@endsection