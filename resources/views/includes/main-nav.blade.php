<nav class="main-nav">
    <ul class="list list-horizontal main-nav__list">
        <li class="main-nav__item">
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="main-nav__item">
            <a class="categories-dropdown">
               <div class="categories-dropdown__header">
                    <div class="text">Categories</div>   
                    <div class="arrows">
                    </div>
               </div>
               {{-- <ul class="list list-horizontal categories-dropdown__content">
               </ul> --}}
            </a>
        </li>
        <li class="main-nav__item">
            <a href="{{ route('home') }}">About</a>
        </li>
        <li class="main-nav__item">
            <a href="{{ route('home') }}">Contact</a>
        </li>
    </ul>
</nav>

@push('vue-scripts')
    <script>
        const categoriesList = document.getElementsByClassName('categories-dropdown__content')[0];
        
        axios.get('/api/categories')
        .then( response => {
            response.data.forEach(category => {
                const li = document.createElement("li"); 
                li.innerHTML = `<a href="/category/${category.id}">${category.name}</a>`;
                li.classList.add('category');
                categoriesList.appendChild(li);
            });
        })
        .catch( error => {
            console.error(error)
        })
    </script>
@endpush