<header id="header" class="header">
  
    <a href="{{ route('home') }}" class="link link--logo logo">
        <img class="logo__img" src=""/>
        <span class="logo__text">Books Store</span>
    </a>
    <div class="search-bar">
        <input type="text" id="search" class="search-bar__input" placeholder="Search books">
        <button for="search" class="button button-primary search-bar__button">
            <img class="button__image" src="storage/icons/search.svg"/>
        </button>
    </div>
    <div></div>
    {{-- @auth
        <form method="post" action="{{ route('logout')}}">
            @csrf

            <button type="submit">Logout</button>
        </form>
    @endauth --}}
    
    {{-- <img src="{{ asset('storage/cover.svg') }}"/> --}}

    <cart-component></cart-component>


</header>

@push('vue-scripts')
    <script>
        new Vue({
            el: '#header',
            created() {
                console.log('vue instance created from header');
            },          
            
            data() {
                return {
                    message: "header vue data",
                }
            }
        });
    </script>
@endpush
