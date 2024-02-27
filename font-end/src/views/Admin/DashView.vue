<template>
  <div class="page-container">
    <NavbarView></NavbarView>
    <div class="main-container">
      <SidebarView></SidebarView>
      <div id="layoutSidenav_content">
        <main>
          <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <!-- Your dashboard content goes here -->
            <div class="statistics-cards">
              <div class="card">
                <h2>{{ categoryCount }}</h2>
                <p>Categories</p>
              </div>
              <div class="card">
                <h2>{{ userCount }}</h2>
                <p>Users</p>
              </div>
              <!-- Add more cards for other entities -->
            </div>
            <!-- Other Dashboard Content -->
          </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
          <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
              <div class="text-muted">Copyright &copy; Your Website 2023</div>
              <div>
                <a href="#">Privacy Policy</a>
                &middot;
                <a href="#">Terms &amp; Conditions</a>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
  </div>
</template>

<script>
import NavbarView from "@/views/NavbarView.vue";
import SidebarView from "@/views/SidebarView.vue";
import CategoryService from "@/services/categoryService/CategoryService";
import UsersService from "@/services/UsersService/UsersService";

export default {
  created() {
    // Fetch data for statistics
    this.getCategoryCount();
    this.getUserCount();
    // Add more methods to fetch counts for other entities
  },
  data() {
    return {
      categoryCount: 0,
      userCount: 0,
      // Add more variables for other entities
    };
  },
  methods: {
    async getCategoryCount() {
      try {
        const response = await CategoryService.GetCategory();
        this.categoryCount = response.data.data.length;
      } catch (error) {
        console.error("Error fetching category count", error);
      }
    },
    async getUserCount() {
      try {
        const response = await UsersService.getAllUsers();
        this.userCount = response.data.data.length;
      } catch (error) {
        console.error("Error fetching user count", error);
      }
    },
    // Add more methods to fetch counts for other entities
  },
  components: {
    NavbarView,
    SidebarView,
  },
};
</script>

<style scoped>
/* Add styles for statistics cards */
.statistics-cards {
  display: flex;
  justify-content: space-around;
  margin-top: 20px;
}

.card {
  background-color: #fff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  text-align: center;
}

.card h2 {
  font-size: 24px;
  margin-bottom: 10px;
}

.card p {
  font-size: 14px;
  color: #666;
}
</style>
