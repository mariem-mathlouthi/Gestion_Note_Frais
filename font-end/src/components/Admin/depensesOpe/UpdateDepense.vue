<template>
    <div class="update-depense-container">
      <form @submit.prevent="updateDepense" enctype="multipart/form-data">
        <div class="form-group">
          <label for="date">Date:</label>
          <input type="date" id="date" v-model="date" />
        </div>
  
        <div class="form-group">
          <label for="montant">Montant:</label>
          <input type="number" id="montant" v-model="montant" placeholder="Enter montant" />
        </div>
  
        <div class="form-group">
          <label for="description">Description:</label>
          <textarea id="description" v-model="description" placeholder="Enter description"></textarea>
        </div>
  
        <div class="form-group">
          <label for="status">Status:</label>
          <select id="status" v-model="status">
            <option value="0">Waiting</option>
            <option value="1">Accepted</option>
            <option value="2">Rejected</option>
          </select>
        </div>
  
        <!-- Add other form fields as needed -->
  
        <button type="submit" class="update-button">Update</button>
      </form>
    </div>
  </template>
  
  <script>
  import DepenseService from '@/services/depensesService/DepenseService';
  
  export default {
    props: {
      depense: Object,
    },
    created() {
      this.date = this.depense.date;
      this.montant = this.depense.montant;
      this.description = this.depense.description;
      this.status = this.depense.status.toString();
      // Add other properties as needed
    },
    data() {
      return {
        date: '',
        montant: '',
        description: '',
        status: '0', // Default to 'Waiting'
        // Add other data properties as needed
      };
    },
    methods: {
      updateDepense() {
        DepenseService.UpdateDepense(
          {
            date: this.date,
            montant: this.montant,
            description: this.description,
            status: this.status,
          
          },
          this.depense.id
        ).then((res) => {
          console.log(res);
        });
      },
    },
  };
  </script>
  
  <style scoped>
  .update-depense-container {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f8f9fa;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  
  form {
    display: flex;
    flex-direction: column;
  }
  
  .form-group {
    margin-bottom: 20px;
  }
  
  label {
    font-weight: bold;
    margin-bottom: 5px;
    color: #495057;
  }
  
  input,
  textarea,
  select {
    padding: 12px;
    border: 1px solid #ced4da;
    border-radius: 5px;
    background-color: #fff;
    color: #495057;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
  }
  
  input:focus,
  textarea:focus,
  select:focus {
    outline: 0;
    border-color: #80bdff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
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
    background-color: #45a049;
  }
  </style>
  