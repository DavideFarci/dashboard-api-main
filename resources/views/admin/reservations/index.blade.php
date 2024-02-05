@extends('layouts.base')

@section('contents')
    {{-- <img src="{{ Vite::asset('resources/img/picsum30.jpg') }}" alt=""> --}}
    <h1 class=" m-auto my-5">PRENOTAZIONI TAVOLI</h1>
    <a  href="{{ route('admin.months.index') }}" class="btn btn-warning w-25 m-auto my-3  d-block">Gestione date</a>
    <a  href="{{ route('admin.reservations.create') }}" class="btn btn-success w-25 m-auto my-3 d-block">Nuova Prenotazione</a>
    <div class="myres-c">

        @foreach ($reservations as $reservation)
        <?php

        $data_ora = DateTime::createFromFormat('d/m/Y H:i', $reservation->date_slot);

        $ora_formatata = $data_ora->format('H:i');
        $data_formatata = $data_ora->format('d/m/Y');
        $giorno_settimana = $data_ora->format('l');
        ?>



        @if ($reservation->status == 0)
                            
        <div class="myres el">
        @elseif ($reservation->status == 1)
        <div class="myres co">

        @elseif ($reservation->status == 2)

        <div class="myres an">
        @endif

            <div class="mail-tel">
                <div class="mail">{{$reservation->email}}</div>
                <div class="tel">{{$reservation->phone}}</div>
            </div>
            <div class="body">
                <section class="myres-left">
                    <div class="name">{{$reservation->name}}</div>
                    <div class="time">{{$ora_formatata}}</div>
                    <div class="day_w">{{$giorno_settimana}}</div>
                    <div class="date">
                        {{$data_formatata}}
                    </div>
                    <div class="c_a">inviato alle: {{$reservation->created_at}}</div>
                </section>
                <section class="myres-center-res">
                   <h5>Numero di Ospiti</h5> 
                    <h4>{{$reservation->n_person}}</h4>
                </section>
                <section class="myres-right">

                    <form class="d-inline w-100 " action="{{ route('admin.reservations.confirmReservation', $reservation->id) }}" method="post">
                        @csrf
                        <button value="1" class="w-100 btn btn-warning">
                            Conferma
                        </button>
                    </form>
                    <form class="d-inline w-100" action="{{ route('admin.reservations.rejectReservation', $reservation->id) }}" method="post">
                        @csrf
                        <button value="2" class="w-100 btn btn-danger">
                            Annulla
                        </button>
                    </form>
                </section>
            </div>
            <div class="visible">
                @if ($reservation->status == 0)
                    
                <span>in elaborazione</span>
                @elseif ($reservation->status == 1)
                <span>confermato</span>
                
                @elseif ($reservation->status == 2)
                
                <span>annullato</span>
                @endif

            </div>
        </div>

        
        @endforeach
    </div>
  

    {{-- <div class="row">
        <h1 >PRENOTAZIONI TAVOLI</h1>
        
    </div>
        <table class="table table-striped">
            <thead>
                <tr>

                    <th style="max-width:60px">NOME</th>
                    <th class="expire-mobile-s">TELEFONO</th>
                    <th class="expire-mobile">MESSAGGIO</th>
                    <th class="expire-mobile-s">N OSPITI</th>
                    <th class="expire-mobile-s">DATA</th>
                    <th class="expire-mobile-s">ORARIO</th>
                    <th>STATUS</th>
                    <th>conferma</th>
                    <th>annulla</th>


                    <th class="expire-mobile-s"></th>

                </tr>
            </thead>
            <tbody class="body-cat">
                @foreach ($reservations->reverse() as $reservation)
                    <tr>

                        <td class="name-mobile">
                            <a style="color:white; white-space:wrap" class="ts bs a-notlink badge bg-success rounded-pill " href="{{ route('admin.reservations.show', ['reservation' =>$reservation]) }}" > {{$reservation->name}}</a>
                           
                        </td>
                        <td class="expire-mobile-s">{{$reservation->phone}}</td>
                        <td class="expire-mobile-s">{{$reservation->message}}</td>
                        <td class="expire-mobile">{{$reservation->n_person}}</td>
                        <td class="expire-mobile-s">{{substr($reservation->date_slot, 0, -6)}}</td>
                        <td class="expire-mobile-s">{{substr($reservation->date_slot, 11)}}</td>
                        <td>
                            @if($reservation->status == 1)

                                <span class="badge bg-success">Completato</span> 
                                
                            @elseif($reservation->status == 2)    

                                <span class="badge bg-danger">Annullato</span> 

                            @else

                                <span class="badge bg-warning">In Elaborazione</span> 
                                
                            @endif
                            
                        
                        </td>
                        <td>
                            <form class="d-inline" action="{{ route('admin.reservations.confirmReservation', $reservation->id) }}" method="post">
                                @csrf
                                <button value="1" class="expire-mobile-s btn btn-warning">
                                    Conferma
                                </button>
                            </form>
                            <form class="d-inline" action="{{ route('admin.reservations.rejectReservation', $reservation->id) }}" method="post">
                                @csrf
                                <button value="2" class="expire-mobile-s btn btn-danger">
                                    Annulla
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div> --}}
    {{ $reservations->links() }}
@endsection