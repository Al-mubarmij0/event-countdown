<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container-fluid">
        <!-- Toggler for small screens -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links and Dropdown -->
        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- Home Link for Regular Users -->
                <li class="nav-item">
                    <a class="nav-link text-white fw-bold {{ request()->routeIs('dashboard') ? 'text-warning' : '' }}" href="{{ route('dashboard') }}">
                        {{ __('Home') }}
                    </a>
                </li>

                <!-- My Events Link for Regular Users -->
                <li class="nav-item">
                    <a class="nav-link text-white fw-bold {{ request()->routeIs('events.my') ? 'text-warning' : '' }}" href="{{ route('events.my') }}">
                        {{ __('My Events') }}
                    </a>
                </li>

                <!-- Create Event Link for Regular Users -->
                <li class="nav-item">
                    <a class="nav-link text-white fw-bold {{ request()->routeIs('events.create') ? 'text-warning' : '' }}" href="{{ route('events.create') }}">
                        {{ __('Create Event') }}
                    </a>
                </li>

                <!-- Events Calendar Link for Regular Users -->
                <li class="nav-item">
                    <a class="nav-link text-white fw-bold {{ request()->routeIs('events.calendar') ? 'text-warning' : '' }}" href="{{ route('events.calendar') }}">
                        {{ __('Events Calendar') }}
                    </a>
                </li>

                <!-- Admin Links (Only visible for admins) -->
                @if(auth()->user()->role == 'admin')
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold {{ request()->routeIs('admin.dashboard') ? 'text-warning' : '' }}" href="{{ route('admin.dashboard') }}">
                            {{ __('Dashboard') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold {{ request()->routeIs('admin.events') ? 'text-warning' : '' }}" href="{{ route('admin.events') }}">
                            {{ __('Manage Events') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold {{ request()->routeIs('admin.users') ? 'text-warning' : '' }}" href="{{ route('admin.users') }}">
                            {{ __('Manage Users') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold {{ request()->routeIs('admin.settings') ? 'text-warning' : '' }}" href="{{ route('admin.settings') }}">
                            {{ __('Settings') }}
                        </a>
                    </li>
                @endif
            </ul>

            <!-- User Dropdown -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white fw-semibold" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item" type="submit">{{ __('Log Out') }}</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
