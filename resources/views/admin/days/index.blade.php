@extends('layouts.base')

@section('contents')

{{-- <img src="{{ Vite::asset('resources/img/picsum30.jpg') }}" alt=""> --}}
<?php 
$month_name=['gennaio','febbraio','marzo','aprile', 'maggio','giugno','luglio','agosto','settembre','ottobre','novrembre','dicembre']
 ?>

    <h1 class="m-3">SCEGLI UN GIORNO</h1>    

    <h3 class="m-2 upper">{{$month_name[$days[1]->m -1]}}</h3>
    <a href="{{ route('admin.months.index') }}" class="btn btn-dark my-3">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-90deg-left" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.146 4.854a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H12.5A2.5 2.5 0 0 1 15 6.5v8a.5.5 0 0 1-1 0v-8A1.5 1.5 0 0 0 12.5 5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4z"/></svg>
    </a>
    <div class="flex d-5 ">
        <a href="{{ route('admin.days.index', ['month' =>$days[1]->m - 1, 'year' =>$days[1]->y]) }}" class="btn btn-dark w-25">
            PRECEDENTE
        </a>
        <a href="{{ route('admin.days.index', ['month' =>$days[1]->m + 1, 'year' =>$days[1]->y]) }}" class="btn btn-dark w-25">
            PROSSIMO
        </a>

    </div>
    
        <table class="table table-striped">

            <tbody>
                @foreach ($days as $day)
                    <tr>
                        <th class="expire-mobile">{{$day->id}}</th>
                        <td>
                            <a href="{{ route('admin.days.show', ['day' => $day->id])  }}" style="color:white" class="ts bs a-notlink badge bg-success rounded-pill"  > {{$day->day}} / {{$day->m}} / {{$day->y}}</a >
                           
                        </td>
                    
                       
                    </tr>
                @endforeach
            </tbody>
        </table>


@endsection

