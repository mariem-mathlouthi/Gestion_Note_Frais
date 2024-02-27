<template>
  <div class="update-depense-container">
    <form @submit.prevent="updateDepense" enctype="multipart/form-data">
      <h2 class="update-depense-title"><i class="bi bi-pencil"></i> Update Depense</h2>

      <div class="form-grid">
        <div class="form-group">
          <label for="date" class="input-label">Date:</label>
          <input type="date" id="date" v-model="date" class="input-field" />
        </div>

        <div class="form-group">
          <label for="montant" class="input-label">Montant:</label>
          <input type="number" id="montant" v-model="montant" placeholder="Enter montant" class="input-field" />
        </div>

        <div class="form-group">
          <label for="category_id" class="input-label">Category:</label>
          <select v-model="category_id" id="category_id" class="input-field">
            <option v-for="category in categorys" :key="category.id" :value="category.id" :selected="category.id==category_id">{{ category.description }}</option>
          </select>
        </div>

        <div class="form-group">
          <label for="pays" class="input-label">Pays:</label>
          <input type="text" id="pays" v-model="pays" placeholder="Enter Pays" class="input-field" />
        </div>

        <div class="form-group">
          <label for="paiment_id" class="input-label">Paimenets:</label>
          <select v-model="paiment_id" id="paiment_id" class="input-field">
            <option v-for="paiement in Paiments" :key="paiement.id" :value="paiement.id" :selected="paiement.id==paiment_id">{{ paiement.nom }}</option>
          </select>
        </div>

        <div class="form-group">
          <label for="devise_id" class="input-label">Devise:</label>
          <select v-model="devise_id" id="devise_id" class="input-field">
            <option v-for="devise in Devises" :key="devise.id" :value="devise.id" :selected="devise.id==devise_id">{{ devise.abreviation }}</option>
          </select>
        </div>

        <div class="form-group">
          <label for="description" class="input-label">Commentaire:</label>
          <textarea id="description" v-model="description" placeholder="Enter Commentaire" class="input-field"></textarea>
        </div>

        <div class="form-group">
          <label for="photo" class="input-label">Upload File:</label>
          <input type="file" @change="uploadFile" ref="photo" id="photo" class="file-input" />
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-primary" :disabled="isUpdatingDepense">
            {{ isUpdatingDepense ? 'Updating...' : 'Update Depense' }}
          </button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import DepenseService from '@/services/depensesService/DepenseService';
import PaiementsService from '@/services/paiementsService/PaiementsService';
import CategoryService from '../../../services/categoryService/CategoryService';
import DeviseService from '@/services/deviseService/DeviseService';

export default {
  props: {
    depense: Object,
  },
  data() {
    return {
      date: '',
      montant: '',
      description: '',
      isUpdatingDepense: false,
      image: "",
      pays: '',
      Paiments: [],
      paiment_id: '',
      devise_id: '',
      Devises: [],
      category_id: '',
      categorys: [],
    };
  },
  created() {
    this.getPaiment();
    this.getDevise();
    this.getCategory();
    this.date = this.depense.date;
    this.montant = this.depense.montant;
    this.description = this.depense.description;
    this.category_id = this.depense.category_id;
    this.pays = this.depense.pays;
    this.paiment_id = this.depense.paiement_id;
    this.devise_id = this.depense.devise_id;
    this.image=this.depense.file;
    console.log(this.depense);
  },
  methods: {
    uploadFile() {
      this.image = this.$refs.photo.files[0];
    },

    getPaiment() {
      // Fetch Paiments data
      // Example: Assume DepenseService.GetPaiments() returns a Promise
      PaiementsService.GetAllPaiements().then((res) => {
        this.Paiments = res.data.data;
      });
    },

    getDevise() {
      // Fetch Devises data
      // Example: Assume DepenseService.GetDevises() returns a Promise
      DeviseService.GetAllDevises().then((res) => {
        this.Devises = res.data.data;
      });
    },

    getCategory() {
      // Fetch Categorys data
      // Example: Assume DepenseService.GetCategory() returns a Promise
      CategoryService.GetCategory().then((res) => {
        this.categorys = res.data.data;
      });
    },

    updateDepense() {
      this.isUpdatingDepense = true;

      DepenseService.UpdateDepense(
        {
          date: this.date,
          montant: this.montant,
          description: this.description,
          category_id: this.category_id,
          pays: this.pays,
          paiment_id: this.paiment_id,
          devise_id: this.devise_id,
          file:this.image
          // Add other properties as needed
        },
        this.depense.id
      )
        .then((res) => {
          console.log(res);
          
        })
        .catch((error) => {
          console.error(error);
        })
        .finally(() => {
          this.isUpdatingDepense = false;
        });
    },
  },
};
</script>

<style scoped>
.update-depense-container {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
  background-color: #f8f9fa;
  border-radius: 10px;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

.update-depense-title {
  font-size: 24px;
  color: #343a40;
  margin-bottom: 20px;
  text-align: center;
}

.form-grid {
  display: grid;
  gap: 15px;
  grid-template-columns: repeat(2, 1fr);
}

.form-group {
  display: flex;
  flex-direction: column;
}

.input-label {
  font-weight: bold;
  margin-bottom: 5px;
  color: #495057;
}

.input-field,
textarea,
select {
  width: 100%;
  padding: 10px;
  border: 1px solid #ced4da;
  border-radius: 5px;
  margin-top: 5px;
}

.file-input {
  margin-top: 5px;
}

.update-button {
  background-color: #45a049;
  color: #fff;
  border: none;
  border-radius: 5px;
  padding: 12px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.update-button:hover {
  background-color: #218838;
}
</style>
