<div class="container mt-3">
    @can('role_view')
        <a href="{{ route('roles.index') }}" class="btn btn-primary max-2 {{ Route::currentRouteName() == 'roles.index' ? 'active-btn' : '' }}">
            Roles
            @if(Route::currentRouteName() == 'roles.index')
                <i class="ri-arrow-up-s-fill arrow-icon"></i>
            @endif
        </a>
    @endcan
    @can('permission_view')
        <a href="{{ route('role-permission.permissions.index') }}" class="btn btn-info max-2 {{ Route::currentRouteName() == 'role-permission.permissions.index' ? 'active-btn' : '' }}">
            Permissions
            @if(Route::currentRouteName() == 'role-permission.permissions.index')
                <i class="ri-arrow-up-s-fill arrow-icon"></i>
            @endif
        </a>
    @endcan
    @can('user_view')
        <a href="{{ route('users.index') }}" class="btn btn-warning max-2 {{ Route::currentRouteName() == 'users.index' ? 'active-btn' : '' }}">
            Users
            @if(Route::currentRouteName() == 'users.index')
                <i class="ri-arrow-up-s-fill arrow-icon"></i>
            @endif
        </a>
    @endcan
</div>

