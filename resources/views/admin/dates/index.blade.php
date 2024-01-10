@extends('layouts.base')

@section('contents')
    {{-- <img src="{{ Vite::asset('resources/img/picsum30.jpg') }}" alt=""> --}}
    <?php $times = ['10:30', '11:00', '11:30', '12:00', '12:30', '13:00', '13:30', '16:30', '17:00', '17:30', '18:00', '18:30']; ?>

  
    <div class="row">
        <h1 >GESTIONE DATE</h1>
        <a  href="{{ route('admin.reservations.index') }}" class="btn btn-dark">INDIETRO</a>
    </div>

        {{-- Form per runnare il seeder --}}
        <form class="d-flex flex-column py-5" style="width: 45% !important; " action="{{ route('admin.dates.runSeeder') }}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="max_reservations">N° di posti a sedere</label>
            <input type="number" name="max_reservations">
            
            <label for="days_off">Giorno/i di chiusura</label>
            <input type="number" max="7" min="1" name="days_off[]">

            <div>
                <div>Seleziona le fasce orarie disponibili</div>
                @foreach ($times as $time)
                    <label for="times_slot_{{ $time }}">{{ $time }}
                        <input type="checkbox" name="times_slot[]" id="times_slot_{{ $time }}" value="{{ $time }}">
                    </label>
                @endforeach
            </div>
            <button>Modifica</button>
        </form>



        <table class="table table-striped">
            <thead>
                <tr>

                    <th class="expire-mobile-s">ID</th>
                    <th style="max-width:60px">DATA</th>
                    <th class="expire-mobile-s">ORARIO</th>
                    <th class="expire-mobile">MAX RES</th>
                    <th class="expire-mobile">PRENOTATI</th>
                    <th class="expire-mobile-s">VISIBILE</th>

 

                    <th class="expire-mobile-s"></th>

                </tr>
            </thead>
            <tbody class="body-cat">
                @foreach ($dates as $date)
                    <tr>

                        
                        <td class="expire-mobile-s">{{$date->id}}</td>
                        <td class="expire-mobile-s">{{$date->day}}/{{$date->month}}/{{$date->year}}</td>
                        <td class="expire-mobile-s">{{$date->time}}</td>
                        <td class="expire-mobile ">
                            <div class="btnform" style="display: flex; align-items: center; text-align: center">

                                <form style="width: 45% !important; " action="{{ route('admin.dates.upmaxres', $date->id) }}" method="post">
                                    @csrf
                                    <button  class="btn btn-dark">+</button>
                                </form>
                                <strong>{{$date->max_res}}</strong>

                                <form style="width: 45% !important; " action="{{ route('admin.dates.downmaxres', $date->id) }}" method="post">
                                    @csrf
                                    <button  class="btn btn-dark">-</button>
                                </form>
                            </div>
                      
                        </td>
        
                        <td class="expire-mobile-s">{{$date->reserved}}</td>

                        <td>
                            @if($date->visible == 1)

                                <span class="badge bg-success">visibile</span> 
                                
                                @else
                                
                                <span class="badge bg-danger">non visibile</span> 
                                
                            @endif
                            
                        
                        </td>
                        <td class="expire-mobile-s">
                            <form action="{{ route('admin.dates.updatestatus', $date->id) }}" method="post">
                                @csrf
                                <button class="btn btn-warning">Modifica visibilità</button>
                            </form>
                        </td>

                        

                    </tr>
                @endforeach
            </tbody>
        </table>
    
    {{ $dates->links() }}
@endsection