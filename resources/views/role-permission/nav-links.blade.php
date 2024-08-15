<div class="container mt-3">
    @can('view role')
    @endcan
    <a href="{{ url('roles') }}" class="btn btn-primary max-2">Roles</a>
    @can('view permission')
    @endcan
        <a href="{{ url('permissions') }}" class="btn btn-info max-2">Permissions</a>
    @can('view user')
    @endcan
    <a href="{{ url('users') }}" class="btn btn-warning max-2">Users</a>
</div>
