<template>
  <div class="update-devise-container">
    <form @submit.prevent="updateDevise" enctype="multipart/form-data">
      <div class="form-group">
        <label for="titre" class="input-label">Title:</label>
        <input type="text" id="titre" v-model="titre" placeholder="Enter title" class="input-field" />
      </div>

      <div class="form-group">
        <label for="abreviation" class="input-label">Abbreviation:</label>
        <input type="text" id="abreviation" v-model="abreviation" placeholder="Enter abbreviation" class="input-field" />
      </div>

      <!-- Display the current photo if available -->
      <div v-if="name" class="form-group">
        <label class="input-label">Current Photo:</label>
        <img :src="'http://localhost:8000' + name" alt="Devise Photo" class="current-photo" />
      </div>

      <button type="submit" class="btn btn-primary update-button">Update</button>
    </form>
  </div>
</template>

<script>
import DeviseService from "@/services/deviseService/DeviseService";

export default {
  props: {
    devise: Object,
  },
  created() {
    this.titre = this.devise.titre;
    this.abreviation = this.devise.abreviation;
  },
  data() {
    return {
      titre: "",
      abreviation: "",
      name: "",
    };
  },
  methods: {
    uploadFile() {
      this.image = this.$refs.photo.files[0];
    },
    updateDevise() {
      DeviseService.UpdateDevise(
        {
          titre: this.titre,
          abreviation: this.abreviation,
        },
        this.devise.id
      ).then((res) => {
        console.log(res);
      });
    },
  },
};
</script>

<style scoped>
.update-devise-container {
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

.current-photo {
  max-width: 100%;
  height: auto;
  border-radius: 10px;
  margin-bottom: 15px;
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
