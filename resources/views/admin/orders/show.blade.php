@extends('layouts.base')

@section('contents')
<a href="{{ route('admin.orders.index') }}" class="btn btn-dark my-3">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-90deg-left" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.146 4.854a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H12.5A2.5 2.5 0 0 1 15 6.5v8a.5.5 0 0 1-1 0v-8A1.5 1.5 0 0 0 12.5 5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4z"/></svg>
</a>

    {{-- <img src="{{ Vite::asset('resources/img/picsum30.jpg') }}" alt=""> --}}
    <div class="my-3">
        <div class="card p-3">
            <h1 style="text-transform:uppercase " >{{$order->name}}</h1>
          
            <h3>Id: <span class="badge rounded-pill bg-secondary">{{ $order->id}}</span> </h3>
            <h3>Nome: <span class="badge rounded-pill bg-secondary">{{ $order->name}}</span> </h3>
            <h3>Telefono: <span class="badge rounded-pill bg-secondary">{{ $order->phone}}</span> </h3>
            <h3>Giorno: <span class="badge rounded-pill bg-secondary">{{ $order->date}}</span> </h3>
            <h3>Orario: <span class="badge rounded-pill bg-secondary">{{ $order->time}}</span> </h3>
            <h3>Status:  
            @if($order->status)

                <span class="badge bg-success">Completato</span> 
            
            @else
            
                <span class="badge bg-danger">In Elaborazione</span> 
            
            @endif
            </h3>
            <h3>Prodotti ordinati: </h3>
            <div style="display: flex; gap: .2em; flex-wrap: wrap">
                @foreach ($order->projects as $project)
                    <li>{{$project->name}}</li>
                    @foreach ($quantity_item as $qt)
                        @if($qt->project_id == $project->id && $qt->order_id == $order->id && $qt->quantity_item!==1)
                        <strong>x{{$qt->quantity_item}}</strong>
                        @endif
                    @endforeach
                @endforeach
            </div>
            
            <h3>Prezzo totale: <span class="badge rounded-pill bg-warning">€{{ $order->total_price / 100 }}</span> </h3>
            <form action="{{ route('admin.orders.updatestatus', $order->id) }}" method="post">
                @csrf
                <button class="btn btn-warning">Modifica Stuatus</button>
            </form>
        </div>
    </div>    

@endsection