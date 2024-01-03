@extends('layouts.base')

@section('contents')
<div class="d-flex flex-column gap-3 m-5 align-items-center">
    <a class="bs ts mybtn-1 bg-primary" href="{{ route('admin.projects.index') }}">Prodotti</a>
    <a class="bs ts mybtn-1 bg-primary" href="{{ route('admin.categories.index') }}">Categorie</a>
    <a class="bs ts mybtn-1 bg-primary" href="{{ route('admin.tags.index') }}">Ingredienti</a>
    <a class="bs ts mybtn bg-warning" href="{{ route('admin.reservations.index') }}">Prenotazioni tavoli</a>
    <a class="bs ts mybtn bg-warning" href="{{ route('admin.orders.index') }}">Orders</a>
    <a class="bs ts mybtn-1 bg-success" href="{{ route('admin.posts.index') }}">Post</a>
    <a class="bs ts mybtn-1 bg-success" href="{{ route('admin.hashtags.index') }}">hashtag</a>
    <a class="bs ts mybtn-1 bg-secondary" href="{{ route('admin.setting') }}">Setting</a>
</div>


@endsection
