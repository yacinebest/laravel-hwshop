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
                                    @yield('entities_column')
                                    @isset($entities)
                                    @foreach($entities as $entity)
                                        <tr class="{{ isset($auth) && $entity->id===$auth->id ? 'table-success' : '' }}">
                                            @foreach($columns as $key => $value)
                                                @if($key==='avatar')
                                                    <td>
                                                        <user-avatar :user="{{ $entity }}" ></user-avatar>
                                                    </td>
                                                @elseif($key==='logo')
                                                    <td>
                                                        <brand-logo :entity="{{ $entity }}"></brand-logo>
                                                    </td>
                                                @elseif($key==='imageCount')
                                                    <td>
                                                        <a href="{{ route('image.show',$entity->id) }}" class="btn btn-primary">{{ $entity->$key }} Image</a>
                                                        {{-- <button class="btn btn-primary" type="submit">{{ $entity->$key }} Image</button> --}}
                                                    </td>
                                                @elseif($key==='columnCount')
                                                    <td>
                                                        <ul class="list-unstyled">
                                                            <li> <a href="{{ route('image.show',$entity->id) }}" class="btn btn-primary m-2">{{ $entity->imageCount }} Image</a></li>
                                                            <li> <a href="#" class="btn btn-primary m-2">{{ $entity->commentCount }} Comment</a></li>
                                                            <li> <a href="#" class="btn btn-primary m-2">{{ $entity->upVoteCount }} Up Vote</a></li>
                                                            <li> <a href="#" class="btn btn-primary m-2">{{ $entity->downVoteCount }} Down Vote</a></li>
                                                        </ul>
                                                        {{-- <button class="btn btn-primary" type="submit">{{ $entity->$key }} Image</button> --}}
                                                    </td>
                                                @else
                                                    <td >{{ $entity->$key }}</td>
                                                @endif
                                            @endforeach

                                            @include('layouts.dropdown.btnAction', ['entity' => $entity ])
                                        </tr>
                                    @endforeach
                                    @endisset
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
