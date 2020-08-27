@extends('layouts.default.index' , ['page'=>'Orders','route_name'=>'order',
                                    'edit'=>false,'delete'=>false,'tableComponent'=>true])

{{-- @section('otherBtn')
<div class="col-4 text-right">
    <a href="" class="btn btn-sm btn-primary">Apply Changes</a>
</div>
@endsection --}}

@section('tableComponent')
    <table-index :paginate="{{ json_encode($orders) }}" :columns="{{ json_encode($columns) }}" ></table-index>
@endsection


    {{-- <tr>
        @foreach($columns as $key => $value)
            @if($key==='statusOrder')
            <td>
                <select class="selectpicker form-control" data-style="btn-primary" name="status">

                    @foreach($entity->enumStatus() as $status)
                        @if($entity->status==$status)
                            <option value="{{ $status }}" selected="selected" >{{ $status}}</option>
                        @else
                            <option value="{{ $status }}"  >{{ $status }}</option>
                        @endif
                    @endforeach

                </select>
            </td>
            @else
                <td >{{ $entity->$key }}</td>
            @endif
        @endforeach
        <td>
            <div class="col-4 text-right">
                <a href="" class="btn btn-sm btn-primary">Apply Changes</a>
            </div>
        </td>
    </tr> --}}
