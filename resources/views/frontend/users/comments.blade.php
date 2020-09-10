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
                    <li class='latest-li border rounded-sm p-3 bg-light shadow-sm'>
                        <h5>[{{ $comment->create_at }}] -
                            <a href="{{ $comment->product->id }}">
                                {{$comment->product->name}}
                            </a>
                        </h5>
                        <p class='bg-white p-2 border rounded-sm shadow' style='background-color: #f6f7f9 !important;'>
                            {{$comment->body}}
                        </p>

                        {{-- reply to comment --}}
                        {{-- <i class="fa fa-reply px-2"></i>[Réponse de l\'équipe HWShop] - ['.$comment['date_reponse_admin'].'] --}}
                        {{-- <p class='bg-white mx-3 p-2 border rounded-sm shadow' style='background-color: #f6f7f9 !important;'></p> --}}
                    </li>
                    <hr>
                @endforeach
            @else
                No comments yet.
            @endif
        </ul>
    </div>
</div>

@endsection
