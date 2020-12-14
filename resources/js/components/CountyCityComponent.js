const CountyCityComponent = {
    template:
    `
        <div>
            <div>
                <label>Judet</label>
                <select v-on:change="loadCities" v-model="selectedCountyId">
                    <option value="0" selected disabled>Alege judetul</option>
                    <option :value="county.id" v-for="(county, index) in countiesList" :key="index"> {{county.name}}</option>
                    
                </select>
            </div>
            <div>
                <label>Oras</label>
                <select v-on:change="cityChanged" v-model="selectedCityId">
                    <option value="0" selected disabled> Alege orasul </option>
                    <option v-for="(city, index) in cities" :value="city.id" :key="index">{{city.name}}</option>
                </select>           
            </div>
        </div>
    `,


    created() {
        console.log(this.selectedCountyId);
    },

    props: {
        counties: {
            type: String,
            required: true
        },

        selectedcounty: {
            type: String,
            default: "0"
        },

        selectedcity: {
            type: String,
            default: "0"
        }
    },

    data() {
        return {
            selectedCountyId: this.selectedcounty,
            selectedCityId: this.selectedcity,
            cities: [],
            countiesList: JSON.parse(this.counties) 
        }
    },

    computed: {
        citiesLength() {
            return this.cities.length;
        }
    },

    methods: {
        loadCities() {
            axios.get(`api/cities/${this.selectedCountyId}`)
            .then( response  => {
                this.cities = response.data;
                this.countyChanged();
            })
            .catch( error => {
                console.error( error );
            })
        },

        countyChanged() {
            this.$emit('county-selected', this.selectedCountyId);
        },

        cityChanged() {
            this.$emit('city-selected', this.selectedCityId);
        }

   
    }  

}

export default CountyCityComponent;