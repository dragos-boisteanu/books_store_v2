<nav class="side-nav">
    <ul class="list side-nav__list">
        <li class="side-nav__item">
            <div class="item__link @if(Route::is('admin-books.*')) item__link--selected @endif">Books</div>
            <ul class="item__sub-menu">
                <li>
                    <a class="item__link @if(Route::is('admin-books.index')) item__link--selected @endif" href="{{ route('admin-books.index') }}">List</a>
                </li>
                <li>
                    <a class="item__link @if(Route::is('admin-books.create')) item__link--selected @endif" href="{{ route('admin-books.create') }}">Create</a>
                </li>
            </ul>
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
            <div class="item__link @if(Route::is('admin-authors.*')) item__link--selected @endif">Authors</div>
            <ul class="item__sub-menu">
                <li>
                    <a class="item__link @if(Route::is('admin-authors.index')) item__link--selected @endif" href="{{ route('admin-authors.index') }}">List</a>
                </li>
                <li>
                    <a class="item__link @if(Route::is('admin-authors.create')) item__link--selected @endif" href="{{ route('admin-authors.create') }}">Create</a>
                </li>
            </ul>
        </li>
        <li class="side-nav__item">
            <div class="item__link">Publishers</div>
            <ul class="item__sub-menu">
                <li>
                    <a class="item__link" href="/dashboard">List</a>
                </li>
                <li>
                    <a class="item__link" href="/dashboard">Create</a>
                </li>
            </ul>
        </li>
        <li class="side-nav__item">
            <div class="item__link @if(Route::is('admin-categories.*')) item__link--selected @endif">Categories</div>
            <ul class="item__sub-menu">
                <li>
                    <a class="item__link @if(Route::is('admin-categories.index')) item__link--selected @endif" href="{{ route('admin-categories.index') }}">List</a>
                </li>
                <li>
                    <a class="item__link @if(Route::is('admin-categories.create')) item__link--selected @endif" href="{{ route('admin-categories.create') }}">Create</a>
                </li>
            </ul>
        </li>
        <li class="side-nav__item">
            <div class="item__link @if(Route::is('admin-languages.*')) item__link--selected @endif">Languages</div>
            <ul class="item__sub-menu">
                <li>
                    <a class="item__link" href="/dashboard">List</a>
                </li>
                <li>
                    <a class="item__link" href="/dashboard">Create</a>
                </li>
            </ul>
        </li>
        <li class="side-nav__item">
            <div class="item__link">Statuses</div>
            <ul class="item__sub-menu">
                <li>
                    <a class="item__link" href="/dashboard">List</a>
                </li>
                <li>
                    <a class="item__link" href="/dashboard">Create</a>
                </li>
            </ul>
        </li>
    </ul>
</nav>