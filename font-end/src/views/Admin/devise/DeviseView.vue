<template>
  <div class="page-container">
    <!-- Navbar Component -->
    <NavbarView></NavbarView>

    <!-- Main Container with Sidebar and Content -->
    <div class="main-container">
      <!-- Sidebar Component -->
      <SidebarView></SidebarView>

      <!-- Content Container -->
      <div class="content-container">
        <!-- Conditionally Render Components based on 'type' -->
        <div v-if="type === 'add'">
          <!-- AddDevise Component -->
          <AddDevise></AddDevise>
        </div>
        <div v-else-if="type === 'affiche'">
          <!-- Display Devises -->
          <h1>Devise</h1>
          <button class="btn btn-primary" @click="changeView('add')"><i class="bi bi-plus"></i></button>

          <!-- Table to Display Devises -->
          <table class="devise-table">
            <!-- Table Header -->
            <thead>
              <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Abbreviation</th>
                <th>Operation</th>
              </tr>
            </thead>

            <!-- Table Body with Devises Data -->
            <tbody>
              <tr v-for="devise in devises" :key="devise.id">
                <td>{{ devise.id }}</td>
                <td>{{ devise.titre }}</td>
                <td>{{ devise.abreviation }}</td>
                <td>
                  <button class="btn btn-outline-success btn-block"  @click="updateDevise(devise)"><i class="bi bi-pencil-square"></i></button>
                  <button  class="btn btn-outline-danger btn-block" @click="deleteDevise(devise.id)"><i class="bi bi-trash"></i></button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div v-else-if="type === 'update'">
          <!-- UpdateDevise Component -->
          <UpdateDeviseVue :devise="deviseSelected"></UpdateDeviseVue>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import AddDevise from "@/components/Admin/deviseOpe/AddDevise.vue";
import DeviseService from "../../../services/deviseService/DeviseService";
import NavbarView from "@/views/NavbarView.vue";
import SidebarView from "@/views/SidebarView.vue";
import UpdateDeviseVue from "../../../components/Admin/deviseOpe/UpdateDevise.vue";

export default {
  created() {
    // Fetch Devises on Component Creation
    this.getDevises();
  },
  data() {
    // Component Data
    return {
      devises: [],
      type: "affiche",
      deviseSelected: null,
    };
  },
  methods: {
    // Method to Fetch Devises
    getDevises() {
      DeviseService.GetAllDevises().then((res) => {
        this.devises = res.data.data;
      });
    },
    // Method to Change View Type
    changeView(viewType) {
      this.type = viewType;
    },
    // Method to Delete a Devise
    deleteDevise(id) {
      const isConfirmed = window.confirm("Do you really want to delete this devise?");
      
      if (isConfirmed) {
        DeviseService.DeleteDevise(id)
          .then(() => {
            this.getDevises();
          })
          .catch((error) => {
            console.error(error);
          });
      }
    },
    // Method to Update a Devise
    updateDevise(devise) {
      this.deviseSelected = devise;
      this.type = "update";
    },
  },
  components: {
    // Imported Components
    NavbarView,
    SidebarView,
    AddDevise,
    UpdateDeviseVue,
  },
};
</script>

<style scoped>
/*.page-container {
  max-width: 1200px;
  margin: 0 auto;
}*/
h1{
  text-align: center;
}
.main-container {
  display: flex;
}

.content-container {
  flex: 1;
  padding: 20px;
}

.devise-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

.devise-table th,
.devise-table td {
  border: 1px solid #ddd;
  padding: 10px;
  text-align: left;
}

.devise-table th {
  background-color: #f2f2f2;
}

/*button {
  margin-right: 5px;
  padding: 8px 12px;
  cursor: pointer;
  background-color: #4caf50;
  color: white;
  border: none;
  border-radius: 4px;
}*/

/*button:hover {
  background-color: #45a049;
}*/

/* Adjust sidebar styles if needed */
SidebarView {
  width: 200px;
  background-color: #333;
  color: white;
  padding: 20px;
}
</style>
