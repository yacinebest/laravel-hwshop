@extends('layouts.app', ['title' => __( $page . ' Management')])

@section('content')

<div class="main-content">

    @include('layouts.headers.cards',['cardCountAndRoute'=> (isset($cardCountAndRoute) ? $cardCountAndRoute : [] )])

    <div class="container-fluid mt--7">

        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ $page }} :</h3>
                            </div>
                            {{-- <div class="col-4 text-right">
                                <a href="" class="btn btn-sm btn-primary">Add {{ $page }}</a>
                            </div> --}}
                        </div>
                    </div>

                    <div class="col-12">
                    </div>



                    <div class="table-responsive">
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
                                    @foreach($entities as $entity)
                                        <tr class="{{ isset($auth) && $entity->id===$auth->id ? 'table-success' : '' }}">
                                            @foreach($columns as $key => $value)
                                                {{-- <td >{{ $entity->$key }}</td> --}}
                                                @if($key==='avatar')
                                                    <td>
                                                        <user-avatar :user="{{ $entity }}" ></user-avatar>
                                                    </td>
                                                @else
                                                    <td >{{ $entity->$key }}</td>
                                                @endif
                                            @endforeach
                                            <td class="text-right">
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">

                                                        @if( !isset($edit) || $edit)
                                                            <a class="dropdown-item" href="{{ isset($route_name) ? route( $route_name . '.edit',$entity->id) : '' }}"><i class="ni ni-fat-remove"></i>Edit</a>
                                                        @endif

                                                        @if(isset($route_name))
                                                            <form method="post" action="{{ route( $route_name .'.destroy',$entity->id) }}" >
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item"><i class="ni ni-fat-remove"></i>Delete</button>
                                                            </form>
                                                        @endif
                                                    </div>

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                            </tbody>
                        </table>
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
