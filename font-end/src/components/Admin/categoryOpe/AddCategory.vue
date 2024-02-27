<template>
  <div class="add-category-container">
    <form @submit.prevent="addCategory" enctype="multipart/form-data">
      <h2 class="add-category-title">Add Nouvelle Categorie</h2>

      <div class="form-group">
        <label for="description" class="input-label">Description:</label>
        <input type="text" id="description" v-model="desc" class="input-field" placeholder="Enter description" />
      </div>

      <div class="form-group">
        <label for="photo" class="input-label">Upload Category Photo:</label>
        <div class="file-upload">
          <input type="file" ref="photo" @change="uploadFile" id="photo" class="file-input" />
          <label for="photo" class="file-select">Choose a file</label>
          <span class="file-name">{{ image ? image.name : 'No file chosen' }}</span>
        </div>
      </div>

      <button class="btn btn-primary" type="submit">Add Category</button>
    </form>
  </div>
</template>

<script>
import CategoryService from '@/services/categoryService/CategoryService';
export default {
  data() {
    return {
      desc: '',
      image: null,
    };
  },
  methods: {
    uploadFile() {
      this.image = this.$refs.photo.files[0];
    },
    addCategory() {
      CategoryService.AddCategory({
        description: this.desc,
        photo: this.image,
      }).then((res) => {
        console.log(res);
        alert('La Catégorie a été ajoutée avec succès.');
        this.$router.push({ name: 'CategoryView' });

        
      });
    },
  },
  
};

</script>

<style scoped>
.add-category-container {
  max-width: 400px;
  margin: 0 auto;
  padding: 40px;
  background-color: #f0f5f9;
  border-radius: 20px;
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.add-category-title {
  font-size: 32px;
  color: #2c3e50;
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

.file-upload {
  position: relative;
  overflow: hidden;
}

.file-input {
  display: none;
}

.file-select {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding: 15px;
  background-color: #3498db;
  color: #fff;
  cursor: pointer;
  border-radius: 10px;
  text-align: center;
}

.file-name {
  margin-top: 10px;
  display: block;
  text-align: center;
  color: #34495e;
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
