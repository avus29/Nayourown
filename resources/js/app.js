
/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

require('./bootstrap');

// import Bootstrap for styling
import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'
import 'bootstrap'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import 'vue2-animate/dist/vue2-animate.min.css'

// import font-awesome for svg images
import { library } from '@fortawesome/fontawesome-svg-core'
import { faSpinner, faUserAlt, faHandshake,faCertificate, faBullhorn} from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon, FontAwesomeLayers, FontAwesomeLayersText  } from '@fortawesome/vue-fontawesome'
library.add(faSpinner,faHandshake,faUserAlt, faBullhorn, faCertificate)
Vue.component('font-awesome-icon', FontAwesomeIcon)
Vue.component('font-awesome-layers', FontAwesomeLayers);
Vue.component('font-awesome-layers-text', FontAwesomeLayersText);

//Route information for Vue Router
import Routes from './router.js';

//import Axios for ajax capability
import axios from 'axios'
import VueAxios from 'vue-axios'

//import vue-noty for notification
import VueNoty from 'vuejs-noty'
import 'vuejs-noty/dist/vuejs-noty.css'

// import vee-validate for validation
import VeeValidate from 'vee-validate'

Vue.use(VueAxios, axios)
Vue.use(BootstrapVue)
Vue.use(VueNoty)
Vue.use(VeeValidate, {
     classes: true,
     classNames: {
       valid: 'is-valid',
       invalid: 'is-invalid'
     }
   });

// Component file
import App from './App.vue';

const authData = localStorage.getItem('auth');

const app  = new Vue({
     el: '#app',
     components: { App },
     template: '<App/>',
     router: Routes,
     data: {
          auth: authData? JSON.parse(authData) :{}
     },
     render: h => h(App),
    
});

export default app;
