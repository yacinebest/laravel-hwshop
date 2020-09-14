@extends('frontend.users.layout.structure')


@section('principal_content')

  {{-- Comment of this user --}}
  <div class="row card mb-4 profile-card last-comments" >
    <div class="card-header profile-card-header">
        My Last Comments
    </div>
    <div class="card-body">
        <ul class="list-unstyled latest">
            @if($user->commentCount)
                <hr>
                @foreach($user->comments as $comment)
                    @if($comment->parent_id==null)
                        <li class='latest-li border rounded-sm p-3 bg-light shadow-sm'>
                            <h5>[{{ $comment->created_at }}] -
                                <a href="{{ $comment->product->id }}">
                                    {{$comment->product->name}}
                                </a>
                            </h5>
                            <p class='bg-white p-2 border rounded-sm shadow' style='background-color: #f6f7f9 !important;'>
                                {{$comment->body}}
                            </p>
                        </li>
                    @else
                        <li class='latest-li border rounded-sm p-3 bg-light shadow-sm'>
                            <h5>[{{ $comment->created_at }}] -
                                <a href="{{ $comment->product->id }}">
                                    {{$comment->product->name}}
                                </a>
                                <br>
                                Parent Comment By {{ $comment->parent->user->username }}
                            </h5>
                            <i ></i>[Parent Comment] - [{{ $comment->parent->created_at }}]
                            <p class='bg-white p-2 border rounded-sm shadow' style='background-color: #f6f7f9 !important;'>
                                {{$comment->parent->body}}
                            </p>
                            <i class="fa fa-reply px-2"></i>[Reply Comment] - [{{ $comment->created_at }}]
                            <p class='bg-white mx-3 p-2 border rounded-sm shadow' style='background-color: #f6f7f9 !important;'>
                                {{$comment->body}}
                            </p>



                        </li>
                    @endif
                    <hr>
                @endforeach
            @else
                No comments yet.
            @endif
        </ul>
    </div>
</div>

@endsection
