<section class="section-pagetop bg pt-2">
    <div class="container">
        <nav>
            <ol class="breadcrumb text-white justify-content-center" style="background-color: unset;" >
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Home</a>
                </li>
                @foreach($category->parents as $parent)
                    <li class="breadcrumb-item">
                        <a href="{{ route('category',$parent->id) }}">
                            {{ $parent->name }}
                        </a>
                    </li>
                @endforeach
                <li class="breadcrumb-item active" aria-current="page">
                    {{ $category->name }}
                </li>
            </ol>
        </nav>
    </div>
</section>
