const DynamicInputComponent =  {
    template: 
    `
        <div>
            <div>
                <span>
                    <span v-for="(word, index) in words" :key="index">
                        {{word.first_name }} {{ word.name}}
                        <button @click.prevent="remove(word.id)">X</button>
                    </span>
                </span>
                <input type="text" v-model="input" @keyup="find">
            </div>
            <ul v-if="!noWords">
                <li v-for="word in retrievedWords" :key="word.id" @click="add(word)">
                    {{ word.first_name }} {{ word.name}}
                </li>
            </ul>
            <div v-if="noWords">
                <input type="text" v-model="word" placeholder="New item...">
                <button @click.prevent="addNewWord">+</button>
            </div>
        </div>
    `,
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
            if(this.input.length >= 3) {
                axios.get(`api/${this.route}/find`, {
                    params: {
                        data: this.input
                    }
                })
                .then ( response => {
                    console.log(response);
                    if(response.data.message.length > 0){
                        this.retrievedWords = response.data.message;
                        this.noWords = false;
                        this.word = '';
                    }else{
                        this.retrievedWords.splice(0);
                        this.noWords = true;
                    }
                })
                .catch( error => {
                    console.error(error);
                })
            }
            else {
                this.retrievedWords.splice(0);
                this.noWords = false;
                this.word = '';
            }                
        },

        emitUpdate() {
            this.$emit('updated', this.words);
        },

        addNewWord() {
            if(this.word.length > 0) {

                this.word = this.word.trim();

                const first_name =  this.word.substr(0,this.word.indexOf(' ')); 
                const name = this.word.substr(this.word.indexOf(' ')+1); 

                axios.get(`api/${this.route}/check`, {
                    params: {
                        first_name,
                        name
                    }
                })
                .then( response => {
                    if(response.data.status === 'ok'){
                        this.saveWord({
                            first_name,
                            name
                        });
                    }
                })
                .catch( error => {
                    console.log( error );
                })
            }
        },
        saveWord(data) {
            axios.post(`api/${this.route}`, {
                first_name: data.first_name,
                name: data.name
            })
            .then( response => {
                if(response.status === 200) {
                    this.add(response.data.message[0]);     
                    this.noWords = false;
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