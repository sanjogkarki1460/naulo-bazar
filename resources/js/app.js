/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import StarRating from 'vue-star-rating'
Vue.component('star-rating', StarRating);
import VueObserveVisibility from 'vue-observe-visibility'
//vue event bus
window.EventBus = new Vue();

//easy toast
import VueIziToast from 'vue-izitoast';
import 'izitoast/dist/css/iziToast.min.css';
Vue.use(VueIziToast);
Vue.use(VueObserveVisibility)
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('cart', require('./components/cart.vue').default);
Vue.component('wishlist', require('./components/wishlist.vue').default);
Vue.component('wishlist', require('./components/wishlist.vue').default);
Vue.component('wishlist-notification', require('./components/wishlistNotification.vue').default);
Vue.component('cart-notification', require('./components/cartNotification.vue').default);

Vue.component('home', require('./components/home.vue').default);
Vue.component('category-product', require('./components/CategoryProduct.vue').default);
Vue.component('sub-category-product', require('./components/subcategory.vue').default);
Vue.component('search', require('./components/search.vue').default);
Vue.component('search-result', require('./components/search_result.vue').default);
Vue.component('product-detail', require('./components/ProductDetail.vue').default);
Vue.component('nav-bar', require('./components/navbar.vue').default);



Vue.component('banner', require('./components/homepage/banner.vue').default);
Vue.component('category', require('./components/homepage/category.vue').default);
Vue.component('top-offer', require('./components/homepage/TopOffers.vue').default);

Vue.component('best-selling-item', require('./components/homepage/BestSellingItem.vue').default);
Vue.component('recommendation', require('./components/homepage/Recommendation.vue').default);
Vue.component('just-for-you', require('./components/homepage/ForYou.vue').default);

//pages
Vue.component('seller-signup', require('./components/page/SellerSignUp.vue').default);
Vue.component('wishlist-page', require('./components/page/Wishlist.vue').default);
Vue.component('change-password', require('./components/page/ChangePassword.vue').default);
Vue.component('profile', require('./components/page/profile.vue').default);
Vue.component('customer-address', require('./components/page/address.vue').default);
Vue.component('sign-up', require('./components/page/signUp.vue').default);
Vue.component('flash-sell', require('./components/page/FlashSell.vue').default);
Vue.component('flash-model', require('./components/FlashModel.vue').default);
Vue.component('triger-model', require('./components/modelTriger.vue').default);
Vue.component('cart-detail', require('./components/page/CartDetail.vue').default);
Vue.component('cart-single', require('./components/cartSingle.vue').default);
Vue.component('checkout', require('./components/page/checkout.vue').default);
Vue.component('seller-product', require('./components/page/sellerProduct.vue').default);
Vue.component('mobile-category', require('./components/mobile/mobileCategory.vue').default);
Vue.component('footer-category', require('./components/mobile/footerCategory.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

