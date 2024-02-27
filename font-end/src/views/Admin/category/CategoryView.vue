<template>
  <div class="page-container">
    <NavbarView></NavbarView>
    <div class="main-container">
      <SidebarView></SidebarView>
      <div class="content-container">
        <div v-if="type === 'add'">
          <AddComponent></AddComponent>
        </div>
        <div v-else-if="type === 'affiche'">
          <h1>Category </h1>
          <button class="btn btn-primary" @click="changeView('add')"><i class="bi bi-plus"></i></button>
          <table class="category-table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Description</th>
                <th>Photo</th>
                <th>Operation</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="cat in categories" :key="cat.id">
                <td>{{ cat.id }}</td>
                <td>{{ cat.description }}</td>
                <td>
                  <img :src="'http://localhost:8000' + cat.photo" alt="Category Photo" />
                </td>
                <td>
                  <button class="btn btn-outline-success btn-block" @click="updateCategory(cat)"><i class="bi bi-pencil-square"></i></button>
                  <button class="btn btn-outline-danger btn-block" @click="deleteCategory(cat.id)"><i class="bi bi-trash"></i></button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div v-else-if="type === 'update'">
          <UpdateCategoryVue :category="categorySelected"></UpdateCategoryVue>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import AddComponent from "../../../components/Admin/categoryOpe/AddCategory.vue";
import CategoryService from "../../../services/categoryService/CategoryService";
import NavbarView from "@/views/NavbarView.vue";
import SidebarView from "@/views/SidebarView.vue";
import UpdateCategoryVue from "../../../components/Admin/categoryOpe/UpdateCategory.vue";

export default {
  created() {
    this.getCategories();
  },
  data() {
    return {
      categories: [],
      type: "affiche",
      categorySelected: null,
    };
  },
  methods: {
    getCategories() {
      CategoryService.GetCategory().then((res) => {
        this.categories = res.data.data;
      });
    },
    changeView(viewType) {
      this.type = viewType;
    },
    deleteCategory(id) {
      const isConfirmed = window.confirm("Do you really want to delete this category?");
      
      if (isConfirmed) {
        CategoryService.deleteCategory(id)
          .then(() => {
            this.getCategories();
          })
          .catch((error) => {
            console.error(error);
          });
      }
    },
    updateCategory(cat) {
      this.categorySelected = cat;
      this.type = "update";
    },
  },
  components: {
    NavbarView,
    SidebarView,
    AddComponent,
    UpdateCategoryVue,
  },
};
</script>

<style scoped>
/*.page-container {
  max-width: 1200px;
  margin: 0 auto;
}*/

.main-container {
  display: flex;
}

.content-container {
  flex: 1;
  padding: 20px;
}

.category-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

.category-table th,
.category-table td {
  border: 1px solid #ddd;
  padding: 10px;
  text-align: left;
}

.category-table th {
  background-color: #f2f2f2;
}

.category-table img {
  max-width: 100px;
  max-height: 100px;
}
/*
button {
  margin-right: 5px;
  padding: 8px 12px;
  cursor: pointer;
  background-color: #4caf50;
  color: white;
  border: none;
  border-radius: 4px;
}*/

.btn btn-primary {
  background-color:  #007bff;
}
.btn btn-danger{
  background-color:  #f00808;
}

/* Styles for Sidebar */
SidebarView {
  width: 200px;
  background-color: #333;
  color: white;
  padding: 20px;
}
h1{
  text-align: center;
}
</style>
