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
                    <ul class="list-unstyled">
                        <li><a href="{{ route( $route_name .'.show',$order->id) }}" class="btn btn-sm btn-secondary">See Details</a></li>
                        <li>Payment Method: <br>{{ $order->payment->method }}
                        </li>
                        <li>Payment Info: <br>{{ $order->payment->contact_info }}</li>
                        @if($order->payment->isCCP)
                            <li>Payment Contact N°: <br>{{ $order->payment->phone_number }}</li>
                        @else
                            <li>Payment Token: <br>{{ $order->payment->token }}</li>
                        @endif
                        <li>
                            <a href="{{ route('invoice.show',$order->id) }}" target="_blank" >Download Invoice</a>
                        </li>
                    </ul>
                </td>
            @elseif($key=='deliveryDate')
                <td>
                    @if($order->deliveryDate)
                        <div class="form-group">
                            <p>Society :{{ $order->delivery->delivery_society }}</p>
                            <p>Price :{{ $order->delivery->price }}</p>
                            <p>Delivery Date :{{ $order->deliveryDate }}</p>
                            <p>N° :{{ $order->delivery->phone_number }}</p>
                            <p>Status :{{ $order->delivery->status }}</p>
                        </div>
                    @else
                        @if($order->isCanceled)
                            <div>
                                <p>Not Set</p>
                            </div>
                        @else
                            <div>
                                <a href="{{ route('delivery.create',$order->id) }}" class="btn btn-sm btn-primary">Add Delivery</a>
                            </div>
                        @endif
                    @endif
                </td>
            @else
                <td >{{ $order->$key }}</td>
            @endif
        @endforeach
    </tr>
@endforeach
