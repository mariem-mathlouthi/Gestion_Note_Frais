import Vue from 'vue';
import axios from 'axios';

console.log('Début de l\'exécution de axios.js');

const axiosInstance = axios.create({
  baseURL: process.env.VUE_APP_API_BASE_URL || 'http://localhost:8000/api/',
  // Autres configurations Axios si nécessaires
});

console.log('axiosInstance:', axiosInstance);

Vue.prototype.$axios = axiosInstance;

console.log('Fin de l\'exécution de axios.js');

export default axiosInstance;










