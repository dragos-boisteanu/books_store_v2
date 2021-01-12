<nav id="main-nav" class="main-nav">
    <ul class="list list-horizontal main-nav__list">
        <li class="main-nav__item">
            <a class="main-nav-link" href="{{ route('home') }}">Home</a>
        </li>
        <li class="main-nav__item">
           <categories-dropdown-component></categories-dropdown-component>
        </li>
        <li class="main-nav__item">
            <a class="main-nav-link" href="{{ route('home') }}">About</a>
        </li>
        <li class="main-nav__item">
            <a class="main-nav-link" href="{{ route('home') }}">Contact</a>
        </li>
    </ul>
</nav>

@push('vue-scripts')
    <script>
        new Vue({
            el: '#main-nav',
        })
    </script>
@endpush