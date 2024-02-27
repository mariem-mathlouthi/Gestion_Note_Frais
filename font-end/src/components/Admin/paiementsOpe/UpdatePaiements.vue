<template>
  <div class="update-paiement-container">
    <form @submit.prevent="updatePaiement" enctype="multipart/form-data">
      <div class="form-group">
        <label for="nom" class="input-label">Nom:</label>
        <input type="text" id="nom" v-model="nom" placeholder="Enter nom" class="input-field" />
      </div>

      <button type="submit" class="btn btn-primary update-button">Update</button>
    </form>
  </div>
</template>

<script>
import PaiementService from "@/services/paiementsService/PaiementsService";

export default {
  props: {
    paiement: Object,
  },
  data() {
    return {
      nom: "",
    };
  },
  created() {
    this.nom = this.paiement.nom;
  },
  methods: {
    updatePaiement() {
      console.log("Updating paiement with data:", {
        nom: this.nom,
        id: this.paiement.id,
      });

      PaiementService.UpdatePaiement(
        {
          nom: this.nom,
        },
        this.paiement.id
      )
        .then((res) => {
          console.log("Update success:", res);
          this.$emit("update-success");
        })
        .catch((error) => {
          console.error("Update failed:", error);
        });
    },
  },
};
</script>

<style scoped>
.update-paiement-container {
  max-width: 400px;
  margin: 0 auto;
  padding: 40px;
  background-color: #ffffff;
  border-radius: 20px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

form {
  display: flex;
  flex-direction: column;
}

.form-group {
  margin-bottom: 25px;
}

.input-label {
  font-weight: bold;
  margin-bottom: 10px;
  color: #34495e;
}

.input-field {
  width: 100%;
  padding: 15px;
  border: 1px solid #bdc3c7;
  border-radius: 10px;
  background-color: #ecf0f1;
  color: #34495e;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.input-field:focus {
  outline: 0;
  border-color: #3498db;
  box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
}

.btn-primary {
  background-color: #3498db;
  color: #fff;
  border: none;
  border-radius: 10px;
  padding: 15px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.btn-primary:hover {
  background-color: #2980b9;
}

.btn-primary {
  background-color: #3498db;
  color: #fff;
  border: none;
  border-radius: 10px;
  padding: 15px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}
</style>
