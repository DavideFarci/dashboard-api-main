@extends('layouts.base')

@section('contents')
    @php
    $days_name = [' ','lunedì', 'martedi', 'mercoledì', 'giovedì', 'venerd', 'sabato', 'domenica'];
    @endphp

    @if (session('reserv_success'))
    <div class="alert alert-success">
        Prenotazione avvenuta correttamente!
    </div>
    @endif

    {{-- @dd($dates); --}}

    <form action="{{ route('admin.reservations.store') }}" enctype="multipart/form-data" method="POST">
        @csrf
        @if (session('max_res_check'))
            <div class="alert alert-danger">
               <h3 for="max_check">Stai superando il limite di posti disponibili, vuoi continuare?</h3>
                <label for="si">Si
                    <input hidden type="checkbox" name="max_check" id="si" value="0">
                </label>

                <label for="no">No
                    <input hidden type="checkbox" name="max_check" id="no" value="1">
                </label>
        
            </div>
        @endif

        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input
                type="text"
                class="form-control @error('name') is-invalid @enderror"
                id="name"
                name="name"
            >
            {{-- <div class="invalid-feedback">
                @error('name') {{ $message }} @enderror
            </div> --}}
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Telefono</label>
            <input
                type="text"
                class="form-control @error('phone') is-invalid @enderror"
                id="phone"
                name="phone"
            >
            {{-- <div class="invalid-feedback">
                @error('name') {{ $message }} @enderror
            </div> --}}
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email **opzionale</label>
            <input
                type="text"
                class="form-control @error('email') is-invalid @enderror"
                id="email"
                name="email"
            >
            {{-- <div class="invalid-feedback">
                @error('name') {{ $message }} @enderror
            </div> --}}
        </div>

        <div class="mb-3">
            <label for="n_person" class="form-label">N° di persone</label>
            <input
                type="number"
                class="form-control @error('n_person') is-invalid @enderror"
                id="n_person"
                name="n_person"
            >
            {{-- <div class="invalid-feedback">
                @error('name') {{ $message }} @enderror
            </div> --}}
        </div>

        <div class="mb-3">
            <label for="message" class="form-label">Messaggio</label>
            <textarea class="form-control" name="message" id="message" cols="30" rows="10"></textarea>
            {{-- <div class="invalid-feedback">
                @error('name') {{ $message }} @enderror
            </div> --}}
        </div>

        <button class="btn btn-primary">Salva</button>

        <div class="mydata">
            
            @foreach ($dates as $date)
            
                <label for="{{ 'date-' . $date->id}}" class="form-label">
                    <div class="mycard">
                        <div class="left-c">
                            <div class="data">
    
                                <h2>{{$date->time}}</h2>
                                <span class="day_w">{{$days_name[$date->day_w]}}</span>
                                <span>{{$date->day}}/{{$date->month}}/{{$date->year}}</span>
                            </div>
                            <div class="res">
                                <h3>Posti Prenotati</h3>
                                <div class="n_res">{{$date->reserved}}</div>
                            </div>
                        </div>
                        <div class="right-c">
                            <div class="max">
                                <h3>Modifica Max Posti</h3>
                                <span>{{$date->max_res}}</span>
                            </div>
                            
                        </div>
                        <div class="visible-on">
                            <span class="">visibile</span>    
                        </div>
                        <input
                        hidden
                        type="checkbox"
                        value="{{ $date->id }}"
                        class="form-control @error('n_person') is-invalid @enderror"
                        id="{{ 'date-' . $date->id}}"
                        name="date_id"
                        >
                    </div>          
                </label>
    
    
            @endforeach
     
        </div>
    </form>
    
@endsection