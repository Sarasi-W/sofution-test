<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4 float-flex position-fixed">
    <!-- Brand Logo -->
    <a href="{{route('home')}}" class="brand-link">
        <img src="{{ asset('/images/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> 
        <span class="brand-text font-weight-light text-white">{{ config('app.name', 'Laravel') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('companies.index')}}"    
                                @if (in_array(Route::currentRouteName(), ['companies.index', 'companies.create', 'companies.show', 'companies.edit']))
                                        class="nav-link active"
                                @else
                                        class="nav-link"
                                @endif
                        >
                                <i class="far fa-circle nav-icon"></i>
                                <p>Companies</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('employees.index')}}"    
                                @if (in_array(Route::currentRouteName(), ['employees.index', 'employees.create', 'employees.show', 'employees.edit']))
                                        class="nav-link active"
                                @else
                                        class="nav-link"
                                @endif
                        >
                                <i class="far fa-circle nav-icon"></i>
                                <p>Employees</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
