const UpdateCartQuantityComponent = {
    template: 

    `
    <div>
        <input type="number" name="quantity" v-model:value="localQunatity"/>
        <input type="hidden" name="bookId" :value="bookid"/>
        
        <button @click="update">Update quantity</button>
    </div>
    
    `,

    props: {
        bookid: {
            type: Number,
            required: true
        },
        quantity: {
            type: Number,
            required: true
        }
    },

    data() {
        return {
            localQunatity: this.quantity
        }
    },

    methods: {
        update() {
            axios.patch('api/carts', {
                bookId: this.bookid,
                quantity: this.localQunatity
            })
            .then ( response => {
                if(response.status === 200) {
                   console.log(response.data);
                }
                if(response.data.zero) {
                        
                    this.localQunatity = this.quantity;
                }
            })
            .catch ( error => {
                if(error.response.data.zero) {
                        
                    this.localQunatity = this.quantity;
                }
                console.error( error );
            }) 
        }
    }
}

export default UpdateCartQuantityComponent;