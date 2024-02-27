<template>
  <div class="add-depense-container">
    <form @submit.prevent="addDepense" enctype="multipart/form-data">
      <h2 class="add-depense-title">Add Nouvelle Depense</h2>

      <div class="form-grid">
        <div class="form-group">
          <label for="date">Date:</label>
          <input type="date" id="date" v-model="date" class="input-field" />
        </div>

        <div class="form-group">
          <label for="montant">Montant:</label>
          <input type="number" id="montant" v-model="montant" placeholder="Enter montant" class="input-field" />
        </div>
        <div class="form-group">
          <label for="category_id">Category:</label>
          <select v-model="category_id" id="category_id" class="input-field">
            <option v-for="category in categorys" :key="category.id" :value="category.id">{{ category.description }}</option>
          </select>
        </div>

       

        <div class="form-group">
          <label for="pays">Pays:</label>
          <input type="text" id="pays" v-model="pays" placeholder="Enter Pays" class="input-field" />
        </div>

        <div class="form-group">
          <label for="paiment_id">Paimenets:</label>
          <select v-model="paiment_id" id="paiment_id" class="input-field">
            <option v-for="paiement in Paiments" :key="paiement.id" :value="paiement.id">{{ paiement.nom }}</option>
          </select>
        </div>

        <div class="form-group">
          <label for="devise_id">Devise:</label>
          <select v-model="devise_id" id="devise_id" class="input-field">
            <option v-for="devise in Devises" :key="devise.id" :value="devise.id">{{ devise.abreviation }}</option>
          </select>
        </div>

        <div class="form-group">
          <label for="description">Commentaire:</label>
          <textarea id="description" v-model="description" placeholder="Enter Commentaire" class="input-field"></textarea>
        </div>

        <div class="form-group">
          <label for="photo">Upload File:</label>
          <input type="file" ref="photo" @change="uploadFile" id="photo" class="file-input" />
        </div>
      </div>

      <button type="submit" class="btn btn-primary" :disabled="isAddingDepense">
        {{ isAddingDepense ? 'Adding...' : 'Add Depense' }}
      </button>
    </form>
  </div>
</template>

<script>
import PaiementsService from '@/services/paiementsService/PaiementsService';
import DeviseService from '@/services/deviseService/DeviseService';
import CategoryService from '@/services/categoryService/CategoryService';
import DepenseService from '@/services/depensesService/DepenseService';
import { AuthStore } from "@/store/index.js"

export default {
  setup() {
    const store = AuthStore();
    return { store }
  },
  created() {
    this.getPaiment();
    this.getDevise();
    this.getCategory();
  },
  data() {
    return {
      date: '',
      montant: '',
      description: '',
      isAddingDepense: false,
      image: null,
      pays: "",
      Paiments: [],
      paiment_id: "",
      devise_id: "",
      Devises: [],
      category_id: "",
      categorys: []
    };
  },
  methods: {
    uploadFile() {
      this.image = this.$refs.photo.files[0];
    },
    getPaiment() {
      PaiementsService.GetAllPaiements().then((res) => {
        this.Paiments = res.data.data;
      })
    },
    getDevise() {
      DeviseService.GetAllDevises().then((res) => {
        this.Devises = res.data.data;
      })
    },
    getCategory() {
      CategoryService.GetCategory().then((res) => {
        this.categorys = res.data.data;
      })
    },
    addDepense() {
  this.isAddingDepense = true;

  DepenseService.AddDepense({
    date: this.date,
    montant: this.montant,
    description: this.description,
    file: this.image,
    pays: this.pays,
    user_id: this.store.user['id'],
    paiement_id: this.paiment_id,
    devise_id: this.devise_id,
    category_id: this.category_id
  })
  .then((res) => {
    console.log(res);

    // Affiche une alerte indiquant que la dépense a été ajoutée avec succès
    alert('La dépense a été ajoutée avec succès.');

  })
  .finally(() => {
    this.isAddingDepense = false;
  });
},

  },
};
</script>

<style scoped>
.add-depense-container {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
  background-color: #f8f9fa;
  border-radius: 10px;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

.add-depense-title {
  font-size: 24px;
  color: #343a40;
  margin-bottom: 20px;
  text-align: center;
}

.form-grid {
  display: grid;
  gap: 15px;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
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
/*
.add-button {
  background-color: #28a745;
  color: #fff;
  border: none;
  border-radius: 5px;
  padding: 10px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}*/
/*
.add-button:hover {
  background-color: #218838;
}*/
</style>