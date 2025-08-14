import app from "./app.vue";
import {createApp} from "vue";
import router from "./router/router.js";
import 'flatpickr/dist/flatpickr.css';

import axios from 'axios';
import cookiesServices from './apiController/cookiesServices.js';

const token = cookiesServices.get('admin_token');
if (token) {
    axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
}

createApp(app).use(router).mount('#app');
