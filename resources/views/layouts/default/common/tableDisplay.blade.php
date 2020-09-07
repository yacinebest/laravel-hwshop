<div class="row">
    <div class="col">
        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">{{ $page }} :</h3>
                    </div>
                    @if( isset($addBtn) && $addBtn )
                        <div class="col-4 text-right">
                            <a href="{{ route(  $route_name . '.create') }}" class="btn btn-sm btn-primary">Create New {{ $addBtn }}</a>
                        </div>
                    @endif
                    @yield('otherBtn')
                </div>
            </div>

            <div class="col-12">
            </div>



            <div class="table-responsive">
                @if(isset($customTable) && $customTable)
                    @yield('customTable')
                @else
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
                                @if(isset($entities) && $entities)
                                @foreach($entities as $entity)
                                    <tr class="{{ isset($auth) && $entity->id===$auth->id ? 'table-success' : '' }}">
                                        @foreach($columns as $key => $value)
                                            <td >{{ $entity->$key }}</td>
                                        @endforeach

                                        @if(!isset($btnAction))
                                            @include('layouts.dropdown.btnAction', ['entity' => $entity , 'route_name'=>$route_name ])
                                        @endif
                                    </tr>
                                @endforeach
                                @endif
                                @yield('entities_column')
                        </tbody>
                    </table>
                    @endif
                @endif
                @if(isset($entities) && $entities)
                    {!! $entities->links() !!}
                @endif
                @yield('paginate')
            </div>

            @yield('displayTree')

            <div class="card-footer py-4">
                <nav class="d-flex justify-content-end" aria-label="...">

                </nav>
            </div>

        </div>
    </div>
</div>
