@extends('layouts.base')

@section('contents')

<form class="cont_a" method="POST" action="{{ route('admin.categories.store') }}">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">Titolo</label>
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

    

    <button class="btn btn-primary">Salva</button>
</form>

@endsection