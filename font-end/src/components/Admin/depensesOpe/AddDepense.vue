<template>
  <div class="add-depense-container">
    <form @submit.prevent="addDepense" enctype="multipart/form-data">
      <h2 class="add-depense-title">Add New Depense</h2>

      <div class="form-group">
        <label for="date" class="input-label">Date:</label>
        <input type="date" id="date" v-model="date" class="input-field" />
      </div>

      <div class="form-group">
        <label for="montant" class="input-label">Montant:</label>
        <input type="number" id="montant" v-model="montant" class="input-field" placeholder="Enter montant" />
      </div>

      <div class="form-group">
        <label for="description" class="input-label">Description:</label>
        <textarea id="description" v-model="description" class="input-field" placeholder="Enter description"></textarea>
      </div>

      <div class="form-group">
        <label for="status" class="input-label">Status:</label>
        <select id="status" v-model="status" class="input-field">
          <option value="0">Waiting</option>
          <option value="1">Accepted</option>
          <option value="2">Rejected</option>
        </select>
      </div>

      

      <button type="submit" class="add-button" :disabled="isAddingDepense">
        {{ isAddingDepense ? 'Adding...' : 'Add Depense' }}
      </button>
    </form>
  </div>
</template>

<script>
import DepenseService from '@/services/depensesService/DepenseService';

export default {
  data() {
    return {
      date: '',
      montant: '',
      description: '',
      status: '0',
      isAddingDepense: false, 
    };
  },
  methods: {
    addDepense() {
      this.isAddingDepense = true; 

      DepenseService.AddDepense({
        date: this.date,
        montant: this.montant,
        description: this.description,
        status: this.status,
      })
        .then((res) => {
          console.log(res);
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
  max-width: 400px;
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

.form-group {
  margin-bottom: 20px;
}

.input-label {
  font-weight: bold;
  margin-bottom: 5px;
  color: #495057;
}

.input-field {
  width: 100%;
  padding: 12px;
  border: 1px solid #ced4da;
  border-radius: 5px;
  background-color: #fff;
  color: #495057;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.input-field:focus {
  outline: 0;
  border-color: #80bdff;
  box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.add-button {
  background-color: #28a745;
  color: #fff;
  border: none;
  border-radius: 5px;
  padding: 12px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.add-button:hover {
  background-color: #218838;
}
</style>
