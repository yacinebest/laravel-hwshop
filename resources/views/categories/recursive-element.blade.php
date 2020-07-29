<ul>
@foreach($baseCategories as $entity)
    <li><a href="{{ isset($route_name) ? route( $route_name . '.edit',$entity->id) : '' }}">{{ $entity->name }}</a></li>
    @if (count($entity->childs) > 0)
        @foreach($entity->childs as $entities)
            <ul>
                <li><a href="{{ isset($route_name) ? route( $route_name . '.edit',$entities->id) : '' }}">{{ $entities->name }}</a></li>
                @include('categories.recursive-element', ['baseCategories' => $entities->childs])
            </ul>
        @endforeach
    @endif
@endforeach
</ul>
