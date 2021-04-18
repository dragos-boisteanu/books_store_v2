<nav id="main-nav" class="main-nav">
    <ul class="list list-horizontal main-nav__list">
        <li class="main-nav__item">
            <a class="main-nav-link" href="{{ route('home') }}">Home</a>
        </li>
        <li class="main-nav__item">
            <a class="dropdown categories-dropdown main-nav-link">
                <ul class="list dropdown__content categories__list">
                    <li class="content__item">
                        <a class="link content__link" :href="'/categories/' + category.id">a</a>
                    </li>
                </ul>
                <div class="dropdown__header">
                    <div>                  
                        Categories
                    </div>
                    <div>
                        <img src="/storage/icons/downArrowWhite.svg"/>
                        <img src="/storage/icons/upArrowWhite.svg"/>
                    </div>
                </div>
            </a>
        </li>
        <li class="main-nav__item">
            <a class="main-nav-link" href="{{ route('home') }}">About</a>
        </li>
        <li class="main-nav__item">
            <a class="main-nav-link" href="{{ route('home') }}">Contact</a>
        </li>
    </ul>
</nav>

<div id="userDropdown" class="dropdown user-dropdown">
    @auth
        <ul id="dropdownContent" class="list dropdown__content">
            <li class="content__item">
                <a class="link content__link dashboard-link" href="{{ route('dashboard')}}">Dashboard</a>
            </li>
            <li class="content__item">
                <a class="link content__link" href="/account">Account</a>
            </li>
            <li class="content__item">
                <a class="link content__link" href="/account/addresses">Addresses</a>
            </li>
            <li class="content__item">
                <a class="link content__link" href="/account/orders">Orders</a>
            </li>
            <li class="content__item">
                <form method="POST" action="{{ route('logout')}}" class="menu-form">
                    @csrf
                    <button type="submit" class="button link content__link">Logout</button>
                </form>
            </li>
        </ul>     
    @endauth
    
    <div id="dropdownHeader" class="dropdown__header">
        <div>
            @auth
                {{ Auth::user()->first_name }}
            @endauth
            
            @guest
                <a href="{{ route('login')}}">Login</a>
            @endguest
        
        </div>
       
        @auth
            <img id="upArrow" src="/storage/icons/downArrow.svg"/>
            <img id="downArrow" src="/storage/icons/upArrow.svg" style="display: none"/>
        @endauth
        
    </div>
</div>

@push('js-scripts')
    <script>

        const categoriesList = $('#categoriesList');
      
        const dropdownHeader = $('#dropdownHeader');
        const dropdownContent = $('#dropdownContent');
        const upArrow = $('#upArrow');
        const downArrow = $('#downArrow');

        dropdownHeader.click(function() {
            toggleDropdown();
        });

        $(document).on("click", function(event){
            if(!$(event.target).closest("#userDropdown").length){
                dropdownContent.slideUp(null, function() {
                downArrow.hide();
                upArrow.show();
            });
            }
        });

        function toggleDropdown() {
            dropdownContent.slideToggle(null, function() {
                downArrow.hide();
                upArrow.show();
            });
        }




    </script>

@endpush