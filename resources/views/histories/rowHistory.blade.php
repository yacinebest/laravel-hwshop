@foreach($histories as $history)
    <tr>
        @foreach($columns_history as $key => $value)
            <td >{{ $history->$key }}</td>
        @endforeach
    </tr>
@endforeach
