@extends('frontend.layouts.app')


@section('links')
<link rel="stylesheet" href="{{ asset('css/frontend/cart.css') }}">

@endsection

@section('content')

<div class="container-fluid mb-5" style="margin-top: 162px;">
    <cart-table :url_order={{ json_encode (route('cart.order'))  }}
                :url_back={{  json_encode(redirect()->back()->getTargetUrl() ) }}></cart-table>

</div>
@endsection
