@foreach($histories as $supply)
    <tr>
        @foreach($columns as $key => $value)
            <td >{{ $supply->$key }}</td>
        @endforeach
    </tr>
@endforeach
