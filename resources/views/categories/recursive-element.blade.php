<ul>
@foreach($baseCategories as $entity)
    <li><a href="">{{ $entity->name }}</a></li>
    @if (count($entity->childs) > 0)
        @foreach($entity->childs as $entities)
            <ul>
                <li><a href="">{{ $entities->name }}</a></li>
                @include('categories.recursive-element', ['baseCategories' => $entities->childs])
            </ul>
        @endforeach
    @endif
@endforeach
</ul>
