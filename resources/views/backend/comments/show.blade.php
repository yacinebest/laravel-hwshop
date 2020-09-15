@extends('backend.layouts.default.show',['page'=>'Comment For '. $product->name,'route_name'=>'history',
                               'btnAction'=>false,'customTable'=>true])

@section('customTable')
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
                            <button class="btn btn-primary mr-2">{{ $comment->upVoteCount }}  <i class="fa fa-thumbs-up" ></i></button>
                            <button class="btn btn-primary ">{{ $comment->downVoteCount }}  <i class="fa fa-thumbs-down"></i></button>
                        </li>
                    </ul>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('paginate')
@if(isset($comments) && $comments)
{!! $comments->links() !!}
@endif
@endsection
