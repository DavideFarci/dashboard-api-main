@extends('layouts.base')

@section('contents')
@php
        $days_name = [' ','lunedì', 'martedi', 'mercoledì', 'giovedì', 'venerd', 'sabato', 'domenica'];
        @endphp


    
<h1 class="m-5">GESTISCI IL IL GIORNO</h1>    



        <div class="mydata">
          
            
            @foreach ($dates as $date)
            
            @if($date->visible == 1)
                
                <div class="mycard">
            @else
                    
                <div class="mycard myc-off">
            @endif
                    <div class="left-c">
                        <div class="data">

                            <h2>{{$date->time}}</h2>
                            <span class="day_w">{{$days_name[$date->day_w]}}</span>
                            <span>{{$date->day}}/{{$date->month}}/{{$date->year}}</span>
                        </div>
                        <div class="res">
                            <h3>Pezzi DisponibiliI</h3>
                            <div class="n_res">{{$date->reserved}}</div>    
                        </div>
                        <div class="res">
                            <h3>Posti DisponibiliI</h3>
                            <div class="n_res">{{$date->reserved_pz}}</div>
                        </div>
                    </div>
                    <div class="right-c">
                        <div class="max">
                            <h3>Modifica Max Posti</h3>
                            <form action="{{ route('admin.dates.upmaxres', $date->id) }}" method="post">
                                @csrf
                                <button  class="btn btn-dark">+</button>
                            </form>
                            <span>{{$date->max_res}}</span>

                            <form action="{{ route('admin.dates.downmaxres', $date->id) }}" method="post">
                                @csrf
                                <button  class="btn btn-dark">-</button>
                            </form>
                        </div>
                        <div class="max">
                            <h3>Modifica Max Pezzi</h3>
                            <form action="{{ route('admin.dates.upmaxpz', $date->id) }}" method="post">
                                @csrf
                                <button  class="btn btn-dark">+</button>
                            </form>
                            <span>{{$date->max_pz}}</span>

                            <form action="{{ route('admin.dates.downmaxpz', $date->id) }}" method="post">
                                @csrf
                                <button  class="btn btn-dark">-</button>
                            </form>

                        </div>
                        
                    </div>
                    
                    @if($date->visible == 1)
                        
                    <div class="visible-on">
                        <span class="">visibile</span> 
                        
                        <form action="{{ route('admin.dates.updatestatus', $date->id) }}" method="post">
                            @csrf
                            <button class="btn btn-danger">Modifica visibilità</button>
                        </form>
                    </div>
                    @else
                        
                    <div class="visible">
                        <span class="">non visibile</span> 
                        
                        <form action="{{ route('admin.dates.updatestatus', $date->id) }}" method="post">
                            @csrf
                            <button class="btn btn-success">Modifica visibilità</button>
                        </form>
                        
                    </div>
                    @endif
                </div>
                        
                    
                    
                    
             
            @endforeach
     
        </div>

 

    
@endsection

