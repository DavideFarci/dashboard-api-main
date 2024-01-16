@extends('layouts.base')

@section('contents')
    {{-- <img src="{{ Vite::asset('resources/img/picsum30.jpg') }}" alt=""> --}}
    
        @dump($days);
    


    <h1>SCEGLI UN MESE</h1>    
        <table class="table table-striped">
            <thead>
                <tr>
                   
                    <th>GIORNI</th>

                    <th>
                        <div class="btn-cont">
                            <a class="btn btn-success" href="{{ route('admin.months.create') }}">nuovo</a>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($days as $day)
                    <tr>
                        <th class="expire-mobile">{{$day->id}}</th>
                        <td>
                            <a href="{{ route('admin.days.show', ['day' => $day])  }}" style="color:white" class="ts bs a-notlink badge bg-success rounded-pill"  > {{$day->day}} / {{$day->m}} / {{$day->y}}</a >
                           
                        </td>
                    
                       
                    </tr>
                @endforeach
            </tbody>
        </table>


@endsection

