import axios from "axios";

export default {
  GetAllPaiements() {
    return axios.get("paiements/GetAllPaiements");
  },

  AddPaiement(paiement) {
    const data = new FormData();
    data.append('nom', paiement.nom);

    const config = {
      headers: {
        "Content-Type": "multipart/form-data",
      },
    };

    return axios.post("paiements/AddPaiement", data, config);
  },

  deletePaiement(id) {
    return axios.delete(`paiements/DeletePaiement/${id}`);
  },

  UpdatePaiement(paiement, id) {
    const data = new FormData();
    data.append('nom', paiement.nom);

    const config = {
      headers: {
        "Content-Type": "multipart/form-data",
      },
    };

    return axios.post(`paiements/UpdatePaiement/${id}`, data, config);
  },
};
