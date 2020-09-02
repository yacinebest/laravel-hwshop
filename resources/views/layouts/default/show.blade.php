@extends('layouts.app', ['title' => __( $page . ' Management')])

@section('content')
<div class="main-content">
    @include('layouts.headers.cards',['cardCountAndRoute'=> (isset($cardCountAndRoute) ? $cardCountAndRoute : [] )])
    <div class="container-fluid mt--7">

    <div class="container-fluid mt--7">

        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ $page }} :</h3>
                            </div>
                            @yield('otherBtn')
                        </div>
                    </div>

                    <div class="col-12">
                    </div>



                    <div class="table-responsive">
                        @if( isset($tableComponent) && $tableComponent )
                            @yield('tableComponent')
                        @else
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        @foreach($columns as $key => $value)
                                            <th  scope="col">{{ $value }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                        @yield('entities_column')
                                        @isset($entities)
                                        @foreach($entities as $entity)
                                            <tr class="{{ isset($auth) && $entity->id===$auth->id ? 'table-success' : '' }}">
                                                @foreach($columns as $key => $value)
                                                    <td >{{ $entity->$key }}</td>
                                                @endforeach

                                                @if(!isset($btnAction))
                                                    @include('layouts.dropdown.btnAction', ['entity' => $entity ])
                                                @endif
                                            </tr>
                                        @endforeach
                                        @endisset
                                </tbody>
                            </table>
                        @endif
                        @if(!empty($entities))
                            {!! $entities->links() !!}
                        @endif
                    </div>

                    @yield('displayTree')

                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">

                        </nav>
                    </div>

                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
</div>
@endsection

@section('scripts')
@endsection
