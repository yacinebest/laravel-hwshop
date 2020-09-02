@foreach($supplies as $supply)
    <tr>
        @foreach($columns as $key => $value)
            @if($key=="status")
                <td>
                    @if( $supply->hasBeenUsed  )
                        <div class="form-group">
                            <input type="text" class="form-control form-control-alternative" value="{{ $supply->status }}" readonly>
                        </div>
                    @elseif(isset($product) && $product->isSupplyActive &&  $supply->status!='IN PROGRESS' )
                        <div class="form-group">
                            <input type="text" class="form-control form-control-alternative" value="{{ $supply->status }}" readonly>
                        </div>
                    @else
                        @includeIf('supplies.formUpdateStat', ['supply' => $supply,'status'=>$status])
                    @endif
                </td>
            @elseif($key=='other')
                <td>
                    <form method="post" action="{{ route( $route_name .'.destroy',$supply->id) }}" >
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                    </form>
                </td>
            @else
                <td >{{ $supply->$key }}</td>
            @endif
        @endforeach
    </tr>
@endforeach
