@extends('layouts.base')

@section('contents')

<form class="cont_a" method="POST" action="{{ route('admin.projects.store') }} " enctype="multipart/form-data">
    @csrf

    <div class="mb-3 nome_">
        <label for="name" class="form-label">Nome Prodotto</label>
        <input
            type="text"
            class="form-control @error('name') is-invalid @enderror"
            id="name"
            name="name"
            value="{{ old('name') }}"
        >
        <div class="invalid-feedback">
            @error('name') {{ $message }} @enderror
        </div>
    </div>

    <div class="mb-3 prezzo_">
        <label for="price" class="form-label">Prezzo in centesimi</label>
        <input
            type="text"
            class="form-control @error('price') is-invalid @enderror"
            id="price"
            name="price"
            value="{{ old('price') }}"
        >
        <div class="invalid-feedback">
            @error('price') {{ $message }} @enderror
        </div>
    </div>

    <div class="input-group mb-3">
        <input type="file" class="form-control" id="image" name="image" accept="image/*">
        <label class="input-group-text  @error('image') is-invalid @enderror" for="image">Upload</label>
        @error('image')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>


    <div class="mb-3 categoria_">
        <label for="category" class="form-label">Categoria</label>
        <select
            class="form-select @error('category_id') is-invalid @enderror"
            id="category"
            name="category_id"
        >
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        @error('category_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="mb-3 ingredienti_ ">
        <h3>Ingredienti</h3>
        @foreach($tags as $tag)
            <div class="mb-3 form-check">
                <input
                    type="checkbox"
                    class="form-check-input"
                    id="tag{{ $tag->id }}"
                    name="tags[]"
                    value="{{ $tag->id }}"
                    @if (in_array($tag->id, old('tags', []))) checked @endif
                >
                <label class="form-check-label" for="tag{{ $tag->id }}">{{ $tag->name }}</label>
            </div>
        @endforeach
    </div>





    <button class="btn btn-primary">Salva</button>
</form>

@endsection