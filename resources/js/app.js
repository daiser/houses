import Vue from 'vue';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import App from './App.vue';
// Import component
import Loading from 'vue-loading-overlay';
// Import stylesheet
import 'vue-loading-overlay/dist/vue-loading.css';

Vue.use(ElementUI);
Vue.component('loading', Loading)

new Vue({
    el:     '#app',
    render: h => h(App)
});
