<template>
  <div class="update-category-container">
    <form @submit.prevent="updateCategory" enctype="multipart/form-data">
      <div class="form-group">
        <label for="description">Description:</label>
        <input type="text" id="description" v-model="desc" placeholder="Enter description" />
      </div>

      <div class="form-group">
        <label for="currentPhoto">Current Photo:</label>
        <img :src="'http://localhost:8000' + name" alt="Category Photo" class="current-photo" />
      </div>

      <div class="form-group">
        <label for="newPhoto">Upload New Photo:</label>
        <input type="file" ref="photo" @change="uploadFile" id="newPhoto" />
      </div>

      <button type="submit" class="btn btn-primary">Update</button>
    </form>
  </div>
</template>

<script>
import CategoryService from "@/services/categoryService/CategoryService";

export default {
  props: {
    category: Object,
  },
  created() {
    this.desc = this.category.description;
    this.name = this.category.photo;
  },
  data() {
    return {
      desc: "",
      name: "",
      image: null,
    };
  },
  methods: {
    uploadFile() {
      this.image = this.$refs.photo.files[0];
    },
    updateCategory() {
      CategoryService.UpdateCategory(
        {
          description: this.desc,
          photo: this.image,
        },
        this.category.id
      ).then((res) => {
        console.log(res);
      });
    },
  },
};
</script>

<style scoped>
.update-category-container {
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

input {
  padding: 12px;
  border: 1px solid #ced4da;
  border-radius: 5px;
  background-color: #fff;
  color: #495057;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

input:focus {
  outline: 0;
  border-color: #80bdff;
  box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.current-photo {
  max-width: 100%;
  height: auto;
  border-radius: 5px;
  margin-bottom: 10px;
}

#newPhoto {
  display: none; /* Hide the default file input styling */
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

.update-button:hover {
  background-color: #45a049;
}
</style>
