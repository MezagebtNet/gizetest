<div class="sidebar text-sm nav-flat">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image align-middle" style="margin-top: auto; margin-bottom: auto;">
            <img src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->name }}"
                style="width:54px; height: 54px;" class="align-middle rounded-circle elevation-1">
        </div>
        <div class="info" style="display: grid;">
            <a href="{{ route('profile.show') }}"
                class="d-block"><strong>{{ request()->user()->fullname() }}</strong></a>
            @php

                $user_role_names = auth()
                    ->user()
                    ->getRoleNames();
                $display_role = '';
                if (
                    auth()
                        ->user()
                        ->hasRole('super-admin')
                ) {
                    $display_role = 'Super-Admin';
                } else {
                    if (
                        auth()
                            ->user()
                            ->hasRole('channel-admin')
                    ) {
                        $display_role .= 'Channel-Admin ';
                    }
                    if (
                        auth()
                            ->user()
                            ->hasRole('system-admin')
                    ) {
                        $display_role .= 'System-Admin ';
                    }
                }

            @endphp
            <small calss="align-middle text-xs" style="color: #c2c7d0;">{{ $display_role }}</small>
        </div>
    </div>


    <!-- Sidebar Menu -->
    <nav class="mt-2 ">
        <ul class="nav nav-child-indent nav-compact nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->

            {{-- @if (auth()->user()->isSuperAdmin())
                @canany(['system_user', 'system_setting', 'manage_agent_subscription'])
                <li class="nav-header">SYSTEM SETTINGS</li>
                <li class="nav-item
                    {{ request()->is('*admin/system_configs/currencies*') ? 'menu-open' : '' }}
                    {{ request()->is('*admin/system_configs/book-format*') ? 'menu-open' : '' }}
                    {{ request()->is('*admin/system_configs/book-type*') ? 'menu-open' : '' }}
                    {{ request()->is('*admin/system_configs/book-language*') ? 'menu-open' : '' }}
                    {{ request()->is('*admin/system_configs/currency*') ? 'menu-open' : '' }}
                    {{ request()->is('*admin/system_configs/book-royalt*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link
                        {{ request()->is('*admin/system_configs/currencies*') ? 'active' : '' }}
                        {{ request()->is('*admin/system_configs/book-format*') ? 'active' : '' }}
                        {{ request()->is('*admin/system_configs/book-type*') ? 'active' : '' }}
                        {{ request()->is('*admin/system_configs/book-language*') ? 'active' : '' }}
                        {{ request()->is('*admin/system_configs/currency*') ? 'active' : '' }}
                        {{ request()->is('*admin/system_configs/book-royalt*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            General Settings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('admin.system_configs.currencies.index') }}"
                                class="nav-link {{ request()->is('*admin/system_configs/currencies*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Price Currencies</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.system_configs.bookformat.index') }}"
                                class="nav-link {{ request()->is('*admin/system_configs/book-format*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Book Formats</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.system_configs.booklanguage.index') }}"
                                class="nav-link {{ request()->is('*admin/system_configs/book-language*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Book Languages</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.system_configs.booktype.index') }}"
                                class="nav-link {{ request()->is('*admin/system_configs/book-type*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Book Types</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.system_configs.bookroyalty.index') }}"
                                class="nav-link {{ request()->is('*admin/system_configs/book-royalt*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Book Royalties</p>
                            </a>
                        </li>
                    </ul>

                </li>
                @endcanany
                @endif --}}

            @if (auth()->user()->isSuperAdmin() ||
                auth()->user()->isSystemAdmin() ||
                auth()->user()->isChannelAdmin())
                @if(!auth()->user()->isChannelAdmin())<li class="nav-header">{{ __('MANAGEMENT') }}</li>@endif
                @canany(['system_user'])
                    <li class="nav-item">
                        <a href="{{ route('admin.manage.user.index') }}"
                            class="nav-link {{ request()->is('*admin/manage/users*') ? 'active' : '' }}">
                            <i class="nav-icon fa fa-user-cog"></i>
                            <p class="text">{{ __('User Accounts') }}</p>
                        </a>
                    </li>
                @endcanany
                @canany(['system_gize_channels'])
                    <li class="nav-item">
                        <a href="{{ route('admin.manage.gize_channel.index') }}"
                            class="nav-link {{ request()->is('*admin/manage/gize_channel*') ? 'active' : '' }}">
                            <i class="nav-icon fa fa-solid fa-bullhorn"></i>
                            <p class="text">{{ __('All Gize Channels') }}</p>
                        </a>
                    </li>
                @endcanany
                @canany(['manage_channel', 'manage_batch', 'manage_subscription', 'manage_schedule'])
                    @php
                        if(auth()->user()->hasRole('super-admin')){
                            $user_channels = auth()->user()->all_gize_channels();
                        }
                        else {
                            $user_channels = auth()->user()->gize_channels()->get();
                        }
                        // dd($user_channels);
                    @endphp
                    @if($user_channels->count() > 0)
                        <li class="nav-header">{{ __('CHANNELS') }}</li>
                    @endif
                    {{-- List of Channels the user can manage... --}}
                    @foreach ($user_channels as $channel)
                    {{-- {{ dd( $channel ) }} --}}
                    <li class="nav-item {{ request()->is('*admin/manage/batches*' . $channel->id . '*') || request()->is('*admin/manage/channelvideos*' . $channel->id . '*') ? 'menu-open' : '' }}">
                            <a href="#"
                                class="nav-link {{ request()->is('*admin/manage/batches*' . $channel->id . '*') || request()->is('*admin/manage/channelvideos*' . $channel->id . '*') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-solid fa-tv"></i>
                                <p>
                                    {{ strtoupper($channel->name_en) }}
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
                                    <a href="{{ route('admin.manage.channelvideo.index', $channel->id) }}"
                                        class="nav-link {{ request()->is('*admin/manage/channelvideos/'. $channel->id .'*') ? 'active' : '' }}">
                                        <i class="far fa fa-film nav-icon"></i>
                                        <p>{{ __('Videos') }} </p>
                                    </a>
                                </li>
                                @if($channel->producer != null || $channel->producer != '')
                                <li class="nav-item">
                                    <a href="{{ route('admin.manage.batch.index', $channel->id) }}"
                                        class="nav-link  {{ request()->is('*admin/manage/batches/'. $channel->id .'*') || request()->is('*admin/manage/batches/'. $channel->id .'/create') || request()->is('*admin/manage/batches/'. $channel->id .'/edit/*') ? 'active' : '' }}">
                                        <i class="nav-icon fa fa-users-cog"></i>
                                        <p>{{ __('Batches') }} </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.manage.batch.subscription.index', $channel->id) }}"
                                        class="nav-link {{ request()->is('*admin/manage/batches/subscriptions/'. $channel->id .'*') ? 'active' : '' }}">
                                        <i class="nav-icon fa fa-user-check"></i>
                                        <p>{{ __('Subscriptions') }} </p>
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
                                    <a href="{{ route('admin.manage.batch.schedule.index', $channel->id) }}"
                                        class="nav-link {{ request()->is('*admin/manage/batches/schedules/'. $channel->id .'*') ? 'active' : '' }}">
                                        <i class="far fa fa-calendar-alt nav-icon"></i>
                                        <p>{{ __('Schedule Calendar') }} </p>
                                    </a>
                                </li>
                                @endif

                            </ul>

                        </li>
                    @endforeach

                @endcanany
            @endif

            <li class="nav-header">{{ __('MY ACCOUNT') }}</li>
            <li class="nav-item">
                <a href="{{ route('profile.show') }}" class="nav-link">
                    <i class="nav-icon far fa-id-card"></i>
                    <p class="text">{{ __('My Proile') }}</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link">
                    <i class="nav-icon far fa fa-sign-out-alt"></i>
                    <p class="text">{{ __('Logout') }}</p>
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
