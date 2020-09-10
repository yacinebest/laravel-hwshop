@extends('frontend.users.layout.structure')


@section('principal_content')
<div class="row card mb-4 profile-card history" >
    <div class="card-header profile-card-header">
        My Purchase History
    </div>
    <div class="card-body">
        <ul class="list-unstyled latest">
            @if($user->orderCount>0)
                <hr>
                @foreach($user->orders as $order)
                    <li class="latest-li border rounded-sm p-2 shadow-sm">
                        <h2>[{{ $order->invoice->created_at }}] - Invoice "{{ $order->invoice->ref }}"</h2>
                        <h5>Total Qte  : {{ $order->invoice->quantity }} </h5>
                        <h5>Total Price : {{ $order->invoice->total_price }} DZD </h5>
                        <div class='card-footer text-right'>
                            <a href="{{ route('invoice.show',$order->id) }}" target="_blank" >Download Invoice</a>
                        </div>

                    </li>
                    <hr>
                @endforeach
            @else
                No Invoice For The Moment.
            @endif
        </ul>
    </div>
</div>
@endsection
