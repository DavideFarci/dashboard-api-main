@extends('layouts.base')

@section('contents')
    {{-- <img src="{{ Vite::asset('resources/img/picsum30.jpg') }}" alt=""> --}}



    
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="expire-mobile">ID</th>
                    <th>TAG</th>

                    <th>
                        <div class="btn-cont">
                            <a class="btn btn-success" href="{{ route('admin.hashtags.create') }}">nuovo</a>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hashtags as $hashtag)
                    <tr>
                        <th class="expire-mobile">{{$hashtag->id}}</th>
                        <td>
                            <span style="color:white" class="ts bs a-notlink badge bg-success rounded-pill"  > {{$hashtag->tag}}</span>
                           
                        </td>
                    
                        <td >
                            <div class="btn-cont">
                                <a class="btn my-btn btn-warning" href="{{ route('admin.hashtags.edit', ['hashtag' =>$hashtag]) }}">Modifica</a>
                                <form action="{{ route('admin.hashtags.destroy', ['hashtag' =>$hashtag])}}" method="post">
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

    {{ $hashtags->links() }}
@endsection

