@extends('layouts.base')

@section('contents')
    {{-- <img src="{{ Vite::asset('resources/img/picsum30.jpg') }}" alt=""> --}}


    <h1>INGREDIENTI</h1>

        <table class="table table-striped">
            <thead>
                <tr>

                    <th>NOME</th>

                    <th>
                        <a class="btn btn-success" href="{{ route('admin.tags.create') }}">nuovo</a>
                    </th>
         
                </tr>
            </thead>
            <tbody>
                @foreach ($tags as $tag)
                    <tr>
              
                        <td>{{$tag->name}}</td>

                        <td>
                            <div class="btn-cont">
                                <form action="{{ route('admin.tags.destroy', ['tag' =>$tag])}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger" >elimina</button>
                                </form>
                                <a class="btn my-btn btn-warning" href="{{ route('admin.tags.edit', ['tag' =>$tag]) }}">Modifica</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
   

@endsection
