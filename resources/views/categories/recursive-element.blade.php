<ul>
@foreach($baseCategories as $entity)
    <li><a href="">{{ $entity->name }}</a> Level {{ $entity->level }}</li>
    @if (count($entity->childs) > 0)
        @foreach($entity->childs as $entities)
            <ul>
                <li><a href="">{{ $entities->name }}</a> Level {{ $entities->level }}</li>
                @include('categories.recursive-element', ['baseCategories' => $entities->childs])
            </ul>
        @endforeach
    @endif
@endforeach
</ul>
