{{-- @extends('layouts.default.index' , ['page'=>'Images','route_name'=>'image','edit'=>false]) --}}

@extends('layouts.app', ['title' => __('Images Management'),'route_name'=>'image','edit'=>false])


@section('content')
<div class="main-content">
    @include('layouts.headers.cards',['cardCountAndRoute'=> (isset($cardCountAndRoute) ? $cardCountAndRoute : [] )])
    <div class="container-fluid mt--7">

        <div class="row">
            <div class="col">

                <image-show :images="{{ $images }}" :category="{{ $category }}"></image-show>

                {{-- <div class="card shadow">

                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Images For {{ $category->name }} :</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="" class="btn btn-sm btn-primary">Upload New Images</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                    </div>


                    <image-show :images="{{ $images }}" :category="{{ $category }}"></image-show>

                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">

                        </nav>
                    </div>

                </div> --}}

            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
</div>
@endsection


