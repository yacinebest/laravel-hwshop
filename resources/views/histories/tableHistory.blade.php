<div class="row mb-3">
    <div class="col">
        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">History For {{ $product->name }} :</h3>
                    </div>
                </div>
            </div>

            <div class="col-12">
            </div>



            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            @foreach($columns_history as $key => $value)
                                <th  scope="col">{{ $value }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @include('histories.rowHistory', ['histories' => $histories,'columns_history'=>$columns_history,'route_name'=>'history'])
                    </tbody>
                </table>
                @if(!empty($histories))
                    {!! $histories->links() !!}
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