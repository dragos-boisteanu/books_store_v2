const DynamicInputComponent =  {
    template: 
    `
        <div class="dynamic-input">
            <ul class="words-list">
                <li class="word" v-for="(word, index) in words" :key="index">
                    {{word.first_name }} {{ word.name}}
                    <button class="word-button" @click.prevent="remove(word.id)">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="12px" height="12px">
                            <path d="M0 0h24v24H0z" fill="none"/>
                            <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                        </svg>
                    </button>
                </li>
            </ul>
            <div class="input-container" v-click-outside="closeDropdown">
                <input type="text" v-model="input" @keyup="find" class="form-input">
                <ul v-if="!noWords" class="results-list">
                    <li class="result" v-for="word in retrievedWords" :key="word.id" @click="add(word)">
                        {{ word.first_name }} {{ word.name}}
                    </li>
                </ul>
            </div>
        </div>
    `,

    // <div v-if="noWords">
            //     <input type="text" v-model="word" placeholder="New item...">
            //     <button @click.prevent="addNewWord">+</button>
            // </div>

    props: {
        wordsprop: {
            type: String,
            default: ''
        },
        route: {
            type: String,
            default: '',
        }
    },
    created(){
        if(this.wordsprop.length > 0){
            this.words = JSON.parse(this.wordsprop);
            this.emitUpdate();
        }
    },
    data() {
        return {
            input: '',
            words: [],
            retrievedWords: [],
            word: '',
            noWords: false,
        }
    },

    computed: {
        noWords() {
            return this.retrievedWords.length > 0 ? true : false;
        }
    },

    methods: {
        add(value) {
            if(this.words.findIndex(word => word.id === value.id) < 0 )
            {
                this.words.push(value);
                this.emitUpdate();
            }
            this.input = '';
            this.retrievedWords.splice(0);
        },
        
        remove(id) {
            this.words.splice(this.words.findIndex(word => word.id === id),1);
            this.emitUpdate();
        },

        find() {
            if(this.input.length >= 2) {
                axios.get(`api/${this.route}/find`, {
                    params: {
                        data: this.input
                    }
                })
                .then ( response => {
                    console.log(response);
                    if(response.data.message.length > 0){
                        this.retrievedWords = response.data.message;
                        // this.noWords = false;
                        this.word = '';
                    }else{
                        this.retrievedWords.splice(0);
                        // this.noWords = true;
                    }
                })
                .catch( error => {
                    console.error(error);
                })
            }
            else {
                this.retrievedWords.splice(0);
                // this.noWords = false;
                this.word = '';
            }                
        },

        emitUpdate() {
            this.$emit('updated', this.words);
        },

        closeDropdown() {
            this.retrievedWords.splice(0);
        },
        // addNewWord() {
        //     if(this.word.length > 0) {

        //         this.word = this.word.trim();

        //         const first_name =  this.word.substr(0,this.word.indexOf(' ')); 
        //         const name = this.word.substr(this.word.indexOf(' ')+1); 

        //         axios.get(`api/${this.route}/check`, {
        //             params: {
        //                 first_name,
        //                 name
        //             }
        //         })
        //         .then( response => {
        //             if(response.data.status === 'ok'){
        //                 this.saveWord({
        //                     first_name,
        //                     name
        //                 });
        //             }
        //         })
        //         .catch( error => {
        //             console.log( error );
        //         })
        //     }
        // },
        
        saveWord(data) {
            axios.post(`api/${this.route}`, {
                first_name: data.first_name,
                name: data.name
            })
            .then( response => {
                if(response.status === 200) {
                    this.add(response.data.message[0]);     
                    // this.noWords = false;
                    this.word = '';    
                    this.emitUpdate();
                }
            })
            .catch( error => {
                console.error ( error );
            });

        }
    },
}

export default DynamicInputComponent;