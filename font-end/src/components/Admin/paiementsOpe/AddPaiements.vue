<template>
  <div class="add-paiement-container">
    <form @submit.prevent="addPaiement" enctype="multipart/form-data">
      <h2 class="add-paiement-title">Add Nouvelle Paiement</h2>

      <div class="form-group">
        <label for="nom" class="input-label">Nom:</label>
        <input type="text" id="nom" v-model="nom" class="input-field" placeholder="Enter nom" />
      </div>

      <button type="submit" class="btn btn-primary">Add Paiement</button>
    </form>
  </div>
</template>

<script>
import PaiementService from '@/services/paiementsService/PaiementsService';

export default {
  data() {
    return {
      nom: '',
    };
  },
  methods: {
    addPaiement() {
      if (!this.nom.trim()) {
        return;
      }

      PaiementService.AddPaiement({
        nom: this.nom,
      })
        .then((res) => {
          console.log(res);
          this.clearForm();
        })
        .catch((error) => {
          console.error("Error adding paiement:", error);
        });
    },
    clearForm() {
      this.nom = '';
    },
  },
};
</script>

<style scoped>
.add-paiement-container {
  max-width: 400px;
  margin: 0 auto;
  padding: 40px;
  background-color: #ffffff;
  border-radius: 20px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.add-paiement-title {
  font-size: 28px;
  color: #007bff;
  margin-bottom: 20px;
  text-align: center;
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
</style>
