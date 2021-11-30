// const { mix } = require("laravel-mix/src/File");

require("./bootstrap");

window.Vue = require("vue").default;
import * as VueGoogleMaps from "vue2-google-maps";
import Toaster from "v-toaster";
import "v-toaster/dist/v-toaster.css";
import Vue from "vue";

Vue.component("weather-app", require("./components/Index.vue").default);

Vue.use(Toaster, { timeout: 5000 });
Vue.use(VueGoogleMaps, {
    load: {
        key: process.env.MIX_GOOGLE_MAPS_API_KEY,
    },
});

const app = new Vue({
    el: "#app",
});
