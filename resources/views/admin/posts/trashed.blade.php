@extends('layouts.base')

@section('contents')
<h3 style="white-space: nowrap; display:inline-block; margin:2rem auto" class=" ts bs text-light p-3  bg-danger rounded-pill ">CESTINO</h3>

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
                    <div class="trashed-item">
                        @if ($project->image)
                                <img class="my-image" src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}">
                        @endif
                        <h2> {{ $project->name }}</h2>

                        <div class="card-body">
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