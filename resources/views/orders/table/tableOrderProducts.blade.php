<div class="row mb-3">
    <div class="col">
        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">Order Product Ref {{ $order->ref }} :</h3>
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
                            <th scope="col">Product Name</th>
                            <th scope="col">Unit Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Sub Price</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach($order->products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->pivot->ordered_quantity }}</td>
                                    <td>{{ $product->subPrice  }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td>{{ $invoice->quantity  }}</td>
                                <td></td>
                                <td>{{ $invoice->total_price }}</td>
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
