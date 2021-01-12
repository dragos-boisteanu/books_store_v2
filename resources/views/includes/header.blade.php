<header id="header" class="header">
    <a href="{{ route('home') }}" class="link link--logo logo">
        <img class="logo__img" src=""/>
        <span class="logo__text">Books Store</span>
    </a>
    <div class="search-bar">
        <form method="GET" action="{{ route('search') }}" class="search-bar__form">
            <input type="text" id="search" class="search-bar__input" :class="{'search-bar--results' : showResults}" placeholder="Search books" name="q" v-model.tirm="searchInput" @keyup="search">
            <button for="search" class="button button-primary search-bar__button">
                <img class="button__image" src="storage/icons/search.svg"/>
            </button>
        </form>
        <ul class="list search-bar__results" v-if="showResults" v-click-outside="closeResults"> 
            <li v-for="(result, index) in searchResults" :key="index" class="result">
                <div class="title__authors">
                    <a class="link result__title" :href="`/books/` + result.id">@{{ result.title }}</a>
                    <ul class="list list-horizontal">
                        <li class="result__author" v-for="(author, index) in result.authors" :key="index">
                           <a class="link" :href="'/authors/' + author.id">@{{author.name}}</a>
                        </li>
                    </ul>
                </div>
                <div class="result__price">
                    @{{result.price}} RON
                </div>
            </li>
        </ul>
    </div>
    <a></a>
    <cart-component></cart-component>
</header>

@push('vue-scripts')
    <script>
        new Vue({
            el: '#header',

            created() {
                console.log('vue instance created from header');
            },          
            
            computed: {
                showResults() {
                    return this.searchResults.length > 0 ? true : false
                }
            },

            data() {
                return {
                    message: "header vue data",
                    searchResults: [],
                    searchInput: '',
                }
            },
            
            methods: {
                search() {
                    if(this.searchInput.length >= 3) {
                        axios.get('/api/search', {
                            params: {
                                q: this.searchInput
                            }
                        })
                        .then( response => {
                            this.searchResults = response.data;    
                        })
                        .catch( error => {
                            console.error( error )
                        })
                    }
                },

                closeResults() {
                    this.searchResults.splice(0)
                }
            }
            
        });
    </script>
@endpush
