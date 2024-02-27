<template>
  <aside class="sidebar">
    <!-- Contenu de la barre latérale ici -->
    <!--<div class="logo">
      <img src="your-logo.png" alt="Logo" />
    </div>-->
    <ul>
      <li :class="{ active: $route.path === '/dash' }">
        <router-link to="/dash" class="sidebar-button">
          <i class="bi bi-house-door"></i> Dashboard
        </router-link>
      </li>
      <li :class="{ active: $route.path === '/depenses' }">
        <router-link to="/depenses" class="sidebar-button">
          <i class="bi bi-cash"></i> Dépenses
        </router-link>
      </li>
      <li :class="{ active: $route.path === '/devises' }">
        <router-link to="/devises" class="sidebar-button">
          <i class="bi bi-currency-exchange"></i> Devises
        </router-link>
      </li>
      <li :class="{ active: $route.path === '/paiements' }">
        <router-link to="/paiements" class="sidebar-button">
          <i class="bi bi-credit-card"></i> Paiements
        </router-link>
      </li>
      <li :class="{ active: $route.path === '/users' }">
        <router-link to="/users" class="sidebar-button">
          <i class="bi bi-person"></i> Utilisateurs
        </router-link>
      </li>
      <li :class="{ active: $route.path === '/category' }">
        <router-link to="/category" class="sidebar-button">
          <i class="bi bi-list"></i> Catégories
        </router-link>
      </li>
    </ul>
  </aside>
</template>

<style scoped>
/* Styles pour la barre latérale */
.sidebar {
  height: 100vh;
  width: 250px;
  background: #37474f;
  color: #fff;
  padding: 20px;
  display: flex;
  flex-direction: column;
  align-items: center;
  box-shadow: 4px 0 8px rgba(0, 0, 0, 0.2);
  border-right: 2px solid #34495e;
}

.logo {
  margin-bottom: 20px;
}

.logo img {
  max-width: 100%;
  height: auto;
}

ul {
  list-style-type: none;
  padding: 0;
  width: 100%;
}

.sidebar-button {
  text-decoration: none;
  color: #fff;
  padding: 15px;
  margin-bottom: 10px;
  cursor: pointer;
  display: flex; /* Align icon and text horizontally */
  align-items: center; /* Center icon and text vertically */
  width: 100%;
  text-align: left;
  border: none;
  background-color: #37474f;
  border-radius: 5px;
  transition: background-color 0.3s;
  font-size: 16px;
}

.sidebar-button i {
  margin-right: 10px; /* Adjust icon spacing */
}

.sidebar-button:hover,
.active {
  background-color: #2c3e50;
}

.active {
  color: #85daab;
}

/* Styles pour la version responsive */
@media screen and (max-width: 768px) {
  .sidebar {
    width: 100%;
    border-right: none;
    box-shadow: none;
  }
}
</style>
