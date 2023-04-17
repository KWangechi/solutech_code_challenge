import './bootstrap';
// require('./bootstrap');


import {createApp} from 'vue'

import StatusIndex from './components/status/Index.vue'

const app = createApp(StatusIndex);
// app.component('status-index', StatusIndex);
app.mount("#app");

