const CartComponent = {
    template: 
    `
        <div class="cart">
            <div class="btn-cart__container" v-bind:class="{'btn-cart__container--left-align' : showCart}">
                <button @click="toggleShowCart" v-if="showCartButton && !showCart" class="btn btn-cart btn-cart--fixed">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="24px" height="24px"><path d="M0 0h24v24H0z" fill="none"/>
                        <path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/>
                    </svg>    
                    <span class="btn-cart__counter">
                        {{ booksCount }}
                    </span>
                </button>
                <div v-else-if="showCart" class="cart__header">
                    <h3 class="cart__title">Cos cumparaturi</h3>
                    <button @click="toggleShowCart" class="btn btn-cart__close">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="24px" height="24px">
                            <path d="M0 0h24v24H0z" fill="none"/>
                            <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                        </svg>
                    </button>
                </div>      
                <svg v-else xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="24px" height="24px"><path d="M0 0h24v24H0z" fill="none"/>
                    <path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/>
                </svg>
            </div>  
            <div v-if="showCart">
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
                    <button type="submit" class="btn btn-order">Comanda</button>
                </form>
            </div>
        </div>
    `,
    created() {
        axios.get('/api/cart')
        .then( response => {
            if(response.data.items) {
                this.items = response.data.items;
            }
            this.id = response.data.id;
            this.$bus.$emit("cartId", response.data.id)
        })
        .catch( error => {
            console.error ( error );
        })          
    },

    mounted() {
        this.$bus.$on('added',  this.addToCart)
        this.$bus.$on('requestItems', this.sendItems)
    },

    data() { 
        return {
            id: 0,
            items: [],
            showCart: false,
        }
    },

    computed: {
        showCartButton() {
            return this.items.length  > 0 ? true : false;
        },

        booksCount() {
            let total = 0;
            this.items.forEach(item => {
                total += parseFloat(item.quantity);
            })
            return total;
        },

        cartID() {
            return this.id;
        }
    },

    methods: {
        removeFromCart(id) {
            axios.delete(`/api/cart/${this.id}`, {
                data: {
                    book_id: id,
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

        toggleShowCart() {
            this.showCart = !this.showCart;
        },

        sendItems() {
            this.$bus.$emit('sentItems', this.items);
        }
    }
}

export default CartComponent;