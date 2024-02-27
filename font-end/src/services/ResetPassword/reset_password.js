import axios from "axios";


export default {

     ForgotPassword(email){
        return axios.post('auth/forgot_password',email);
     },

     ChangerPassword(data){
        return axios.post('auth/changer_password',data);
     } 
     
}