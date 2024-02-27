import axios from "axios";
import {AuthStore} from "../../store/index.js";
export default {
  getAllUsers() {
    return axios.get("users/GetAll"); 
  },
  updateUser(id, userData) {
    const data = new FormData();
    data.append('name', userData.name);
    data.append('email', userData.email);
    data.append('password', userData.password);
    data.append('photo', userData.photo);

    const config = {
      headers: {
        "Content-Type": "multipart/form-data",
      },
    };

    return axios.post(`users/updateOne/${id}`, data, config);
  },


  signUp(user) {
    const data = new FormData();
    data.append('name', user.name);
    data.append('email', user.email);
    data.append('password', user.password);
    data.append('photo', user.photo);

    const config = {
      headers: {
        "Content-Type": "multipart/form-data",
      },
    };

    return axios.post("auth/singUp", data, config);
  },

  async loginUser(email,password) {
    const store=AuthStore();
    const res= await axios.post('auth/LoginUser',{email,password});
    if(res.status===200){
        store.login(res.data.data.token,res.data.data.user,res.data.data.isAdmin);
    }else{
        store.logout();
    }
  },

  deleteOneUser(id) {
    return axios.delete(`users/deleteOne/${id}`);
  },
};
