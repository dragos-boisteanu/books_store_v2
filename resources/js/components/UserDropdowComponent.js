const UserDropdownComponent = {

    template:

    `
        <div class="dropdown user-dropdown" v-click-outside="closeDropdown">
            <ul class="list dropdown__content" v-if="displayContent && auth">
                <li class="content__item">
                    <a class="link content__link" href="/account">Account</a>
                </li>
                <li class="content__item">
                    <a class="link content__link" href="/account/addresses">Addresses</a>
                </li>
                <li class="content__item">
                    <a class="link content__link" href="/account/orders">Orders</a>
                </li>
                <li class="content__item">
                    <form method="POST" action="/logout" class="menu-form">
                        <input type="hidden" name="_token" :value="csrf">
                        <button type="submit" class="button link content__link">Logout</button>
                    </form>
                </li>
            </ul>
            <div class="dropdown__header" @click="toggleContent">
                <div>
                    <div v-if="text">
                        {{ text }}
                    </div>
                    <a href="/login" v-else>Login</a>
                </div>
                <div v-if="auth">
                    <img src="/storage/icons/downArrow.svg" v-if="displayDownArrow" />
                    <img src="/storage/icons/upArrow.svg" v-else />
                </div>
            </div>
        </div>
     
    `,

    props: {
        text: {
            type: String,
            default: null
        },

        auth: {
            type: Boolean,
            default: false
        }
    },
    

    data() {
        return {
            displayContent: false,
            displayDownArrow: true,
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            
        }
    },

    methods: {
        toggleContent() {
            this.displayContent = !this.displayContent;
            this.displayDownArrow = !this.displayDownArrow;
        },

        closeDropdown() {
            this.displayContent = false;
            this.displayDownArrow = true;
        }
    }
}

export default UserDropdownComponent;