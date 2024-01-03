@extends('layouts.guest')

@section('contents')
    <div class="container my-3">
        <a class="btn btn-outline-primary" href="{{route('login')}}">login</a>
    </div>
@endsection
    {{-- <a href="{{route('admin.dashboard')}}">indexadmin</a> --}}