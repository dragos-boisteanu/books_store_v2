const CategoriesDropdown = {

    template:

    `
        <a class="dropdown categories-dropdown main-nav-link" v-click-outside="closeDropdown" @click="toggleContent">
            <ul class="list dropdown__content categories__list" v-if="displayContent">
                <li class="content__item" v-for="category in categories">
                    <a class="link content__link" :href="'/categories/' + category.id">{{category.name}}</a>
                </li>
            </ul>
            <div class="dropdown__header">
                <div>                  
                    Categories
                </div>
                <div>
                    <img src="/storage/icons/downArrowWhite.svg" v-if="displayDownArrow" />
                    <img src="/storage/icons/upArrowWhite.svg" v-else />
                </div>
            </div>
        </a>
     
    `,

    data() {
        return {
            categories: [],
            displayContent: false,
            displayDownArrow: true
            
        }
    },

    created() {
        this.getCategories();
    },

    methods: {
        toggleContent() {
            this.displayContent = !this.displayContent;
            this.displayDownArrow = !this.displayDownArrow;
        },

        closeDropdown() {
            this.displayContent = false;
            this.displayDownArrow = true;           
        },

        getCategories() {
            axios.get('/api/categories')
            .then ( response => {
                this.categories = response.data;
            })
            .catch( error => {
                console.error( error );
            })
        }
    }
}

export default CategoriesDropdown;