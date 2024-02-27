<template>
  <aside class="sidebar">
    <div class="logo">
      <!-- Your logo or image here -->
    </div>
    <ul>
      <li class="sidebar-button" @click="changeview('dash')">
        <i class="bi bi-house-door"></i> Dashboard
      </li>
      <li class="sidebar-button" @click="changeview('mydepenses')">
        <i class="bi bi-cash"></i> Mes dépenses
      </li>
    </ul>
    <div class="spacer"></div>
    <button class="sidebar-button add-button" @click="changeview('add')">
      <i class="bi bi-plus"></i> Ajouter
    </button>
  </aside>
</template>

<script>
export default {
  methods: {
    changeview(data) {
      this.$emit("changerView", data);
    },
  },
};
</script>

<style scoped>
/* Styles for the sidebar */
.sidebar {
  height: 100vh;
  width: 250px;
  background: #2c3e50;
  color: #ecf0f1;
  padding: 20px;
  display: flex;
  flex-direction: column;
  align-items: center;
  box-shadow: 4px 0 8px rgba(0, 0, 0, 0.1);
}

.logo {
  margin-bottom: 20px;
}

ul {
  list-style-type: none;
  padding: 0;
  width: 100%;
}

.sidebar-button {
  text-decoration: none;
  color: #ecf0f1;
  padding: 15px;
  margin-bottom: 10px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: flex-start;
  border: none;
  background-color: #34495e;
  border-radius: 8px;
  transition: background-color 0.3s, color 0.3s, transform 0.3s;
  font-size: 16px;
}

.add-button {
  background: #e74c3c;
}

.sidebar-button i,
.add-button i {
  margin-right: 10px;
}

.sidebar-button:hover,
.active {
  background-color: #2980b9;
  color: #fff;
  transform: scale(1.05);
}

.add-button:hover {
  background-color: #c0392b;
}

.spacer {
  flex: 1;
}

/* Responsive styles */
@media screen and (max-width: 768px) {
  .sidebar {
    width: 100%;
    box-shadow: none;
  }
}
</style>
