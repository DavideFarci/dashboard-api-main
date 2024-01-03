@extends('layouts.base')

@section('contents')


<form class="cont_a" method="POST" action="{{ route('admin.posts.update', ['post' => $post]) }}" enctype="multipart/form-data" >
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="title" class="form-label">Titolo</label>
        <input
            type="text"
            class="form-control @error('title') is-invalid @enderror"
            id="title"
            name="title"
            value="{{ old('title',$post->title) }}"
        >
        <div class="invalid-feedback">
            @error('title') {{ $message }} @enderror
        </div>
    </div>

    <div class="mb-3">
        <label for="link" class="form-label">Instagram LINK</label>
        <input
            type="text"
            class="form-control @error('link') is-invalid @enderror"
            id="link"
            name="link"
            value="{{ old('link',$post->link) }}"
        >
        <div class="invalid-feedback">
            @error('link') {{ $message }} @enderror
        </div>
    </div>


    <div class="input-group mb-3">
        <input type="file" class="form-control" id="image" name="image" accept="image/*">
        <label class="input-group-text  @error('image') is-invalid @enderror" for="image">Immagine</label>
        @error('image')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Descrizione</label>
        <textarea
            type="text"
            class="form-control @error('description') is-invalid @enderror"
            id="description"
            name="description"
            value=""
            cols="30" 
            rows="10">{{ old('description',$post->description) }}</textarea>
        <div class="invalid-feedback">
            @error('description') {{ $message }} @enderror
        </div>
    </div>




    <div class="mb-3">
        <h3>Hashtag</h3>
        @foreach($hashtags as $tag)
            <div class="mb-3 form-check">
                <input
                    type="checkbox"
                    class="form-check-input"
                    id="tag{{ $tag->id }}"
                    name="tags[]"
                    value="{{ $tag->id }}"
                    @if (in_array($tag->id, old('tags', $post->hashtags->pluck('id')->all()))) checked @endif
                >
                <label class="form-check-label" for="tag{{ $tag->id }}">{{ $tag->tag }}</label>
            </div>
        @endforeach

    </div>




    <button class="btn btn-primary">Salva</button>
</form>

@endsection