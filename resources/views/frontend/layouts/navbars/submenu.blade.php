<ul class="dropdown-menu dropdown-width-categorie navbar-dark bg-dark navbar-padding" >

    <li class="dropdown-divider"></li>

    @foreach(Category::where('level','1')->get() as $category)
        <li class="nav-item nav-drop dropdown-submenu">
            <a href="{{route('category',$category->id)}}" class="nav-link categorie-gird">
                <span class="nav-label">{{ $category->name }}</span>
                <form class="nav-link dropdown-toggle caret-off caret-button-grid" >
                    <button id="dropdownCate{{ $category->ref }}" type="button" class="btn dropdown-toggle dropdown-toggle-split caret-off button-sub-categorie" data-toggle="dropdown" >
                        <span class="fa fa-caret-right" aria-hidden="true"></span>
                    </button>
                </form>

                @if($category->directChildCount > 0)
                    <ul aria-labelledby="dropdownCate{{ $category->ref }}" class="dropdown-menu dropdown-sous-menu dropdown-width-categorie navbar-dark bg-dark navbar-padding style-menu grid-subcategorie" >

                        @foreach($category->childs as $subcategory)
                        <li class="nav-item nav-drop nav-sous-drop">
                            <a href="{{route('category',$subcategory->id)}}" class="nav-link"> {{$subcategory->name}}</a>
                        </li>
                        @endforeach

                    </ul>
                @endif

            </a>
        </li>
    @endforeach

</ul>
