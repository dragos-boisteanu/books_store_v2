require('./bootstrap');

import CartComponent from './components/CartComponent';
import DemoComponent from './components/DemoComponent';
import AddToCartBtnComponent from './components/AddToCartBtnComponent';
import CountyCityComponent from './components/CountyCityComponent';
import UpdateCartQuantityComponent from './components/UpdateCartQuantityComponent';
import DynamicInputComponent from './components/DynamicInputComponent';

Vue.component('cart-component', CartComponent);
Vue.component('demo-component', DemoComponent);
Vue.component('add-to-cart-btn-component', AddToCartBtnComponent);
Vue.component('county-city-component', CountyCityComponent)
Vue.component('update-cart-quantity-component', UpdateCartQuantityComponent);
Vue.component('dynamic-input-component', DynamicInputComponent);

Vue.prototype.$bus = new Vue();