@extends('layouts.base')

@section('contents')
    {{-- <img src="{{ Vite::asset('resources/img/picsum30.jpg') }}" alt=""> --}}


  

    <div class="row">
        <h1 >PRENOTAZIONI TAVOLI</h1>
        <a  href="{{ route('admin.months.index') }}" class="btn btn-warning w-25 m-auto">Gestione date</a>
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
    </div>
    {{ $reservations->links() }}
@endsection