@extends('layouts.base')

@section('contents')
<a href="{{ route('admin.projects.index') }}" class="btn btn-dark my-3">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-90deg-left" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.146 4.854a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H12.5A2.5 2.5 0 0 1 15 6.5v8a.5.5 0 0 1-1 0v-8A1.5 1.5 0 0 0 12.5 5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4z"/></svg>
</a>
<div>

    <h3 style="white-space: nowrap; display:inline-block; margin:2rem auto" class=" ts bs text-light p-3  bg-danger rounded-pill ">CESTINO</h3>
</div>

    @if (session('delete_success'))
        @php
            $project = session('delete_success')
        @endphp
        <div class="alert alert-danger">
            "{{ $project->title }}" has been deleted!!
        </div>
    @endif

    @if (session('restore_success'))
    @php
        $project = session('restore_success')
    @endphp
    <div class="alert alert-success">
        "{{ $project->name }}" è stato correttamente ripristinato!!
        
    </div>
@endif

    <div class="container">
        <div class="row ">
            @foreach ($trashedProjects as $project)
                <div class="mb-3">
                    <div class="card p-2">
                        <div class="card-top">

                            @if ($project->image)
                                    <img class="my-image" src="{{ asset('public/storage/' . $project->image) }}" alt="{{ $project->title }}">
                            @endif
                            <h2> {{ $project->name }}</h2>
                        </div>

                        <div class="card-body">
                            <div class="tag">
                                @foreach($project->tags as $tag)
                                <span>{{$tag->name}}</span> <span>{{ !$loop->last ? ',' : '' }}</span>
                                @endforeach.
                            </div>
                            <form action="{{ route('admin.projects.restore', ['project' => $project->id]) }}" method="POST" class="d-inline-block">
                                @csrf
                                <button class="btn btn-warning" href="">Ripristina</button>
                            </form>
    
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    {{ $trashedProjects->links() }}

@endsection