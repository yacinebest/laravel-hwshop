@foreach($orders as $order)
    <tr>
        @foreach($columns as $key => $value)
            @if($key=='ref')
                <td>
                    {{ $order->$key }}
                    <br>
                    <a href="{{ route( 'order.show',$order->id) }}" class="btn btn-sm btn-secondary bottom--4 left--2 ">See Details</a>
                </td>
            @elseif($key == 'status')
                <td>
                    @if( $order->hasBeenVerified  )
                        <div class="form-group">
                            <input type="text" class="form-control form-control-alternative" value="{{ $order->status }}" readonly>
                        </div>
                    @else
                        @includeIf('orders.formUpdateStat', ['order' => $order,'status'=>$status])
                    @endif
                </td>
                @elseif($key=='deliveryDate')
                    <td>
                        @if($order->deliveryDate)
                            <div class="form-group">
                                {{ $order->delivery->status }}
                            </div>
                        @else
                            @if($order->isCanceled)
                                <div>
                                    Not Set
                                </div>
                            @else
                                <div>
                                    <a href="{{ route('delivery.create',$order->id) }}" class="btn btn-sm btn-primary">Add Delivery</a>
                                </div>
                            @endif
                        @endif
                    </td>
                @elseif($key=='payment')
                    <td>
                        {{ $order->payment->method }}
                    </td>
                @else
                    <td >{{ $order->$key }}</td>
                @endif
        @endforeach
    </tr>
@endforeach
