<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MENUJA KRYESORE</li>
            <li class="active treeview">
            <li class=""><a href="{{ route('visitor.index') }}"><i class="fa fa-circle-o"></i> Vizitoret</a></li>
            <li class=""><a href="{{ route('visit.index') }}"><i class="fa fa-circle-o"></i> Vizitat</a></li>
            @can('users.view',Auth::user())
            <li class=""><a href="{{ route('user.index') }}"><i class="fa fa-circle-o"></i> Perdoruesit</a></li>
            @endcan
            @can('users.role',Auth::user())
            <li class=""><a href="{{ route('role.index') }}"><i class="fa fa-circle-o"></i> Rolet</a></li>
            @endcan
            @can('users.permission',Auth::user())
            <li class=""><a href="{{ route('permission.index') }}"><i class="fa fa-circle-o"></i> Te drejtat</a>
            @endcan
            </li>
                @can('users.company',Auth::user())
            <li class=""><a href="{{ route('company.index') }}"><i class="fa fa-circle-o"></i> Kompanite</a></li>
                @endcan
                @can('users.purpose',Auth::user())
            <li class=""><a href="{{ route('purpose.index') }}"><i class="fa fa-circle-o"></i> Qellimet</a></li>
                @endcan




        </ul>
    </section>
    <!-- /.sidebar -->
</aside>