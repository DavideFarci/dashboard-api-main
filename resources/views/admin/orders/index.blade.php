@extends('layouts.base')

@section('contents')
    {{-- <img src="{{ Vite::asset('resources/img/picsum30.jpg') }}" alt=""> --}}
   

    
        <h1>PRENOTAZIONI D'ASPORTO</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="expire-mobile">ID</th>
                    <th style="max-width:60px">NOME</th>
                    <th class="expire-mobile">TELEFONO</th>
                    <th class="expire-mobile-s">ORARIO</th>
                    <th class="expire-mobile-s">GIORNO</th>
                    <th class="expire-mobile-s">IMPORTO</th>
                    <th>STATUS</th>
                    <th class="expire-mobile-s">PRODOTTI</th>

                    
                    <th></th>


                </tr>
            </thead>
            <tbody class="body-cat">
                @foreach ($orders->reverse() as $order)
                    <tr>
                        <th class="expire-mobile">{{$order->id}}</th>
                        <td class="name-mobile" >
                            <a style="color:white; white-space:wrap" class="ts bs a-notlink badge bg-success rounded-pill" href="{{ route('admin.orders.show', ['order' =>$order]) }}" > {{$order->name}}</a>
                           
                        </td>
                        <td class="expire-mobile">{{$order->phone}}</td>
                        <td class="expire-mobile-s">{{$order->time}}</td>
                        <td class="expire-mobile-s">{{$order->date}}</td>
                        <td class="expire-mobile-s">€{{$order->total_price / 100}}</td>
                        <td>
                            @if($order->status == 1)

                                <span class="badge bg-success">Confermato</span> 
                                
                            @elseif($order->status == 2)    

                                <span class="badge bg-danger">Annullato</span> 

                            @else

                                <span class="badge bg-warning">In Elaborazione</span> 
                                
                            @endif
                            
                        
                        </td>

                        <td class="expire-mobile-s">
                            <ul>
                                @foreach ($order->projects as $project)
                                <li>{{$project->name}}
                                    @foreach ($orderProject as $oP)
                                        @if($oP->project_id == $project->id && $oP->order_id == $order->id )
                                        <?php  $arrD= json_decode($oP->deselected) ?> 
                                            @foreach ($arrD as $d)
                                                <strong>x{{$oP->quantity_item}}</strong>
                                                <strong>- {{$d}}</strong>          
                                            @endforeach
                                        @endif
                                    @endforeach
                                </li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <form class="d-inline" action="{{ route('admin.orders.confirmOrder', $order->id) }}" method="post">
                                @csrf
                                <button value="1" class="expire-mobile-s btn btn-warning">
                                    Conferma
                                </button>
                            </form>
                            <form class="d-inline" action="{{ route('admin.orders.rejectOrder', $order->id) }}" method="post">
                                @csrf
                                <button value="2" class="expire-mobile-s btn btn-danger">
                                    Annulla
                                </button>
                            </form>
                        </td>

                    </tr>
                @endforeach
            </tbody>
           
        </table>

    {{ $orders->links() }}
@endsection