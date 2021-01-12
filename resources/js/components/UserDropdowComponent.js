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
                    <form method="POST" action="/logout">
                        @csrf

                        <button type="submit">Logout</button>
                    </form>
                </li>
            </ul>
            <div class="dropdown__header">
                <div>
                    <div v-if="text">
                        {{ text }}
                    </div>
                    <a href="/login" v-else>Login</a>
                </div>
                <div @click="toggleContent" v-if="auth">
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
            displayDownArrow: true
            
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