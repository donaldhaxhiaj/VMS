<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview">
            <li class=""><a href="{{ route('visitor.index') }}"><i class="fa fa-circle-o"></i> Visitors</a></li>
            <li class=""><a href="{{ route('visit.index') }}"><i class="fa fa-circle-o"></i> Visits</a></li>
            <li class=""><a href="{{ route('user.index') }}"><i class="fa fa-circle-o"></i> Users</a></li>
            @can('users.role',Auth::user())
            <li class=""><a href="{{ route('role.index') }}"><i class="fa fa-circle-o"></i> Roles</a></li>
            @endcan
            @can('users.permission',Auth::user())
            <li class=""><a href="{{ route('permission.index') }}"><i class="fa fa-circle-o"></i> Permissions</a>
            @endcan
            </li>
                @can('users.company',Auth::user())
            <li class=""><a href="{{ route('company.index') }}"><i class="fa fa-circle-o"></i> Companies</a></li>
                @endcan




        </ul>
    </section>
    <!-- /.sidebar -->
</aside>