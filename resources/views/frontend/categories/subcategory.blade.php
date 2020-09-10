<main class="col-lg-9 p-4 m-auto grid-categorie border rounded-sm shadow-sm" style="margin-bottom : 50px !important; ">

    <div class="row justify-content-center">
        <h2 class="font-weight-bold m-4 text-uppercase title-grid">
            {{ $category->name }} :
        </h2>
    </div>

    <div class="row" style="justify-content: center;">
        @foreach($category->childs as $sub_category)
            <div class="col-lg-4 col-md-6 col-xs-6 px-4 col-range">
                <figure class="card card-product-grid shadow">
                    <a class="toggle-list" href="{{ route('category',$sub_category->id)  }}">
                        <div class="pic float-left m-2">
                            <img class="img-pic" src="{{ $sub_category->image->imagePath }}" alt="{{ $sub_category->name}}" >
                        </div>
                        <h5 class="font-weight-bold m-4 text-capitalize text-center text-grid">
                            {{ $sub_category->name}}
                        </h5>
                        <span class="icon icon-arrow-bottom-bold"></span>
                    </a>
                </figure>
            </div>
        @endforeach
    </div>

</main>
