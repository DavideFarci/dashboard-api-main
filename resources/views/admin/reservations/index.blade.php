@extends('layouts.base')

@section('contents')
    {{-- <img src="{{ Vite::asset('resources/img/picsum30.jpg') }}" alt=""> --}}


  

    <div class="row">
        <h1 >PRENOTAZIONI TAVOLI</h1>
        <a  href="{{ route('admin.dates.index') }}" class="btn btn-warning">Gestione date</a>
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
                    <th>conferma</th>
                    <th>annulla</th>

                    <th>STATUS</th>

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
                            @if($reservation->status)

                                <span class="badge bg-success">Confermato</span> 
                                
                                @else
                                
                                <span class="badge bg-danger">Da confermare</span> 
                                
                            @endif
                            
                        
                        </td>
                        <td class="expire-mobile-s">
                            <form action="{{ route('admin.reservations.updatestatus', $reservation->id) }}" method="post">
                                @csrf
                                <button class="btn btn-warning">Modifica Stuatus</button>
                            </form>
                        </td>
                        <td>
                            <a href="https://wa.me/{{$reservation->phone}}?text=Le confermiamo che abbiamo accettato la sua prenotazione. Buona serata!">Conferma</a>
                        </td>
                        <td>
                            <a href="https://wa.me/{{$reservation->phone}}?text=E' con profondo rammarico che siamo obbligati ad disdire la vostra prenotazione">Disdici</a>
                        </td>
                        

                        

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $reservations->links() }}
@endsection