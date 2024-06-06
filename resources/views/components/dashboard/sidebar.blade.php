<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ url('landing_page') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('assets_login/images/favicon.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <!-- <img src="/assets/images/logo/logo-dark.png" alt="" height="17"> -->
                <img src="{{ asset('assets_login/images/favicon.png') }}" alt="" height="90">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ url('landing_page') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('assets_login/images/favicon.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg ">
                <!-- <img src="/assets/images/logo/logo-light.png" alt="" height="17"> -->
                <img src="{{ asset('assets_login/images/favicon.png') }}" class="m-3" alt="" height="60">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>
    {{-- <li class="nav-item">
        <a class="nav-link menu-link" href="#customization" data-bs-toggle="collapse" role="button"
            aria-expanded="false" aria-controls="customization">
            <i class="ri-equalizer-line"></i> <span>Customization</span>
        </a>
        <div class="collapse menu-dropdown" id="customization">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a href="css.html" class="nav-link">CSS</a>
                </li>
                <li class="nav-item">
                    <a href="scss.html" class="nav-link">SASS</a>
                </li>
                <li class="nav-item">
                    <a href="javascript.html" class="nav-link">Javascript</a>
                </li>
            </ul>
        </div>
    </li> --}}
    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                @php
                $menus = Spatie\Permission\Models\Permission::orderBy('position', 'ASC')
                    ->where('level', 1)
                    ->get();
                @endphp

                @foreach ($menus as $menu)
                    @php
                    $string = $menu->name;
                    $nama_menu = str_replace(' ', '', $string);
                    $MenuActive = $menu->route ? 'active' : '';
                    @endphp

                    @can($menu->name)
                        @if ($menu->level == 1)
                            @if ($menu->type == 'static')
                                <li class="nav-item">
                                    <a class="nav-link menu-link{{ request()->routeIs($menu->route.'*') ? ' active' : '' }}" href="{{ route($menu->route) }}">
                                        <i class="{{ $menu->icon }}"></i> <span data-key="t-landing">{{ $menu->name }}</span>
                                    </a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link menu-link" href="#{{ $nama_menu }}" data-bs-toggle="collapse" role="button" aria-controls="{{ $nama_menu }}" aria-expanded="false">
                                        <i class="ri-equalizer-line"></i> <span>{{ $menu->name }}</span>
                                    </a>
                                    @php
                                    $submenus = Spatie\Permission\Models\Permission::orderBy('position', 'ASC')
                                        ->where('level', 2)
                                        ->where('group', $menu->group)
                                        ->get();
                                    @endphp
                                    <div class="collapse menu-dropdown {{ Str::startsWith(Route::currentRouteName(), $menu->route) ? 'show' : '' }}" id="{{ $nama_menu }}">
                                        <ul class="nav nav-sm flex-column">
                                            @foreach ($submenus as $item)
                                                @can($item->name)
                                                    @php
                                                    $route_item = $item->route;
                                                    @endphp
                                                    <li class="nav-item">
                                                        <a class="nav-link{{ request()->routeIs($route_item.'*') ? ' active' : '' }}" href="{{ route($item->route) }}">
                                                            {{ $item->name }}
                                                        </a>
                                                    </li>
                                                @endcan
                                            @endforeach
                                        </ul>
                                    </div>
                                </li>
                            @endif
                        @endif
                    @endcan
                @endforeach
            </ul>


        </div>
        <!-- Sidebar -->
    </div>
</div>
