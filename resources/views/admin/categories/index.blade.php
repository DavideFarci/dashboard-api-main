@extends('layouts.base')

@section('contents')
    {{-- <img src="{{ Vite::asset('resources/img/picsum30.jpg') }}" alt=""> --}}


        <h1>CATEGORIE</h1>
        <table class="table table-striped">
            <thead>
                <tr>

                    <th>NOME</th>

                    <th>
                        <a class="btn btn-success" href="{{ route('admin.categories.create') }}">nuovo</a>
                    </th>
                </tr>
            </thead>
            <tbody class="body-cat">
                @foreach ($categories as $category)
                    <tr>
 
                        <td>{{$category->name}}</td>

                        <td >
                            <div class="btn-cont">
                                <form class="delete-cat-un" action="{{ route('admin.categories.destroy', ['category' =>$category])}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger" >elimina</button>
                                </form>
                                <a class="btn my-btn btn-warning" href="{{ route('admin.categories.edit', ['category' =>$category]) }}">Modifica</a>

                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>


@endsection
