<div class="row mb-3">
    <div class="col">
        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">Supply For {{ $product->name }} :</h3>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('supply.create',$product->id) }}" class="btn btn-sm btn-primary">Add Supply</a>
                    </div>
                </div>
            </div>

            <div class="col-12">
            </div>



            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            @foreach($columns_supply as $key => $value)
                                <th  scope="col">{{ $value }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @include('supplies.rowSupply', ['supplies' => $supplies,'columns'=>$columns_supply,'route_name'=>'supply'])
                    </tbody>
                </table>
                @if(!empty($supplies))
                    {!! $supplies->links() !!}
                @endif
            </div>

            @yield('displayTree')

            <div class="card-footer py-4">
                <nav class="d-flex justify-content-end" aria-label="...">

                </nav>
            </div>

        </div>
    </div>
</div>