<template>
  <div class="page-container">
    <NavbarView></NavbarView>
    <div class="main-container">
      <SidebarView></SidebarView> <!-- Ajout du Sidebar -->
      <div class="content-container">
        <div v-if="type === 'add'">
          <AddPaiementComponent></AddPaiementComponent>
        </div>
        <div v-else-if="type === 'affiche'">
          <h1>Paiements</h1>
          <button  class="btn btn-primary" @click="changeView('add')"><i class="bi bi-plus"></i></button>
          <table class="paiements-table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Opération</th>
              
              </tr>
            </thead>
            <tbody>
              <tr v-for="paiement in paiements" :key="paiement.id">
                <td>{{ paiement.id }}</td>
                <td>{{ paiement.nom }}</td>
                <td>
                  <button  class="btn btn-outline-success btn-block"  @click="updatePaiement(paiement)"><i class="bi bi-pencil-square"></i></button>
                  <button   class="btn btn-outline-danger btn-block" @click="deletePaiement(paiement.id)"><i class="bi bi-trash"></i></button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div v-else-if="type === 'update'">
          <UpdatePaiements :paiement="paiementSelected"></UpdatePaiements>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import AddPaiementComponent from "../../../components/Admin/paiementsOpe/AddPaiements.vue";
import PaiementsService from "../../../services/paiementsService/PaiementsService";
import NavbarView from "@/views/NavbarView.vue";
import SidebarView from "@/views/SidebarView.vue";
import UpdatePaiements from "../../../components/Admin/paiementsOpe/UpdatePaiements.vue"; 

export default {
  created() {
    this.getPaiements();
  },
  data() {
    return {
      paiements: [],
      type: "affiche",
      paiementSelected: null,
    };
  },
  methods: {
    getPaiements() {
      PaiementsService.GetAllPaiements().then((res) => {
        this.paiements = res.data.data;
      });
    },
    changeView(viewType) {
      this.type = viewType;
    },
    deletePaiement(id) {
      const isConfirmed = window.confirm("Do you really want to delete this paiement?");
      
      if (isConfirmed) {
        PaiementsService.deletePaiement(id)
          .then(() => {
            this.getPaiements();
          })
          .catch((error) => {
            console.error(error);
          });
      }
    },
    updatePaiement(paiement) {
      this.paiementSelected = paiement;
      this.type = "update";
    },
  },
  components: {
    NavbarView,
    SidebarView,
    AddPaiementComponent,
    UpdatePaiements, 
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

.paiements-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

.paiements-table th,
.paiements-table td {
  border: 1px solid #ddd;
  padding: 10px;
  text-align: left;
}
h1{
  text-align: center;
}

.paiements-table th {
  background-color: #f2f2f2;
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
/*
button:hover {
  background-color: #45a049;
}*/

/* Styles for Sidebar */
SidebarView {
  width: 200px;
  background-color: #333;
  color: white;
  padding: 20px;
}
</style>
