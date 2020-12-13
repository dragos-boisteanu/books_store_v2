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

    created() {
        console.log('book id: ', this.id);
    },
    
    methods: {
        addToCart() {
            console.log(`book ${this.id} added in cart`);
        }
    }
}

export default AddToCartBtnComponent