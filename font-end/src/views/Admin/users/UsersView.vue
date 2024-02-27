<template>
  <div class="page-container">
    <NavbarView></NavbarView>
    <div class="main-container">
      <SidebarView></SidebarView>
      <div class="content-container">
        <div>
          <h1>Ustilisateurs</h1>
          <table class="users-table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="user in users" :key="user.id">
                <td>{{ user.id }}</td>
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td>
                  <button class="btn btn-outline-danger btn-block" @click="deleteUser(user.id)"><i class="bi bi-trash"></i></button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import UsersService from "@/services/UsersService/UsersService";
import NavbarView from "@/views/NavbarView.vue";
import SidebarView from "@/views/SidebarView.vue";

export default {
  created() {
    this.getUsers();
  },
  data() {
    return {
      users: [],
    };
  },
  methods: {
    getUsers() {
      UsersService.getAllUsers()
        .then((res) => {
          this.users = res.data.data;
        })
    },
    deleteUser(id) {
      UsersService.deleteOneUser(id).then(() => {
        this.getUsers();
      });
    },
  },
  components: {
    NavbarView,
    SidebarView,
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

.SidebarView {
  width: 200px;
  background-color: #333;
  color: white;
  padding: 20px;
}

.content-container {
  flex-grow: 1;
}
h1{
  text-align: center;
}

.users-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.users-table th,
.users-table td {
  border: 1px solid #ddd;
  padding: 12px;
  text-align: left;
}

.users-table th {
  background-color: #f2f2f2;
}

button.btn-danger {
  background-color: #dc3545;
  color: white;
  border: none;
  padding: 8px 16px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  display: inline-block;
  text-align: center;
  text-decoration: none;
  font-size: 14px;
  margin: 4px 2px;
}

button.btn-danger:hover {
  background-color: #c82333;
}
</style>
