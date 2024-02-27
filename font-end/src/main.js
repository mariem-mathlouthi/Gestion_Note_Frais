import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import axios from 'axios'
import "../node_modules/bootstrap/dist/css/bootstrap.min.css";
import 'bootstrap-icons/font/bootstrap-icons.css';
//import 'font-awesome/css/all.css';
import { createPinia } from "pinia";
const pinia = createPinia()
axios.defaults.baseURL = 'http://localhost:8000/api/';
const app = createApp(App)

// Utilisez pinia comme plugin
//app.use(createPinia())
app.use(pinia)
app.use(router)
app.mount('#app')
