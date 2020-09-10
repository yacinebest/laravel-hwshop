@extends('frontend.layouts.app')


@section('links')
<link rel="stylesheet" href="{{ asset('css/frontend/cart.css') }}">

@endsection

@section('content')

<div class="container-fluid mb-5" style="margin-top: 162px;">
    <div class="row">

        <aside class="col-lg-9">
            <div class="card" style="min-height: 99px;">
                <div class="justify-content-center row">
                    {{-- cart fill --}}
                    {{-- <h2 class="font-weight-bold m-4 text-uppercase title-grid title-panier">Your Cart :</h2> --}}
                    {{-- cart empty --}}
                    <h2 class="font-weight-bold m-4 text-uppercase title-grid title-panier">Your Cart Is Empty...</h2>
                </div>
                @if(false)
                {{--  check if cart is fill --}}

                <div class="table-responsive" >
                    <table class="table  table-shopping-cart">
                        <thead class="text-muted">
                            <tr class="small text-uppercase">
                                <th class="pl-5" scope="col">Product</th>
                                <th scope="col" width="90">Quantity</th>
                                <th scope="col" width="120">Price</th>
                                <th scope="col" width="120">Sub-Price</th>
                                <th scope="col"  ></th>
                            </tr>
                        </thead>
                        <tbody>
                            {{--  --}}
                            <tr>
                                <td>
                                    <figure class="itemside align-items-center">
                                        <div class="aside">
                                            <img src="/public/images/articles/" class="img-sm">
                                        </div>
                                        <figcaption class="info">
                                            <a href="#" class="title font-weight-bolder text-capitalize text-dark" data-abc="true">
                                                Name Product
                                            </a>
                                        </figcaption>
                                    </figure>
                                </td>
                                <td data-th="Quantity">
                                    <input type="number" class="form-control text-center qte-number" min="0" max="0" value="0">
                                    <small class="text-muted"> Max : </small>
                                </td>
                                <td>
                                    <div class="price-wrap">
                                        <var class="price">
                                            0 DZD
                                        </var>
                                    </div>
                                </td>
                                <td data-th="sous-total" >
                                    <div class="price-wrap">
                                        <var class="price">
                                            0 DZD
                                        </var>
                                    </div>
                                </td>
                                <td class="text-right">
                                    <button href="#" class="btn btn-light delete-article-page-panier" data-abc="true">Delete</button>
                                </td>
                            </tr>
                            {{--  --}}
                        </tbody>
                    </table>
                </div>

                @endif
            </div>
        </aside>

        <aside class="col-lg-3">

            <div class="card">
                <div class="card-body">
                    @if(false)
                    {{--  check if cart is fill --}}
                        <dl class="dlist-align">
                            <dt>Total Price:</dt>
                            <dd class="text-right ml-3 dd-prix-total font-weight-bolder text-success">
                               0 DZD
                            </dd>
                        </dl>
                        <hr>

                        <form action="" method="post"  >
                            <input name="order" class="p-0 m-0 d-none order-input">
                            <button type="submit" class="btn btn-out btn-primary btn-square btn-main commander" data-abc="true">
                                Order
                            </button>
                        </form>
                    @endif

                    <a href="{{ url()->previous() }}" class="btn btn-out btn-success btn-square btn-main mt-2 continuer-achat w-100" data-abc="true">
                        Continue Shopping
                    </a>
                </div>
            </div>

        </aside>

    </div>
</div>
@endsection
