<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="{{ route('home') }}" class="brand-link">
            <!--begin::Brand Image-->
            {{-- <img src="../../dist/assets/img/AdminLTELogo.png" alt="FuelSystem Logo" --}}
            <img src="{{ asset('dist/assets/img/FavIcon.png') }}" alt="FuelSystem Logo"
                class="brand-image opacity-75 shadow" />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">Fuel</span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ isActive('home') }}">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>{{__("Dashboard")}}</p>
                    </a>
                </li>

                <li class="nav-item {{ menuOpen('fuel.create') . menuOpen('fuel.index')}}" id="fuelInventory">
                    <a href="#" class="nav-link main-link {{ isActive('fuel.create') . isActive('fuel.index')}}">
                        <i class="nav-icon bi bi-fuel-pump"></i>
                        <p>
                            {{ __('Fuel Inventory') }}
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('fuel.create') }}" class="nav-link {{ isActive('fuel.create')}}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>{{__('Add new')}}</p>
                            </a>
                        </li>
                        <li class="nav-item manage">
                            <a href="{{ route('fuel.index') }}" class="nav-link {{ isActive('fuel.index')}}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>{{__('Manage')}}</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item" id="fuelType">
                    <a href="{{ route('fuel-type-price.index') }}" class="nav-link {{ isActive('fuel-type-price.index') . isActive('fuel-type-price.create') }}">
                        <i class="nav-icon bi bi-tags-fill"></i>
                        <p>{{__("Todays Fuel Price")}}</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-clipboard-data-fill"></i>
                        <p>
                            {{ __('Sale Management') }}
                            <span class="nav-badge badge text-bg-secondary me-3">6</span>
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>{{__("Add new")}}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>{{__('Manage')}}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-list-check"></i>
                        <p>
                            {{ __("Pump Management") }}
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>{{ __("Add new") }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>{{__("Manage")}}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-arrows-move"></i>
                        <p>
                            {{ __("Shift Management") }}
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>{{ __('Add new') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>{{ __('Manage') }}</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-person-fill"></i>
                        <p>
                            {{ __("Employee Management") }}
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>{{ __("Add new") }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>{{ __("Manage") }}</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-graph-up-arrow"></i>
                        <p>
                            {{ __("Report & Analytics") }}
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>{{ __("Add new") }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>{{ __("Manage") }}</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-person-fill-add"></i>
                        <p>
                            {{ __("Customer Management") }}
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>{{ __("Add new") }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>{{ __("Manage") }}</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-truck"></i>
                        <p>
                            {{ __("Supplier Management") }}
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>{{ __("Add new") }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>{{ __("Manage") }}</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-credit-card"></i>
                        <p>
                            {{ __("Expense Management") }}
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>{{ __("Add new") }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>{{ __("Manage") }}</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-currency-dollar"></i>
                        <p>
                            {{ __("Tax Management") }}
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>{{ __("Add new") }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>{{ __("Manage") }}</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-header text-uppercase">{{__("System Operating")}}</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-gear-fill"></i>
                        <p>
                            {{ __("Settings") }}
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon bi bi-people-fill"></i>
                                <p>{{ __("Manage Users") }}</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon bi bi-person-fill-gear"></i>
                                <p>{{ __("Manage Permission") }}</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon bi bi-palette-fill"></i>
                                <p>{{ __("Web Appearance") }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon bi bi-database-fill"></i>
                                <p>{{ __("Database Backup") }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
