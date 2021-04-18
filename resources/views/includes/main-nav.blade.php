<nav id="main-nav" class="main-nav">
    <ul class="list list-horizontal main-nav__list">
        <li class="main-nav__item">
            <a class="main-nav-link" href="{{ route('home') }}">Home</a>
        </li>
        <li class="main-nav__item">
            <div id="categoriesDropdown" class="dropdown categories-dropdown main-nav-link">
                <ul id="categoriesDropdownContent" class="list dropdown__content categories__list" style="display: none">
                    @foreach ($categories as $category)
                        <li class="content__item">
                            <a class="link content__link" href="{{ route('category-books.show', ['id'=>$category->id])}}">
                                {{ $category->name }}
                            </a>
                            {{$category->name}}
                        </li>
                    @endforeach
                </ul>
                <div id="categoriesDropdownHeader" class="dropdown__header">
                    <div>                  
                        Categories
                    </div>
                    <div>
                        <img id="categoriesDropdownUpArrow" src="/storage/icons/downArrowWhite.svg"/>
                        <img id="categoriesDropdownDownArrow" src="/storage/icons/upArrowWhite.svg" style="display: none"/>
                    </div>
                </div>
            </div>
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
            <img id="userDropdownUpArrow" src="/storage/icons/downArrow.svg"/>
            <img id="userDropdownDownArrow" src="/storage/icons/upArrow.svg" style="display: none"/>
        @endauth
        
    </div>
</div>

@push('js-scripts')
    <script>
        const categoriesDropdownHeader = $('#categoriesDropdown #categoriesDropdownHeader');
        const categoriesDropdownContent = $('#categoriesDropdown #categoriesDropdownContent');
        const categoriesDropdownDownArrow = $('#categoriesDropdown #categoriesDropdownHeader #categoriesDropdownDownArrow')
        const categoriesDropdownUpArrow = $('#categoriesDropdown #categoriesDropdownHeader #categoriesDropdownUpArrow')
        
        const userDropdownHeader = $('#userDropdown #dropdownHeader');
        const userDropdownContent = $('#userDropdown #dropdownContent');
        const userDropdownUpArrow = $('#userDropdown #dropdownHeader #userDropdownUpArrow');
        const userDropdownDownArrow = $('#userDropdown #dropdownHeader #userDropdownDownArrow');

        userDropdownHeader.click(function() {
            toggleDropdownContent(userDropdownContent, userDropdownDownArrow, userDropdownUpArrow);
        });

        categoriesDropdownHeader.click(function() {
            toggleDropdownContent(categoriesDropdownContent, categoriesDropdownDownArrow, categoriesDropdownUpArrow)
        })

        $(document).on("click", function(event){
            if(!$(event.target).closest("#userDropdown").length){
                userDropdownContent.slideUp(null, function() {
                    userDropdownDownArrow.hide();
                    userDropdownUpArrow.show();
                });
            }

            if(!$(event.target).closest("#categoriesDropdown").length){
                categoriesDropdownContent.slideUp(null, function() {
                    categoriesDropdownDownArrow.hide();
                    categoriesDropdownUpArrow.show();
                });
            }
        });

        function toggleDropdownContent(dropdownContent, downArrow, upArrow) {
            dropdownContent.slideToggle(null, function() {
                downArrow.toggle();
                upArrow.toggle();
            });
        }

    </script>

@endpush