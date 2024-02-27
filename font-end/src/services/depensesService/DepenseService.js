import axios from "axios";

export default {
    GetDepenses(status,montant,date) {
       
        return axios.get(`/depenses/GetAllDepenses?status=${status}${montant!='' ? '&montant='+montant : ''}${date!='' ? '&date='+date : ''}`);
    },

    GetLatestDepenses(id){
        return axios.get(`/depenses/MyLatestDepenses?user_id=${id}`);
    },

    AddDepense(depenseData) {
        let data = new FormData();
        data.append("date", depenseData.date);
        data.append("montant", depenseData.montant);
        data.append("description", depenseData.description);
        data.append("pays", depenseData.pays);
        data.append("file", depenseData.file);
        data.append("user_id", depenseData.user_id);
        data.append("paiement_id", depenseData.paiement_id);
        data.append("devise_id", depenseData.devise_id);
        data.append("category_id", depenseData.category_id);

        const config = {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        };

        return axios.post("/depenses/AddDepense", data, config);
    },

    UpdateDepense(depenseData, id) {
        let data = new FormData();
        data.append("date", depenseData.date);
        data.append("montant", depenseData.montant);
        data.append("description", depenseData.description);
        data.append("pays", depenseData.pays);
        data.append("file", depenseData.file);
        data.append("paiement_id", depenseData.paiment_id);
        data.append("devise_id", depenseData.devise_id);
        data.append("category_id", depenseData.category_id);

        const config = {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        };

        return axios.post(`/depenses/UpdateDepense/${id}`, data, config);
    },

    DeleteDepense(id) {
        return axios.delete(`/depenses/DeleteDepense/${id}`);
    },

    GetDepenseById(id) {
        return axios.get(`/depenses/GetDepenseById/${id}`);
    },

    AccpetDepenses(id){
        return axios.put(`/depenses/accpetDepenses/${id}`);
    },
   RejectDepenses(id){
        return axios.put(`/depenses/RejectDepenses/${id}`);
    }
};
