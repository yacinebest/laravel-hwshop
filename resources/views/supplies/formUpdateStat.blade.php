<form method="post" action="{{ route('supply.update',$supply->id ) }}" autocomplete="off" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="form-group">
        <label class="form-control-label" >Status </label>
        <select class="form-control" name="status">
            @foreach($status as $stat)
                @if($supply->$key==$stat)
                    <option value="{{ $stat }}" name="status" selected="selected" >{{ $stat }}</option>
                @else
                    <option value="{{ $stat }}" name="status"  >{{ $stat }}</option>
                @endif
            @endforeach
        </select>
    </div>
    <button type="submit"class="btn btn-primary w-100">Apply Changes</button>
</form>
