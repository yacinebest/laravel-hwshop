@extends('layouts.app', ['title' => __('Images Management'),'route_name'=>'image','edit'=>false])


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
                                <h3 class="mb-0">Comments For {{ $product->name }} :</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Posted By</th>
                                    <th scope="col">Response To</th>
                                    <th scope="col">Body</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Updated At</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($comments as $comment)
                                    <tr>
                                        <td>{{ Str::limit($comment->id, 15) }}</td>
                                        <td>{{ $comment->user->username }}</td>
                                        <td>{{ $comment->parent ? $comment->parent->username : ''  }}</td>
                                        <td>{{  Str::limit($comment->body, 25, '...')  }}</td>
                                        <td>{{ $comment->created_at }}</td>
                                        <td>{{ $comment->updated_at }}</td>
                                        <td>
                                            <ul class="list-unstyled">
                                                <li>
                                                    <form method="post" action="{{ route('comment.destroy',$comment->id) }}" >
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger w-100 mr-2 mb-2"><i class="fa fa-trash"></i>Delete</button>
                                                    </form>
                                                </li>
                                                <li>
                                                    <a href="#" class="btn btn-primary mr-2">{{ $comment->upVoteCount }}  <i class="fa fa-thumbs-up" ></i></a>
                                                    <a href="#" class="btn btn-primary ">{{ $comment->downVoteCount }}  <i class="fa fa-thumbs-down"></i></a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
</div>
@endsection


