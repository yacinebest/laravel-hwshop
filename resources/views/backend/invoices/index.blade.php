@extends('backend.layouts.default.index' , ['page'=>'Invoices','route_name'=>'invoice','btnAction'=>false])

@section('entities_column')
@foreach($invoices as $invoice)
    <tr>
        @foreach($columns as $key => $value)
            @if($key=='file')
                <td><a href="{{ route('invoice.show',$invoice->order->id) }}" target="_blank" >Download Invoice</a></td>
            @else
                <td >{{ $invoice->$key }}</td>
            @endif
        @endforeach
    </tr>
@endforeach
@endsection

@section('paginate')
@if(!empty($invoices))
{!! $invoices->links() !!}
@endif
@endsection
