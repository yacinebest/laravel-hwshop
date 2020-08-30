@foreach($supplies as $supply)
    <tr>
        @foreach($columns as $key => $value)
            @if($key=="status")
                <td>
                   @includeIf('supplies.formUpdateStat', ['supply' => $supply,'status'=>$status])
                </td>
            @else
                <td >{{ $supply->$key }}</td>
            @endif
        @endforeach
    </tr>
@endforeach
