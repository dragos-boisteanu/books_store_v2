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
                if(response.data.book) {
                    this.$bus.$emit('added', { id: this.id, book: response.data.book[0], vm: this});
                } else {
                    this.$bus.$emit('added', { id: this.id, vm: this});
                }
                
            })
            .catch( error => { 
                console.error( error );
            });
        }
    }
}

export default AddToCartBtnComponent;