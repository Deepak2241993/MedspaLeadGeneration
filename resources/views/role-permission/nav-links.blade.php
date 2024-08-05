<div class="container mt-3">
    @can('view role')
        <a href="{{ url('roles') }}" class="btn btn-primary max-2">Roles</a>
    @endcan
    @can('view permission')
    @endcan
        <a href="{{ url('permissions') }}" class="btn btn-info max-2">Permissions</a>
    @can('view user')
        <a href="{{ url('users') }}" class="btn btn-warning max-2">Users</a>
    @endcan
</div>
