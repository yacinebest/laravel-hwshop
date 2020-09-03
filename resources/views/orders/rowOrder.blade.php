@foreach($orders as $order)
    <tr>
        @foreach($columns as $key => $value)
            @if($key == 'status')
                <td>
                    @if( $order->hasBeenVerified  )
                        <div class="form-group">
                            <input type="text" class="form-control form-control-alternative" value="{{ $order->status }}" readonly>
                        </div>
                    @else
                        @includeIf('orders.formUpdateStat', ['order' => $order,'status'=>$status])
                    @endif
                </td>
            @elseif($key=='other')
                <td>
                    <a href="{{ route( $route_name .'.show',$order->id) }}" class="btn btn-sm btn-secondary">See Details</a>
                </td>
            @else
                <td >{{ $order->$key }}</td>
            @endif
        @endforeach
    </tr>
@endforeach
