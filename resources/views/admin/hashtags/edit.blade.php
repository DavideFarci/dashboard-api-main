@extends('layouts.base')

@section('contents')


<form class="cont_a" method="POST" action="{{ route('admin.hashtags.update', ['hashtag' => $hashtag]) }}" enctype="multipart/form-data" >
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="tag" class="form-label">Titolo</label>
        <input
            type="text"
            class="form-control @error('tag') is-invalid @enderror"
            id="tag"
            name="tag"
            value="{{ old('tag',$hashtag->tag) }}"
        >
        <div class="invalid-feedback">
            @error('tag') {{ $message }} @enderror
        </div>
    </div>


   


    <button class="btn btn-primary">Salva</button>
</form>

@endsection