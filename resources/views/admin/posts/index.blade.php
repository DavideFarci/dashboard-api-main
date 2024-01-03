@extends('layouts.base')

@section('contents')
    {{-- <img src="{{ Vite::asset('resources/img/picsum30.jpg') }}" alt=""> --}}

    @if (session('delete_success'))
        @php
            $post = session('delete_success')
        @endphp
        <div class="alert alert-danger">
            "{{ $post->title }}" è stato correttamente spostato nel cestino!
    
        </div>
    @endif

    @if (session('restore_success'))
        @php
            $post = session('restore_success')
        @endphp
        <div class="alert alert-success">
            "{{ $post->name }}" è stato correttamente ripristinato!
            
        </div>
    @endif


        <h2>
            POST PUBBLICATI
        </h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="expire-mobile">ID</th>
                    <th>TITOLO</th>
                    <th class="expire-mobile-s">IMMAGINE</th>
                    <th class="expire-mobile-s">DESCRIZIONE</th>
                    <th class="expire-mobile-s">INSTAGRAM LINK</th>
 
                    <th class="expire-mobile">HASHTAG</th>
                    <th>
                        <div class="btn-cont">
                            <a class="btn btn-success" href="{{ route('admin.posts.create') }}">nuovo</a>
                            <a class="btn btn-danger" href="{{ route('admin.posts.trashed') }}">cestino</a>

                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts->reverse() as $post)
                    <tr>
                        <th class="expire-mobile">{{$post->id}}</th>
                        <td>
                            <a style="color:white" class="ts bs a-notlink badge bg-success rounded-pill" href="{{ route('admin.posts.show', ['post' =>$post]) }}" > {{$post->title}}</a>
                           
                        </td>
                        <td class="expire-mobile-s"> 
                            @if ($post->image)
                                <img class="my-image" src="{{ asset('public/storage/' . $post->image) }}" alt="{{ $post->title }}">
                            @endif

                        </td>
                        <td class="expire-mobile-s">{{$post->description}}</td>
                        <td class="expire-mobile-s">{{$post->link}}</td>
                 
                        <td class="expire-mobile">
                            @foreach ($post->hashtags as $tag)
                                <span>{{ $tag->tag }}</span>
                            @endforeach
                        </td>
                        <td >
                            <div class="btn-cont">
                                <a class="btn my-btn btn-warning" href="{{ route('admin.posts.edit', ['post' =>$post]) }}">Modifica</a>
                                <form action="{{ route('admin.posts.destroy', ['post' =>$post])}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger" >Elimina</button>
                                </form>

                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    {{ $posts->links() }}
@endsection

