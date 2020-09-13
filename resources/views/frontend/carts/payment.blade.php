@extends('frontend.layouts.app')

@section('content')



<div class="container-fluid mb-5" style="margin-top: 162px;">
    <div class="container mx-auto">
        <div class="card" style="min-height: 99px;">
            <div class="justify-content-center row">
                <h2 class="font-weight-bold m-4 text-uppercase title-grid title-panier">Payment Methods :</h2>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="card my-4 p-4 justify-content-center">
            <form class="row" action="{{ route('cart.payment') }}" method="post">
                @csrf

                <input type="hidden" name="order_id" value="{{ $order->id }}">
                <div class="col-md-8">
                    <div class="form-row mx-auto my-3 font-weight-bold">
                        <input type="radio" value="CCP" name="method" checked/>
                        <span class="ml-2">Payment by CCP</span>
                    </div>
                    <div class="form-row mx-auto my-3 font-weight-bold">
                        <input type="radio" value="PAYPAL" name="method" disabled/>
                        <span class="ml-2">Payment by PAYPAL (Currently not available)</span>
                    </div>
                    <div class="form-row mx-auto my-3 font-weight-bold">
                        <input type="radio" value="ccredit" name="method" disabled/>

                        <span class="ml-2 text-muted">Payment by credit card (Currently not available)</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <button
                        type="submit"
                        class="btn btn-out btn-primary btn-square btn-main commander"
                        data-abc="true">
                        Finalize the purchase
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
