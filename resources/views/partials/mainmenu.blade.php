<nav>
    <ul>
        <li class="{{ request()->is('packages') ? 'active' : '' }}"><a href="/packages">Display Parcels</a></li>
        <li class="{{ request()->is('amazon-invoice') ? 'active' : '' }}"><a href="/amazon-invoice">Import Amazon Parcels</a></li>
        <li class="{{ request()->is('packages/create') ? 'active' : '' }}"><a href="/packages/create">Enter New Parcel</a></li>

        <li class="{{ request()->is('show-export-links') ? 'active' : '' }}"><a href="/show-export-links">Export Receipts</a></li>

        @if(Auth::check() && Auth::user()->hasRole('admin'))
            <li><a href="/status-names/edit">Edit Package Status Names</a></li>
        @endif
        @if(Auth::check())
            <li  class="{{ request()->is('profile') ? 'active' : '' }}"><a href="/profile">{{ Auth::user()->name }}</a></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                        Logout
                    </a>
                </form>
            </li>
        @else
            <li class="{{ request()->is('login') ? 'active' : '' }}"><a href="/login">Login</a></li>
            <li class="{{ request()->is('register') ? 'active' : '' }}"><a href="/register">Register</a></li>
        @endif
    </ul>
</nav>



