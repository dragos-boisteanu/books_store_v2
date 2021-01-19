<nav class="side-nav">
    <ul class="list side-nav__list">
        <li class="side-nav__item">
            <a class="item__link @if(Route::is('admin-books.*')) item__link--selected @endif" href="{{ route('admin-books.index') }}">Books</a>
        </li>
        <li class="side-nav__item">
            <a class="item__link @if(Route::is('admin-orders.*')) item__link--selected @endif" href="{{ route('admin-orders.index') }}">Orders</a>
        </li>
        @if ( Auth::user()->role_id === 2)
            <li class="side-nav__item">
                <a class="item__link @if(Route::is('admin-users.*')) item__link--selected @endif" href="{{ route('admin-users.index') }}">Users</a>
            </li>
        @endif
        <li class="side-nav__item">
            <a class="item__link @if(Route::is('admin-authors.*')) item__link--selected @endif" href="{{ route('admin-authors.index') }}">Authors</a>
        </li>
        <li class="side-nav__item">
            <a class="item__link @if(Route::is('admin-categories.*')) item__link--selected @endif" href="{{ route('admin-categories.index') }}">Categories</a>
        </li>

    </ul>
</nav>