<form method="post" action="{{ route('order.update',$order->id ) }}" autocomplete="off" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="form-group">
        <select class="form-control" name="status">
            @foreach($status as $stat)
                @if($order->status==$stat)
                    <option value="{{ $stat }}" name="status" selected="selected" >{{ $stat }}</option>
                @else
                    <option value="{{ $stat }}" name="status"  >{{ $stat }}</option>
                @endif
            @endforeach
        </select>
    </div>
    <button type="submit"class="btn btn-primary w-100">Apply Changes</button>
</form>
