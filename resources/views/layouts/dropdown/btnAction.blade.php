<td class="text-right">
    <div class="dropdown">
        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">

            @if( !isset($edit) || $edit)
                <a class="dropdown-item" href="{{ isset($route_name) ? route( $route_name . '.edit',$entity->id) : '' }}"><i class="ni ni-fat-remove"></i>Edit</a>
            @endif

            @if(isset($route_name))
                <form method="post" action="{{ route( $route_name .'.destroy',$entity->id) }}" >
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="dropdown-item"><i class="ni ni-fat-remove"></i>Delete</button>
                </form>
            @endif
        </div>

    </div>
</td>
