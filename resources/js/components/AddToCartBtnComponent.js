const AddToCartBtnComponent = {
    template:
    `
        <button @click="addToCart">Add to cart</button>
    `,

    props: {
        id: {
            type: Number,
            require: true
        }
    },

    // created() {
    //     console.log('book id: ', this.id);
    // },

    mounted() {
        this.$bus.$on('cartItems', this.reciveItems);
    },

    data() {
        return {
            cartItems: [],
        }
    },
    
    methods: {
        reciveItems(data) {
            this.cartItems = data; 
        },

        addToCart() {
            axios.post(`api/carts/${this.id}`)
            .then( response => {
                console.log(response.data);
                console.log(`book ${this.id} added in cart`);
            })
            .catch( error => {
                console.error( error );
            });
            
            
        }
    }
}

export default AddToCartBtnComponent