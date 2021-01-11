const CartComponent = {
    template: 
    `
        <div class="cart" :class="{'cart--active' : showCart}">
            <div v-if="showCart" class="cart__content">
                <div class="cart__header">
                    <div>
                        Shopping cart 
                    </div>
                    <button @click="toggleCart" class="button">
                        <img src="storage/icons/close.svg"/>
                    </button>
                </div>
                <ul class="items__list">
                    <li v-for="(book,index) in items" :key="index" class="item">
                        <a :href="'/books/' + book.id" class="link title">{{ book.title }}</a>
                        <div class="quantity">
                            <span class="divider">x</span>
                            <span class="value">{{ book.quantity }} buc.</span>
                        </div>
                        <div class="price">{{ book.finalPrice }} RON</div>
                        <button @click="removeFromCart(book.id)" class="button">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="red" width="18px" height="18px"><path d="M0 0h24v24H0z" fill="none"/>
                                <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                            </svg>
                        </button>
                    </li>
                </ul>
                <form method="GET" action="/orders/create" class="order-form">
                    <button type="submit" class="button button-primary cart__button-order">Place order</button>
                </form>
            </div>
            <div class="button cart__button" @click="toggleCart" v-else>
                <div class="button__icon">
                    <img src="storage/icons/cart.svg"/>
                </div>
                <div class="button__count">
                    {{ count }}
                </div>
            </div>
        </div>
    `,
    created() {
       this.getItems();
    },

    mounted() {
        this.$bus.$on('added',  this.addedToCart)
    },

    data() { 
        return {
            items: [],
            showCart: false,
        }
    },

    computed: {
        showCartButton() {
            return this.items.length  > 0 ? true : false;
        },

        count() {
            let total = 0;
            this.items.forEach(item => {
                total += parseFloat(item.quantity);
            })
            return total;
        },
    },

    methods: {
        removeFromCart(id) {

            axios.delete(`/api/carts/${this.id}`, {
                data: {
                    id,
                }
            })
            .then( response => {
                this.items.splice(this.items.findIndex(item => item.id == id), 1);
                if(this.count === 0 ) {
                    this.showCart = false;
                }
            })
            .catch ( error => {
                console.error( error );
            })
        },

        addedToCart(data) {

            if(data.book) {

                this.items.push(data.book); 
                
            }else {

                const index = this.items.findIndex(item => item.id == data.id);

                if(index > -1 ) {
                    const item = this.items[index];
    
                    data.vm.$set(item, 'quantity', parseInt(item.quantity) + 1);
                    data.vm.$set(item, 'finalPrice', parseFloat(item.price) + parseFloat(item.price));
    
                }
               
            }
 
        },

        getItems() {
            axios.get('/api/carts')
            .then( response => {
                if(response.data.cart) {
                    this.items = response.data.cart;
                }
            })
            .catch( error => {
                console.error ( error );
            })          
        },

        toggleCart() {
            if(this.count > 0) {
                this.showCart = !this.showCart;
            }

            if(this.showCart) {
                this.getItems();
            }
        },

        sendItems() {
            this.$bus.$emit('cartItems', this.items);
        }
    }
}

export default CartComponent;