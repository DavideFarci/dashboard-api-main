@extends('layouts.base')

@section('contents')
    @php
    $days_name = [' ','lunedì', 'martedi', 'mercoledì', 'giovedì', 'venerd', 'sabato', 'domenica'];
    @endphp

    @if (session('reserv_success'))
    <div class="alert alert-success">
        Ordine avvenuto correttamente!
    </div>
    @endif

    {{-- @dd($dates); --}}

    <form action="{{ route('admin.orders.store') }}" enctype="multipart/form-data" method="POST" class="p-5">
        @csrf
        @if (session('max_res_check'))
            <div class="alert alert-danger">
               <h3 for="max_check">Stai superando il limite di pezzi disponibili per questa data!</h3>
               <h4 for="max_check">Vuoi continuare comunque?</h4>
               
               <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                <input type="checkbox" class="btn-check" id="btncheck1" name="max_check" autocomplete="off">
                <label class="btn btn-outline-danger" for="btncheck1">Continua</label>
              
               
              </div>
             
              <button class="btn  w-75 m-auto btn-primary d-block">Salva</button>
            </div>
        @endif

        <div class="mb-5">
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

        <div class="mb-5">
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

        <div class="mb-5">
            <label for="email" class="form-label">Email * opzionale</label>
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

        <div class="mb-5">
            <label for="total_pz" class="form-label">N° di pezzi</label>
            <input
                type="number"
                class="form-control @error('total_pz') is-invalid @enderror"
                id="total_pz"
                name="total_pz"
            >
            {{-- <div class="invalid-feedback">
                @error('name') {{ $message }} @enderror
            </div> --}}
        </div>

        <div class="mb-5">
            <label for="total_price" class="form-label">Prezzo totale - in centesimi * opzionale</label>
            <input
                type="number"
                class="form-control @error('total_price') is-invalid @enderror"
                id="total_price"
                name="total_price"
            >
            {{-- <div class="invalid-feedback">
                @error('name') {{ $message }} @enderror
            </div> --}}
        </div>

        <div class="mb-5">
            <label for="message" class="form-label">Messaggio</label>
            <textarea class="form-control" name="message" id="message" cols="30" rows="10"></textarea>
            {{-- <div class="invalid-feedback">
                @error('name') {{ $message }} @enderror
            </div> --}}
        </div>

        <button class="btn mb-5 w-75 m-auto btn-primary d-block">Salva</button>
        <div class="mb-5 m-auto w-50 btn-group specialradio" role="group" aria-label="Basic radio toggle button group"> 

            @foreach ($dates as $date)
            

            <input type="radio" class="btn-check" name="date_id[]" value="{{$date->id}}" id="btnradio{{$date->id}}" >
            <label class="btn btn-outline-dark" for="btnradio{{$date->id}}">
                {{$date->time}} | {{$date->day}}/{{$date->month}}/{{$date->year}} | <strong>{{$date->reserved_pz}}</strong> | max: {{$date->max_pz}}
            </label>

            @endforeach
        </div>
     
  
        <button class="btn  w-75 m-auto btn-primary d-block">Salva</button>

    </form>
    
@endsection