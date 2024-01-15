@extends('layouts.base')

@section('contents')
    {{-- <img src="{{ Vite::asset('resources/img/picsum30.jpg') }}" alt=""> --}}
    <?php 
        @dump($months);
    ?>


    <h1>SCEGLI UN MESE</h1>    
        <table class="table table-striped">
            <thead>
                <tr>
                   
                    <th>MESE</th>

                    <th>
                        <div class="btn-cont">
                            <a class="btn btn-success" href="{{ route('admin.months.create') }}">nuovo</a>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($months as $month)
                    <tr>
                        <th class="expire-mobile">{{$month->id}}</th>
                        <td>
                            <a href="{{ route('admin.months.show', ['month' =>$month])  }}" style="color:white" class="ts bs a-notlink badge bg-success rounded-pill"  > {{$month->month}} / {{$month->y}}</a >
                           
                        </td>
                    
                       
                    </tr>
                @endforeach
            </tbody>
        </table>

    {{ $months->links() }}
@endsection

