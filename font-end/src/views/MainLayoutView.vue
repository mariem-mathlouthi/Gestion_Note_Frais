<template>
    <div>
      <Sidebar />
      <Navbar />
  
      <!-- Contenu principal de la page -->
      <div class="main-content">
        <router-view></router-view>
      </div>
    </div>
  </template>
  
  <script>
  import Sidebar from "@/components/Sidebar.vue";
  import Navbar from "@/components/Navbar.vue";
  
  export default {
    components: {
      Sidebar,
      Navbar,
    },
  };
  </script>
  
  <style scoped>
  /* Ajoutez des styles si nécessaire */
  .main-content {
    margin-left: 250px; /* Ajustez cette valeur en fonction de la largeur de votre barre latérale */
    padding: 20px;
  }
  
  /* Responsive styles using Bootstrap classes */
  @media (max-width: 768px) {
    .sidebar {
      width: 100%;
      border-right: none;
    }
  
    .main-content {
      margin-left: 0;
    }
  }
  </style>
  