require('./bootstrap');

import CartComponent from './components/CartComponent';
import DemoComponent from './components/DemoComponent';
import AddToCartBtnComponent from './components/AddToCartBtnComponent';
import CountyCityComponent from './components/CountyCityComponent';
import UpdateCartQuantityComponent from './components/UpdateCartQuantityComponent';
import DynamicInputComponent from './components/DynamicInputComponent';
import UserDropdownComponent from './components/UserDropdowComponent';


Vue.component('cart-component', CartComponent);
Vue.component('demo-component', DemoComponent);
Vue.component('add-to-cart-btn-component', AddToCartBtnComponent);
Vue.component('county-city-component', CountyCityComponent)
Vue.component('update-cart-quantity-component', UpdateCartQuantityComponent);
Vue.component('dynamic-input-component', DynamicInputComponent);
Vue.component('user-dropdown-component', UserDropdownComponent);

Vue.prototype.$bus = new Vue();

Vue.directive('click-outside', {
    bind: function (el, binding, vnode) {
        el.clickOutsideEvent = function (event) {
          // here I check that click was outside the el and his children
          if (!(el == event.target || el.contains(event.target))) {
            // and if it did, call method provided in attribute value
            vnode.context[binding.expression](event);
          }
        };
        document.body.addEventListener('click', el.clickOutsideEvent)
      },
      unbind: function (el) {
        document.body.removeEventListener('click', el.clickOutsideEvent)
      },
})