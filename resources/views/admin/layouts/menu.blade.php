<!--slide bar menu end here-->
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('public/design/admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <?php $site_name = 'sitename_'.Config::get('app.locale')?>
        <span class="brand-text font-weight-light">{{setting()->$site_name}}</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block">{{admin()->user()->name}}</a>
            </div>
        </div>
        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- home li -->
                <li class="nav-item menu-open">
                    <a href="{{ route('home') }}" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{__('dashboard')}}
                        </p>
                    </a>
                </li>
                <!--// home li -->
                <!-- admins li -->
                <li class="nav-item">
                    <a href="{{ route('admins.index') }}" class="nav-link">
                        <i class="fa fa-users"></i>
                        <p>
                            {{__('adminsAccounts')}}
                        </p>
                    </a>
                </li>
                <!--// admins li -->
                <!-- users li -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa fa-users"></i>
                        <p>
                            {{__('usersAccounts')}}
                            @if(Session::get('lang') == 'en')
                                <span class="fa fa-angle-right" style="float: right"></span>
                            @else
                                <span class="fa fa-angle-left" style="float: left"></span>
                            @endif
                            <span class="badge badge-info right">6</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('users.index', ['level' => 'user']) }}" class="nav-link">
                                <p>{{__('user')}}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('users.index', ['level' => 'vendor']) }}" class="nav-link">
                                <p>{{__('vendor')}}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('users.index', ['level' => 'company']) }}l" class="nav-link">
                                <p>{{__('company')}}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--// users li -->
                <!-- countries li -->
                <li class="nav-item">
                    <a href="{{ route('countries.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-flag"></i>
                        <p>
                            {{__('countries')}}
                        </p>
                    </a>
                </li>
                <!--// countries li -->
                <!-- cities li -->
                <li class="nav-item">
                    <a href="{{ route('cities.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-flag"></i>
                        <p>
                            {{__('cities')}}
                        </p>
                    </a>
                </li>
                <!--// cities li -->
                <!-- states li -->
                <li class="nav-item">
                    <a href="{{ route('states.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-flag"></i>
                        <p>
                            {{__('states')}}
                        </p>
                    </a>
                </li>
                <!--// states li -->
                <!-- departments li -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa fa-list-alt"></i>
                        <p>
                            {{__('departments')}}
                            @if(Session::get('lang') == 'en')
                                <span class="fa fa-angle-right" style="float: right"></span>
                            @else
                                <span class="fa fa-angle-left" style="float: left"></span>
                                <span class="badge badge-info right">6</span>    @endif

                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('departments.index') }}" class="nav-link">
                                <p>{{__('departments')}}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('departments.create') }}" class="nav-link">
                                <p>{{__('add')}}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--// departments li -->
                <!-- trademarks li -->
                <li class="nav-item">
                    <a href="{{ route('trademarks.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-cube"></i>
                        <p>
                            {{__('trademarks')}}
                        </p>
                    </a>
                </li>
                <!--// trademarks li -->
                <!-- manufacturers li -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa fa fa-user"></i>
                        <p>
                            {{__('manufacturers')}}
                            @if(Session::get('lang') == 'en')
                                <span class="fa fa-angle-right" style="float: right"></span>
                            @else
                                <span class="fa fa-angle-left" style="float: left"></span>
                                <span class="badge badge-info right">6</span>    @endif

                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('manufacturers.index') }}" class="nav-link">
                                <p>{{__('manufacturers')}}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('manufacturers.create') }}" class="nav-link">
                                <p>{{__('add')}}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--// manufacturers li -->
                <!-- shippingCompanies li -->
                <li class="nav-item">
                    <a href="{{ route('shippingCompanies.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-truck"></i>
                        <p>
                            {{__('shippingCompanies')}}
                        </p>
                    </a>
                </li>
                <!--// shippingCompanies li -->
                <!-- malls li -->
                <li class="nav-item">
                    <a href="{{ route('malls.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-building"></i>
                        <p>
                            {{__('malls')}}
                        </p>
                    </a>
                </li>
                <!--// malls li -->
                <!-- colors li -->
                <li class="nav-item">
                    <a href="{{ route('colors.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-paint-brush"></i>
                        <p>
                            {{__('colors')}}
                        </p>
                    </a>
                </li>
                <!--// colors li -->
                <!-- sizes li -->
                <li class="nav-item">
                    <a href="{{ route('sizes.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-info-circle"></i>
                        <p>
                            {{__('sizes')}}
                        </p>
                    </a>
                </li>
                <!--// sizes li -->
                <!-- weights li -->
                <li class="nav-item">
                    <a href="{{ route('weights.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-balance-scale"></i>
                        <p>
                            {{__('weights')}}
                        </p>
                    </a>
                </li>
                <!--// weights li -->
                <!-- products li -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-tag"></i>
                        <p>
                            {{__('products')}}
                            @if(Session::get('lang') == 'en')
                                <span class="fa fa-angle-right" style="float: right"></span>
                            @else
                                <span class="fa fa-angle-left" style="float: left"></span>
                            @endif
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('products.index') }}" class="nav-link">
                                <p>{{__('products')}}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('products.create') }}" class="nav-link">
                                <p>{{__('add')}}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--// products li -->
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
<!-- /.sidebar -->
</aside>
<div style="clear:both;"> </div>
