@extends('layouts.base')

@section('contents')

<form class="cont_a" method="POST" action="{{ route('admin.hashtags.store') }} " enctype="multipart/form-data">
    @csrf

    <div class="mb-3 nome_">
        <label for="tag" class="form-label">Nome Prodotto</label>
        <input
            type="text"
            class="form-control @error('tag') is-invalid @enderror"
            id="tag"
            name="tag"
            value="{{ old('tag') }}"
        >
        <div class="invalid-feedback">
            @error('tag') {{ $message }} @enderror
        </div>
    </div>





    <button class="btn btn-primary">Salva</button>
</form>

@endsection