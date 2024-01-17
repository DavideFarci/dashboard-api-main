@extends('layouts.base')

@section('contents')
    {{-- <img src="{{ Vite::asset('resources/img/picsum30.jpg') }}" alt=""> --}}
    <?php 
    // '10:30', '11:00', '11:30', '12:00', '12:30', '13:00', '13:30', '16:30', '17:00', '17:30', '18:00', '18:30',
    $times = ['19:00','19:30','20:00','20:30','21:00','21:30','22:00']; 
    $days = [1, 2, 3, 4, 5, 6, 7];
    $days_name = [' ','lunedì', 'martedi', 'mercoledì', 'giovedì', 'venerd', 'sabato', 'domenica'];
?>

<div class="row">
    <h1 >GESTIONE DATE</h1>
    <a  href="{{ route('admin.reservations.index') }}" class="btn btn-dark">INDIETRO</a>
</div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    {{-- Form per runnare il seeder --}}
    <form class="d-flex flex-column py-5" style="width: 45% !important; " action="{{ route('admin.dates.runSeeder') }}" method="post" enctype="multipart/form-data">
        @csrf
        <h3>GENERA NUOVE DATE</h3>
        <h5 class="pt-4">Indica il nuomero di posti a sedere per fascia oraria</h5>
        <div class="input-group flex-nowrap py-2">
            <label for="max_reservations" class="input-group-text" >N° di posti a sedere</label>
            <input name="max_reservations" id="max_reservations" type="text" class="form-control" placeholder="N° di posti a sedere" aria-label="N° di posti a sedere" aria-describedby="addon-wrapping">
          </div>
        <div>
            <h5 class="pt-4">Seleziona i giorni da disabilitare</h5>
            <div class="btn-group py-1" role="group" aria-label="Basic checkbox toggle button group">

                @foreach ($days as $day)
                <input class="btn-check" type="checkbox" name="days_off[]" id="days_off_{{ $day }}" value="{{ $day }}">
                <label class="btn btn-outline-dark" for="days_off_{{ $day }}">{{ $days_name[$day] }}</label>
                @endforeach
            </div>
        </div>
        
        <div>
            <h5 class="pt-4">Seleziona le fasce orarie disponibili</h5>

            <div class="btn-group  py-1" role="group" aria-label="Basic checkbox toggle button group">

                @foreach ($times as $time)
                
                <input type="checkbox" class="btn-check" name="times_slot[]" id="times_slot_{{ $time }}" value="{{ $time }}" autocomplete="off">
                <label class="btn btn-outline-dark" for="times_slot_{{ $time }}">{{ $time }}</label>
              
                @endforeach
            </div>
            
        </div>
        <button class="btn btn-dark mt-4">Modifica</button>
    </form>



    <h1>SCEGLI UN MESE</h1>    
        <table class="table table-striped">
            <thead>
                <tr>
                   
                    <th>MESE</th>

                   
                </tr>
            </thead>
            <tbody>
                @foreach ($months as $month)
                    <tr>
                        <th class="expire-mobile">{{$month->id}}</th>
                        <td>
                            <a href="{{ route('admin.days.index', ['month' =>$month->n, 'year' =>$month->y])  }}" style="color:white" class="ts bs a-notlink badge bg-success rounded-pill"  > {{$month->month}} / {{$month->y}}</a >
                           
                        </td>
                    
                       
                    </tr>
                @endforeach
            </tbody>
        </table>

    {{ $months->links() }}
@endsection

