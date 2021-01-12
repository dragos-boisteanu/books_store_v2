const UserDropdownComponent = {

    template:

    `
        <div class="dropdown user-dropdown">
            <ul class="list dropdown__content" v-if="displayContent">
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
                <div @click="toggleContent">
                    <img src="/storage/icons/downArrow.svg" v-if="displayDownArrow" />
                    <img src="/storage/icons/downArrow.svg" v-else />
                </div>
            </div>
        </div>
     
    `,

    props: {
        text: {
            type: String,
            default: null
        },
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
        }
    }
}

export default UserDropdownComponent;