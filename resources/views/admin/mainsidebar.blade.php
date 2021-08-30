
    <div class="sidebar text-sm nav-flat">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image align-middle" style="margin-top: auto; margin-bottom: auto;">
                <img src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->name }}" style="width:54px; height: 54px;" class="align-middle rounded-circle elevation-1">
            </div>
            <div class="info" style="display: grid;">
                <a href="{{ route('profile.show') }}" class="d-block"><strong>{{ request()->user()->fullname() }}</strong></a>
                @php

                    $user_role_names = auth()->user()->getRoleNames();
                    $display_role = "";
                    if(auth()->user()->hasRole('super-admin')){
                        $display_role = 'Super-Admin';
                    }
                    else{
                        if(auth()->user()->hasRole('channel-admin')){
                            $display_role .= 'Channel-Admin ';
                        }
                        if(auth()->user()->hasRole('system-admin')){
                            $display_role .= 'System-Admin ';
                        }
                    }

                @endphp
                <small calss="align-middle text-xs" style="color: #c2c7d0;">{{ $display_role }}</small>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2 ">
            <ul class="nav nav-child-indent nav-compact nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->

                {{-- @if (auth()->user()->isSuperAdmin())
                @canany(['system_user', 'system_setting', 'manage_agent_subscription'])
                <li class="nav-header">SYSTEM SETTINGS</li>
                <li class="nav-item
                    {{ request()->is('admin/system_configs/currencies*') ? 'menu-open' : '' }}
                    {{ request()->is('admin/system_configs/book-format*') ? 'menu-open' : '' }}
                    {{ request()->is('admin/system_configs/book-type*') ? 'menu-open' : '' }}
                    {{ request()->is('admin/system_configs/book-language*') ? 'menu-open' : '' }}
                    {{ request()->is('admin/system_configs/currency*') ? 'menu-open' : '' }}
                    {{ request()->is('admin/system_configs/book-royalt*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link
                        {{ request()->is('admin/system_configs/currencies*') ? 'active' : '' }}
                        {{ request()->is('admin/system_configs/book-format*') ? 'active' : '' }}
                        {{ request()->is('admin/system_configs/book-type*') ? 'active' : '' }}
                        {{ request()->is('admin/system_configs/book-language*') ? 'active' : '' }}
                        {{ request()->is('admin/system_configs/currency*') ? 'active' : '' }}
                        {{ request()->is('admin/system_configs/book-royalt*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            General Settings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('admin.system_configs.currencies.index') }}"
                                class="nav-link {{ request()->is('admin/system_configs/currencies*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Price Currencies</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.system_configs.bookformat.index') }}"
                                class="nav-link {{ request()->is('admin/system_configs/book-format*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Book Formats</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.system_configs.booklanguage.index') }}"
                                class="nav-link {{ request()->is('admin/system_configs/book-language*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Book Languages</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.system_configs.booktype.index') }}"
                                class="nav-link {{ request()->is('admin/system_configs/book-type*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Book Types</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.system_configs.bookroyalty.index') }}"
                                class="nav-link {{ request()->is('admin/system_configs/book-royalt*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Book Royalties</p>
                            </a>
                        </li>
                    </ul>

                </li>
                @endcanany
                @endif --}}

                @if (auth()->user()->isSuperAdmin() || auth()->user()->isSystemAdmin() || auth()->user()->isChannelAdmin())
                <li class="nav-header">MANAGEMENT</li>
                @canany(['system_user'])
                <li class="nav-item">
                    <a href="{{ route('admin.manage.user.index') }}" class="nav-link {{ request()->is('admin/manage/users*') ? 'active' : '' }}">
                        <i class="nav-icon far fa-user"></i>
                        <p class="text">User Accounts</p>
                    </a>
                </li>
                @endcanany
                @canany(['system_gize_channels'])
                <li class="nav-item">
                    <a href="{{ route('admin.manage.gize_channel.index') }}" class="nav-link {{ request()->is('admin/manage/gize_channel*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-solid fa-bullhorn"></i>
                        <p class="text">All Gize Channels</p>
                    </a>
                </li>
                @endcanany
                @canany([
                    'manage_channel',
                    'manage_batch',
                    'manage_subscription',
                    'manage_schedule',
                ])
                <li class="nav-header">CHANNELS</li>

                <li class="nav-item
                    {{ request()->is('admin/manage/*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link
                        {{ request()->is('admin/manage/gize-channel*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-solid fa-bullhorn"></i>
                        <p>
                            ADDMES CHANNEL
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview ">

                        {{-- <li class="nav-item">
                            <a href=""
                                class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Edit Channel </p>
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="{{ route('admin.manage.channelvideo.index') }}"
                                class="nav-link {{ request()->is('admin/manage/channelvideos/channelvideo*') ? 'active' : '' }}">
                                <i class="far fa fa-video nav-icon"></i>
                                <p>Videos </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.manage.batch.index') }}"
                                class="nav-link  {{
                                request()->is('admin/manage/batches') ||
                                request()->is('admin/manage/batches/create') ||
                                request()->is('admin/manage/batches/edit/*')
                                ? 'active' : '' }}">
                                <i class="nav-icon fa fa-users"></i>
                                <p>Batches </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.manage.batch.subscription.index') }}"
                                class="nav-link  {{ request()->is('admin/manage/batches/subscriptions*') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-users"></i>
                                <p>Subscriptions </p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href=""
                                class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Subscription Periods</p>
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a href=""
                                class="nav-link ">
                                <i class="far fa fa-calendar nav-icon"></i>
                                <p>Schedule Calendar </p>
                            </a>
                        </li>

                         </ul>

                </li>
                @endcanany
                @endif

                <li class="nav-header">MY ACCOUNT</li>
                <li class="nav-item">
                    <a href="{{ route('profile.show') }}" class="nav-link">
                        <i class="nav-icon far fa-id-card"></i>
                        <p class="text">My Proile</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link">
                        <i class="nav-icon far fa fa-sign-out-alt"></i>
                        <p class="text">Logout</p>
                    </a>
                </li>



                {{-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-circle text-info"></i>
                        <p>Informational</p>
                    </a>
                </li> --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
