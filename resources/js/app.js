require('./bootstrap');

import CartComponent from './components/CartComponent';
import DemoComponent from './components/DemoComponent';
import AddToCartBtnComponent from './components/AddToCartBtnComponent';


Vue.component('cart-component', CartComponent);
Vue.component('demo-component', DemoComponent);
Vue.component('add-to-cart-btn-component', AddToCartBtnComponent);

Vue.prototype.$bus = new Vue();