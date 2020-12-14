const CartComponent = {
    template: 
    `
        <div class="cart">
            <div class="cart__button" @click="toggleCart">
                <div>
                    Cart
                </div>
                <div>
                    {{ count }}
                </div>
            </div>
            <div v-if="showCart">
                <div class="cart__header">
                    <div>
                        Shopping cart 
                    </div>
                    <div @click="toggleCart">
                        X
                    </div>
                </div>
                <ul class="items__list">
                    <li v-for="(book,index) in items" :key="index" class="item">
                        <a :href="'/books/' + book.id" class="link link-cart title">{{ book.title }}</a>
                        <span class="divider">x</span>
                        <span class="quantity">{{ book.quantity }} buc.</span>
                        <span class="price">{{ book.price }} RON</span>
                        <button @click="removeFromCart(book.id)" class="btn">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="red" width="18px" height="18px"><path d="M0 0h24v24H0z" fill="none"/>
                                <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                            </svg>
                        </button>
                    </li>
                </ul>
                <form method="get" action="/comenzi/create">
                    <button type="submit" class="btn btn-order">Place order</button>
                </form>
            </div>
        </div>
    `,
    created() {
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

    mounted() {
        this.$bus.$on('added',  this.addToCart)
    },

    data() { 
        return {
            items: [],
            showCart: true,
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
            })
            .catch ( error => {
                console.error( error );
            })
        },

        addToCart(data) {
            if(data.vm) {
                data.vm.$set(this.items[this.items.findIndex(item => item.id == data.id)], 'quantity', parseInt(this.items[this.items.findIndex(item => item.id == data.id)].quantity) + 1);

                data.vm.$set(this.items[this.items.findIndex(item => item.id == data.id)], 'price', parseFloat(this.items[this.items.findIndex(item => item.id == data.id)].price) + data.price);
            }else {
                this.items.push(data);
            }   
        },

        toggleCart() {
            this.showCart = !this.showCart;
        },

        sendItems() {
            this.$bus.$emit('cartItems', this.items);
        }
    }
}

export default CartComponent;