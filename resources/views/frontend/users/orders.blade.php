@extends('frontend.users.layout.structure')


@section('principal_content')


{{-- Order --}}
 <div class="row card mb-4 profile-card last-orders">
    <div class="card-header profile-card-header">
        My Recent Orders
    </div>
    <div class="card-body">
        <ul class="list-unstyled latest">
            @if($user->orderCount>0)
                <hr>
                @foreach($orders as $order)
                    <li class="latest-li border rounded-sm p-2 shadow-sm">
                        <h5>[{{ $order->order_date }}] - Order "{{ $order->status }}"</h5>
                        <ul style="list-style-type : disc !important">
                            @foreach($order->products as $product)
                                <li>
                                    <a href="{{ route('product',$product->id) }}">
                                        {{ $product->name }}
                                    </a>
                                    [Qte: {{ $product->pivot->ordered_quantity }} ]
                                </li>
                            @endforeach
                        </ul>
                        <div class="text-right">
                            <span class="btn btn-sm btn-info mb-2 btn-order-dettails toggle-info" data-class="order-dettails">
                                Details
                                <i class="fa fa-angle-down"></i>
                            </span>
                        </div>

                        <div class="row card m-2 shadow rofile-card order-dettails" style="display: none">
                            <div class="card-header profile-card-header">
                                Details of the order
                            </div>
                            <div class="card-body">
                                <div class='row'>
                                    <div class='col-md-6'><h5>Adresse de livraison</h5>
                                        Full Name : {{ $user->fullName }} <br>
                                        Address : {{ $user->address ? $user->address : 'Not Set' }}<br>
                                        Phone Number : {{ $user->phone_number }}
                                    </div>
                                </div>
                                <div class='table-responsive mt-2'>
                                    <table class='table table-bordered table-hover'>
                                        <tr class='bg-bill'>
                                            <td>Product</td>
                                            <td>U Price</td>
                                            <td>Qte</td>
                                            <td>Total</td>
                                        </tr>
                                        @foreach($order->products as $product)
                                        <tr>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->price }} DZD</td>
                                            <td>{{ $product->pivot->ordered_quantity }}</td>
                                            <td>{{ $product->SubPrice }} DZD</td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <div class='row'>
                                    <div class='col-md-6'>
                                        <div class='table-responsive'>
                                            <table class='table-bordered'>
                                                <tr>
                                                    <td class='bg-bill'>Payment method</td>
                                                    <td class='text-center'>
                                                        {{ $order->payment ? $order->payment->method : '/' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class='bg-bill'>Delivery company</td>
                                                    <td class='text-center'>
                                                        {{ $order->delivery && $order->delivery->delivery_society ? $order->delivery->delivery_society : '' }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class='col-md-6'>
                                        <div class='table-responsive'>
                                            <table class='table-bordered border-dark'>
                                                <tr>
                                                    <td class='bg-bill'>Total Products</td>
                                                    <td class='text-center'>{{ $order->invoice ? $order->invoice->total_price : 0 }} DZD</td>
                                                </tr>
                                                <tr>
                                                    <td class='bg-bill'>Shipping cost</td>
                                                    <td class='text-center'>{{ $order->delivery ? $order->delivery->price : 0 }} DZD</td>
                                                </tr>
                                                <tr>
                                                    <td class='bg-bill'>Total</td>
                                                    <td class='text-center'>{{ $order->totalWithShippingCost }} DZD</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='card-footer text-right'>
                                <a href="{{ route('invoice.show',$order->id) }}" target="_blank" >Download Invoice</a>
                            </div>
                        </div>
                    </li>
                    <hr>
                @endforeach

            @else
                No Orders For The Moment.
            @endif
        </ul>
    </div>
</div>


@endsection
