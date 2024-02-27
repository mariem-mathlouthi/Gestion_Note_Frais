<template>
    <div class="update-users-container">
      <form @submit.prevent="updateUser" enctype="multipart/form-data">
        <div class="form-group">
          <label for="name" class="input-label">Nom:</label>
          <input type="text" id="name" v-model="user.name" placeholder="Entrez le nom" class="input-field" />
        </div>
  
        <div class="form-group">
          <label for="email" class="input-label">Email:</label>
          <input type="email" id="email" v-model="user.email" placeholder="Entrez l'email" class="input-field" />
        </div>
  
        <div class="form-group">
          <label for="password" class="input-label">Mot de passe:</label>
          <input type="password" id="password" v-model="user.password" placeholder="Entrez le mot de passe" class="input-field" />
        </div>
  
        <div class="form-group">
          <label for="photo" class="input-label">Photo:</label>
          <input type="file" id="photo" @change="onFileChange" class="input-field" />
        </div>
  
        <button type="submit" class="btn btn-primary update-button">Mettre à jour</button>
      </form>
    </div>
  </template>
  
  <script>
  import UserService from "@/services/UsersService/UsersService";
  
  export default {
    props: {
      user: Object,
    },
    data() {
      return {
        user: {
          name: "",
          email: "",
          password: "",
          photo: null,
        },
      };
    },
    created() {
      this.user = this.user;
    },
    methods: {
      updateUser() {
        const formData = new FormData();
        formData.append('name', this.user.name);
        formData.append('email', this.user.email);
        formData.append('password', this.user.password);
        formData.append('photo', this.user.photo);
  
        UserService.updateUser(this.user.id, formData)
          .then((res) => {
            console.log("Mise à jour réussie:", res);
            this.$emit("update-success");
          })
          .catch((error) => {
            console.error("Échec de la mise à jour:", error);
          });
      },
      onFileChange(event) {
        this.user.photo = event.target.files[0];
      },
    },
  };
  </script>
  
  <style scoped>
  .update-users-container {
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
  </style>
  
