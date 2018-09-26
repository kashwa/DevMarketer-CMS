<div class="side-menu">
    <aside class="menu m-t-30 m-l-10">
        <p class="menu-label">General</p>
        <ul class="menu-list">
            <li class="side-menu-item"><a class="is-clk" href=" {{route('manage.dashboard')}} ">Dashboard</a></li>
        </ul>

        <p class="menu-label">Administration</p>

        <ul class="menu-list">
            <li class="side-menu-item"><a class="is-clk" href="{{route('users.index')}}">Manage Users</a></li>
            <li class="side-menu-item">
                <a class="has-submenu">Roles &amp; Permissions</a>
                <ul class="submenu">
                    <li><a href="{{route('roles.index')}}">Roles</a></li>
                    <li><a href="{{route('permissions.index')}}">Permissions</a></li>
                </ul>
            </li>
        </ul>
    </aside>
</div>