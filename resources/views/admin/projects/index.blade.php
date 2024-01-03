@extends('layouts.base')

@section('contents')
    {{-- <img src="{{ Vite::asset('resources/img/picsum30.jpg') }}" alt=""> --}}

    @if (session('delete_success'))
        @php
            $project = session('delete_success')
        @endphp
        <div class="alert alert-danger">
            "{{ $project->name }}" è stato correttamente spostato nel cestino!
    
        </div>
    @endif

    @if (session('restore_success'))
        @php
            $project = session('restore_success')
        @endphp
        <div class="alert alert-success">
            "{{ $project->name }}" è stato correttamente ripristinato!
            
        </div>
    @endif


    
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="expire-mobile">ID</th>
                    <th>PRODOTTO</th>
                    <th class="expire-mobile-s">IMMAGINE</th>
                    <th class="expire-mobile-s">CATEGORIA</th>
                    <th class="expire-mobile-s">PREZZO</th>
                    <th class="expire-mobile">INGREDIENTI</th>
                    <th>
                        <div class="btn-cont">
                            <a class="btn btn-success" href="{{ route('admin.projects.create') }}">nuovo</a>
                            <a class="btn btn-danger" href="{{ route('admin.projects.trashed') }}">cestino</a>

                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <th class="expire-mobile">{{$project->id}}</th>
                        <td>
                            <a style="color:white" class="ts bs a-notlink badge bg-success rounded-pill" href="{{ route('admin.projects.show', ['project' =>$project]) }}" > {{$project->name}}</a>
                           
                        </td>
                        <td class="expire-mobile-s"> 
                            @if ($project->image)
                                <img class="my-image" src="{{ asset('public/storage/' . $project->image) }}" alt="{{ $project->title }}">
                            @endif

                        </td>
                        <td class="expire-mobile-s">{{$project->category->name}}</td>
                        <td class="expire-mobile-s">€{{$project->price / 100}}</td>
                        <td class="expire-mobile">
                            @foreach ($project->tags as $tag)
                                <span>{{ $tag->name }}</span>{{ !$loop->last ? ',' : '' }}
                            @endforeach
                        </td>
                        <td >
                            <div class="btn-cont">
                                <a class="btn my-btn btn-warning" href="{{ route('admin.projects.edit', ['project' =>$project]) }}">Modifica</a>
                                <form action="{{ route('admin.projects.destroy', ['project' =>$project])}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger" >Elimina</button>
                                </form>

                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    {{ $projects->links() }}
@endsection

