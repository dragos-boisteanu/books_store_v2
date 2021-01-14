<nav class="side-nav">
    <ul class="list side-nav__list">
        <li class="side-nav__item">
            <a class="item__link @if(Route::currentRouteName() == 'client-user.show') item__link--selected @endif" href="{{ route('client-user.show') }}">Account</a>
        </li>
        <li class="side-nav__item">
            <a class="item__link @if(Route::is('client-addresses.*')) item__link--selected @endif" href="{{ route('client-addresses.index') }}">Addresses</a>
        </li>
        <li class="side-nav__item">
            <a class="item__link @if(Route::is('client-orders.*')) item__link--selected @endif" href="{{ route('client-orders.index') }}">Orders</a>
        </li>
    </ul>
</nav>