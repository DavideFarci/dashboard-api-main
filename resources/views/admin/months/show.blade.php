@extends('layouts.base')

@section('contents')
    {{-- <img src="{{ Vite::asset('resources/img/picsum30.jpg') }}" alt=""> --}}



    <h1>GESTISCI IL MESE</h1>    
    <div class="container">


        @foreach ($selectedDate as $date)
        <div class="day">
           
            {{$date->day}} / {{$date->month}} / {{$date->year}}
        </div>
        @endforeach


    </div>    

    
@endsection

