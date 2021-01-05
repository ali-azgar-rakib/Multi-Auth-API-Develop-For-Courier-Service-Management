/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue").default
);

// user vue router
import VueRouter from "vue-router";
Vue.use(VueRouter);

import routes from "./routes";

const router = new VueRouter({
    routes,
    mode: "history"
});

// progress bar
import VueProgressBar from "vue-progressbar";

const options = {
    color: "red",
    failedColor: "red",
    thickness: "5px",
    transition: {
        speed: "0.5s",
        opacity: "0.9s",
        termination: 300
    },
    autoRevert: true,
    location: "top",
    inverse: false
};

Vue.use(VueProgressBar, options);

// global filter
import moment from "moment";
Vue.filter("timeFormat", arg => moment(arg).format("D-MM-YYYY"));

// import vuex
import Vuex from "vuex";
Vue.use(Vuex);
import storeData from "./store";
const store = new Vuex.Store(storeData);

// vform
import { Form, HasError, AlertError } from "vform";

window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

// sweet alert

import swal from "sweetalert2";

window.swal = swal;

window.toast = swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 4000
});

// vue page transition
import VuePageTransition from "vue-page-transition";

Vue.use(VuePageTransition);

// vue pagination
Vue.component("pagination", require("laravel-vue-pagination"));

// component
import AdminLogin from "./components/admin/AdminLogin";
import AdminHome from "./components/admin/AdminHome";
Vue.component("admin-login-component", AdminLogin);
Vue.component("admin-home-component", AdminHome);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
    router,
    store,
    data() {
        return {
            adminToken: null
        };
    },
    created() {
        this.adminToken = localStorage.getItem("admin_token");
    }
});
