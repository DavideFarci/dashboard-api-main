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


    
        <div class="myproj-c">
            <h1 class="m-3">Modifica i tuo prodotti</h1>

            <a class="btn my-btn btn-success m-2" href="{{ route('admin.projects.create') }}">Nuovo</a>
            <a class="btn my-btn btn-danger m-2" href="{{ route('admin.projects.trashed') }}">Cestino</a>


            @foreach ($projects as $project)

            @if($project->visible == 1)
            <div class="myproj">
            @else 
           
            <div class="myproj-off">
          
            @endif

                    <section class="s1">
                        <h4>{{$project->name}}</h4>
                        <span class="cat">{{$project->category->name}}</span>
                        <img class="my-image" src="{{ asset('public/storage/' . $project->image) }}" alt="{{ $project->title }}">
                    </section>
                    <section class="expire-mobile s2">
                        <h5>Ingredienti:</h5>
                        <p>
                            @foreach ($project->tags as $tag)
                                <span>{{ $tag->name }}</span>{{ !$loop->last ? ', ' : '.' }}
                            @endforeach
                        </p>
                        <div class="price">€{{$project->price / 100}}</div>
                    </section>
                    <section class="s3">
                        <a class="btn my-btn btn-warning" href="{{ route('admin.projects.edit', ['project' =>$project]) }}">Modifica</a>
                            <form action="{{ route('admin.projects.destroy', ['project' =>$project])}}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger" >Elimina</button>
                            </form>
                            @if($project->visible == 1)
                            <form action="{{ route('admin.projects.updatestatus', $project->slug)}}" method="post">
                                @csrf

                                <button class="btn btn-warning" >Nascondi</button>
                            </form>
                            @else 
                            <form action="{{ route('admin.projects.updatestatus', $project->slug)}}" method="post">
                                @csrf

                                <button class="btn btn-success" >Mostra</button>
                            </form>
                          
                            @endif
                    </section>
                </div>

            
            @endforeach
        </div>
  

    {{ $projects->links() }}
@endsection

