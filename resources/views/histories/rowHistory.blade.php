@foreach($histories as $history)
    <tr>
        @foreach($columns as $key => $value)
            <td >{{ $history->$key }}</td>
        @endforeach
    </tr>
@endforeach
