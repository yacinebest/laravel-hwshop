<div class="row mb-3">
    <div class="col">
        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">Payment For Order Ref {{ $order->ref }} :</h3>
                    </div>
                </div>
            </div>

            <div class="col-12">
            </div>



            <div class="table-responsive">
                @if(isset($columns) && $columns)
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            @foreach($columns as $key => $value)
                                <th  scope="col">{{ $value }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                @foreach($columns as $key => $value)
                                    <td >{{ $payment->$key }}</td>
                                @endforeach
                            </tr>
                    </tbody>
                </table>
                @endif
            </div>


            <div class="card-footer py-4">
                <nav class="d-flex justify-content-end" aria-label="...">

                </nav>
            </div>

        </div>
    </div>
</div>