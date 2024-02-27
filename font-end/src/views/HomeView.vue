<template>
  <div class="home">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <img class="img-fluid rounded-circle mb-4" src="@/assets/CostSavvy.png" alt="" width="40px" height="40px" />
        <router-link class="navbar-brand" to="/">Costsavvy</router-link>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item"><router-link class="nav-link" to="/">Home</router-link></li>
            <li class="nav-item"><router-link class="nav-link" to="/about">About</router-link></li>

            <li class="nav-item" ><router-link class="nav-link" to="/LoginUser">Login</router-link></li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Header with background image -->
    <header class="py-5 bg-image-full text-center">
      <div>
        <!-- <img class="img-fluid rounded-circle mb-4" src="@/assets/CostSavvy.png" alt="" width="80px" height="70px" /> -->
        <!-- <h1 class="text-white fs-3 fw-bolder">Welcome To COSTSAVVY</h1> -->
      </div>
    </header>

    <!-- AboutView section -->
    <section class="py-5">
      <AboutView></AboutView>
    </section>

    <!-- ContactView section -->
    <section class="py-5 bg-light">
      <ContactView></ContactView>
    </section>

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container text-center">
        <p class="m-0 text-white">Copyright &copy; Your Website 2023</p>
      </div>
    </footer>
  </div>
</template>

<script>
import ContactView from '@/views/ContactView.vue';
import AboutView from '@/views/AboutView.vue';
import { AuthStore } from "../store/index.js";

export default {
  name: "HomeView",
  setup() {
    const store = AuthStore();
    return { store };
  },
  methods: {
    logout() {
      this.store.logout();
      this.$router.push('/login');
    }
  },
  components: {
    ContactView,
    AboutView,
  },
};
</script>

<style scoped>
/* Updated styling for background images */
.py-5.bg-image-full {
  position: relative;
  height: 50vh;
  background-image: url('@/assets/fond.png');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  color: white; /* Set text color to white */
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

/* Additional styles for the header */
.header img {
  border-radius: 50%;
}

/* Additional styles for buttons */
.btn-primary,
.btn-secondary {
  font-size: 1.5rem;
}

/* Add padding and color to AboutView and ContactView sections */
section {
  padding: 50px 0;
}

/* Adjust styles for better readability */
.navbar {
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.navbar-brand {
  font-size: 1.5rem;
  font-weight: bold;
}

.navbar-nav .nav-link {
  font-size: 1.2rem;
}

/* Style the footer */
footer {
  color: white;
}
</style>
