<div class="row mb-3">
    <div class="col">
        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">Order Ref {{ $order->ref }} :</h3>
                    </div>
                </div>
            </div>

            <div class="col-12">
            </div>



            <div class="table-responsive">
                @if(isset($columns) && $columns)
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            @foreach($columns as $key => $value)
                                <th  scope="col">{{ $value }}</th>
                            @endforeach
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
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
                    </tbody>
                </table>
                @endif
            </div>


            <div class="card-footer py-4">
                <nav class="d-flex justify-content-end" aria-label="...">

                </nav>
            </div>

        </div>
    </div>
</div>