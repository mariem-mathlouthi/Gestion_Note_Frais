import axios from "axios";

export default {
    GetAllDevises() {
        return axios.get("devises/GetAllDevises");
    },
    

    AddDevise(res) {
        let data = new FormData();
        data.append('titre', res.titre);
        data.append('abreviation', res.abreviation);
        const config = {
            headers: {
                "Content-Type": 'multipart/form-data',
            },
        };
        return axios.post('devises/AddDevise', data, config);
    },

    DeleteDevise(id) {
        return axios.delete(`devises/DeleteDevise/${id}`);
    },

    UpdateDevise(res, id) {
        let data = new FormData();
        data.append('titre', res.titre);
        data.append('abreviation', res.abreviation);
        const config = {
            headers: {
                "Content-Type": 'multipart/form-data',
            },
        };
        return axios.post(`devises/UpdateDevise/${id}`, data, config);
    },

    GetDeviseById(id) {
        return axios.get(`devises/GetDeviseById/${id}`);
    },
};
