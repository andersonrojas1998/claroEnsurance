

require('./bootstrap');
window.Vue = require('vue');
import Swal from 'sweetalert2';
import axios from 'axios'
Vue.prototype.$http = axios;

import titleMixin from './mixins/titleMixin';
Vue.mixin(titleMixin);


import tblUser from "./components/users/tblUser.vue";
import tblTask from "./components/task/tblTask.vue";
import tblSearch from "./components/task/tblSearch.vue";


import tblEmails from "./components/emails/tblEmails.vue";
import sendInvoice from "./components/emails/sendInvoice.vue";
import tblProductos from "./components/productos/tblProductos.vue";
import tblInvoice from "./components/invoice/tblInvoice.vue";
import createdInvoice from "./components/invoice/createdInvoice.vue";

const app = new Vue({
    el: '#app',
    components: {
        tblUser,
        tblTask,
        tblSearch,
        tblProductos,
        tblInvoice,
        createdInvoice,
        tblEmails,
        sendInvoice
    },
});
