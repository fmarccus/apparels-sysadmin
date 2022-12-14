<nav x-data="{ open: false }" class=" border-b border-gray-100" style="background-color:#F4C7BD;">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-jet-application-mark class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">

                    <x-jet-nav-link class="text-decoration-none" href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        {{ __('Home') }}
                    </x-jet-nav-link>

                    @if(Auth::user()->userType == 0)
                    <x-jet-nav-link href="{{route('apparel.basic_data')}}" :active="request()->routeIs('apparel.basic_data')" class="text-decoration-none">
                        {{ __('Dashboard') }}
                    </x-jet-nav-link>
                    <x-jet-nav-link href="{{ route('apparel.index') }}" :active="request()->routeIs('apparel.index') || request()->routeIs('apparel.create') || request()->routeIs('apparel.edit')" class="text-decoration-none">
                        {{ __('Inventory') }}
                    </x-jet-nav-link>
                    <x-jet-nav-link href="{{ route('apparel.orders') }}" :active="request()->routeIs('apparel.orders') || request()->routeIs('apparel.order_details')" class="text-decoration-none">
                        {{ __('Pending Orders') }}
                    </x-jet-nav-link>
                    <x-jet-nav-link href="{{route('apparel.sales_history')}}" :active="request()->routeIs('apparel.sales_history')" class="text-decoration-none">
                        {{ __('Sales History') }}
                    </x-jet-nav-link>
                    <x-jet-nav-link href="{{ route('apparel.users') }}" :active="request()->routeIs('apparel.users')" class="text-decoration-none">
                        {{ __('Manage Users') }}
                    </x-jet-nav-link>
                    <x-jet-nav-link href="{{route('messages.index')}}" :active="request()->routeIs('messages.index')" class="text-decoration-none">
                        {{ __('Messages') }}
                    </x-jet-nav-link>
                    <x-jet-nav-link href="/admin/user-activity" class="text-decoration-none">
                        {{ __('User Logs') }}
                    </x-jet-nav-link>



                    @elseif(Auth::user()->userType == 1)
                    <x-jet-nav-link class="text-decoration-none" href="{{ route('shop.index') }}" :active="request()->routeIs('shop.index') ||request()->routeIs('shop.addtocart')">
                        {{ __('Apparels') }}
                    </x-jet-nav-link>
                    <x-jet-nav-link class="text-decoration-none" href="{{ route('shop.cart') }}" :active="request()->routeIs('shop.cart')">
                        {{ __('Cart') }}
                    </x-jet-nav-link>
                    <x-jet-nav-link class="text-decoration-none" href="{{ route('shop.completed_orders') }}" :active="request()->routeIs('shop.completed_orders')">
                        {{ __('Completed Orders') }}
                    </x-jet-nav-link>

                    @else



                    <x-jet-nav-link href="{{ route('apparel.orders') }}" :active="request()->routeIs('apparel.orders') || request()->routeIs('apparel.order_details')" class="text-decoration-none">
                        {{ __('Pending Orders') }}
                    </x-jet-nav-link>
                    @endif

                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                <div class="ml-3 relative">
                    <x-jet-dropdown align="right" width="60">
                        <x-slot name="trigger">
                            <span class="inline-flex rounded-md">
                                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition">
                                    {{ Auth::user()->currentTeam->name }}

                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </span>
                        </x-slot>

                        <x-slot name="content">
                            <div class="w-60">
                                <!-- Team Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Manage Team') }}
                                </div>

                                <!-- Team Settings -->
                                <x-jet-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                    {{ __('Team Settings') }}
                                </x-jet-dropdown-link>

                                @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                <x-jet-dropdown-link href="{{ route('teams.create') }}">
                                    {{ __('Create New Team') }}
                                </x-jet-dropdown-link>
                                @endcan

                                <div class="border-t border-gray-100"></div>

                                <!-- Team Switcher -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Switch Teams') }}
                                </div>

                                @foreach (Auth::user()->allTeams() as $team)
                                <x-jet-switchable-team :team="$team" />
                                @endforeach
                            </div>
                        </x-slot>
                    </x-jet-dropdown>
                </div>
                @endif

                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </button>
                            @else
                            <span class="inline-flex rounded-md">
                                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                    {{ Auth::user()->name }}

                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-jet-dropdown-link class="text-decoration-none" href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-jet-dropdown-link>
                            @if(Auth::user()->userType == 1)
                            <x-jet-dropdown-link href="{{ route('messages.create') }}" :active="request()->routeIs('messages.create')" class="text-decoration-none">
                                {{ __('Contact Us') }}
                            </x-jet-dropdown-link>
                            @elseif(Auth::user()->userType == 0)
                            <x-jet-dropdown-link href="{{ route('apparel.documentindex') }}" :active="request()->routeIs('messages.create')" class="text-decoration-none">
                                {{ __('Documents') }}
                            </x-jet-dropdown-link>
                            @endif
                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                {{ __('API Tokens') }}
                            </x-jet-dropdown-link>
                            @endif

                            <div class="border-t border-gray-100"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-jet-dropdown-link class="text-decoration-none" href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-jet-dropdown-link>
                            </form>
                        </x-slot>
                    </x-jet-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-jet-responsive-nav-link class="text-decoration-none" href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Home') }}
            </x-jet-responsive-nav-link>

            @if(Auth::user()->userType == 0)
            <x-jet-responsive-nav-link href="{{route('apparel.basic_data')}}" :active="request()->routeIs('apparel.basic_data')" class="text-decoration-none">
                {{ __('Dashboard') }}
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{ route('apparel.index') }}" :active="request()->routeIs('apparel.index') || request()->routeIs('apparel.create') || request()->routeIs('apparel.edit')" class="text-decoration-none">
                {{ __('Inventory') }}
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{ route('apparel.orders') }}" :active="request()->routeIs('apparel.orders') || request()->routeIs('apparel.order_details')" class="text-decoration-none">
                {{ __('Pending Orders') }}
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{route('apparel.sales_history')}}" :active="request()->routeIs('apparel.sales_history')" class="text-decoration-none">
                {{ __('Sales History') }}
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{ route('apparel.users') }}" :active="request()->routeIs('apparel.users')" class="text-decoration-none">
                {{ __('Manage Users') }}
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{route('messages.index')}}" :active="request()->routeIs('messages.index')" class="text-decoration-none">
                {{ __('Messages') }}
            </x-jet-responsive-nav-link>

            @elseif(Auth::user()->userType == 1)
            <x-jet-responsive-nav-link class="text-decoration-none" href="{{ route('shop.index') }}" :active="request()->routeIs('shop.index') ||request()->routeIs('shop.addtocart') ">
                {{ __('Apparels') }}
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link class="text-decoration-none" href="{{ route('shop.cart') }}" :active="request()->routeIs('shop.cart')">
                {{ __('Cart') }}
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link class="text-decoration-none" href="{{ route('shop.completed_orders') }}" :active="request()->routeIs('shop.completed_orders')">
                {{ __('Completed Orders') }}
            </x-jet-responsive-nav-link>



            @else
            <x-jet-responsive-nav-link href="{{ route('apparel.orders') }}" :active="request()->routeIs('apparel.orders') || request()->routeIs('apparel.order_details')" class="text-decoration-none">
                {{ __('Pending Orders') }}
            </x-jet-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <div class="shrink-0 mr-3">
                    <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')" class="text-decoration-none">
                    {{ __('Profile') }}
                </x-jet-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                    {{ __('API Tokens') }}
                </x-jet-responsive-nav-link>
                @endif
                @if(Auth::user()->userType == 1)
                <x-jet-responsive-nav-link href="{{ route('messages.create') }}" :active="request()->routeIs('messages.create')" class="text-decoration-none">
                    {{ __('Contact Us') }}
                </x-jet-responsive-nav-link>
                @endif
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-jet-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();" class="text-decoration-none">
                        {{ __('Log Out') }}
                    </x-jet-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                <div class="border-t border-gray-200"></div>

                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Manage Team') }}
                </div>

                <!-- Team Settings -->
                <x-jet-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                    {{ __('Team Settings') }}
                </x-jet-responsive-nav-link>

                @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                <x-jet-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                    {{ __('Create New Team') }}
                </x-jet-responsive-nav-link>
                @endcan

                <div class="border-t border-gray-200"></div>

                <!-- Team Switcher -->
                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Switch Teams') }}
                </div>

                @foreach (Auth::user()->allTeams() as $team)
                <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link" />
                @endforeach
                @endif
            </div>
        </div>
    </div>
</nav>