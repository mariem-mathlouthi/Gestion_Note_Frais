<template>
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid d-flex justify-content-center">
      <router-link class="navbar-brand" :to="{ path: '/' }">
        <img src="../assets/CostSavvy.png" alt="" width="80px" height="70px">
      </router-link>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <div class="collapse navbar-collapse text-center" id="navbarNavDropdown">
        <ul class="navbar-nav ml-auto">
          <!-- Vos autres liens de navigation ici -->
        </ul>
      </div>
      
      <!-- Bouton de déconnexion -->
      <div class="float-end mx-3">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item" @click="logout()">
            <i class="bi bi-box-arrow-right"></i> Déconnexion
          </li>
        </ul>
      </div>
      
      <!-- Icône de paramètre -->
      <div class="float-end mx-3">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <router-link class="nav-link" :to="{ path: '/settings' }" :class="{ active: $route.path === '/settings' }">
              <i class="bi bi-gear"></i> Paramètres
            </router-link>
          </li>
        </ul>
      </div>
      
    </div>
  </nav>
</template>

  <script>
    import {AuthStore} from "../store/index.js"
    export default {
      setup(){
        const store=AuthStore();
        return {store}
      },
      methods: {
        logout() {
          this.store.logout();
          this.$router.push('/LoginUser');
        }
      }
    }
  </script>
  
  
  <style scoped>
  /* Add your custom styles for the navbar here */
  .navbar {
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
  }
  
  .navbar-brand {
    font-size: 24px;
    font-weight: bold;
  }
  
  .navbar-toggler-icon {
    border: 2px solid #fff;
  }
  
  .navbar-nav .nav-link {
    font-size: 16px;
    margin: 0 15px;
    transition: color 0.3s ease-in-out;
  }
  
  .navbar-nav .nav-link:hover {
    color: #8e85da;
  }
  
  .navbar-nav .active {
    color: #8e85da !important;
  }
  
  .nav-item{
    cursor: pointer;
  }

  img{
    border-radius: 25%;
  }
  /* Add more styles as needed */
  </style>
  