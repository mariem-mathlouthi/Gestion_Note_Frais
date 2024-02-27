<template>
  <div class="content-container">
    <div v-if="view === 'dash'" class="dashboard">
      <div class="dashboard-header">
        <h1 class="page-title">Mes Dépenses</h1>
      </div>
      
      <div v-if="loading" class="loading-message">
        <i class="bi bi-hourglass"></i> Loading...
      </div>
      <div v-else-if="depenses.length === 0" class="no-data-message">
        <i class="bi bi-info-circle"></i> No Data
      </div>
      
      <div v-else>
        <div class="depense-card" v-for="depense in depenses" :key="depense.id">
          <div class="card-header">
            <span class="depense-id">#{{ depense.id }}</span>
            <span class="status-badge" :class="getStatusClass(depense.status)">
              {{ getStatusText(depense.status) }}
            </span>
          </div>
          <div class="card-body">
            <div class="depense-details">
              <div class="detail">
                <span class="label">Date:</span>
                <span>{{ depense.date }}</span>
              </div>
              <div class="detail">
                <span class="label">Amount:</span>
                <span>{{ depense.montant }} {{ depense.devise.abreviation }}</span>
              </div>
            </div>
            <div class="depense-actions">
              <button class="btn btn-primary" @click="updateDepense(depense)">
                <i class="bi bi-pencil"></i> Update
              </button>
              <button class="btn btn-danger" @click="deleteDepense(depense.id)">
                <i class="bi bi-trash"></i> Delete
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-else-if="view === 'add'">
      <AddDepense></AddDepense>
    </div>
    <div v-else-if="view === 'update'">
      <UpdateDepense :depense="depensesSelcted"></UpdateDepense>
    </div>
    <div v-else>
      <MyDepenses></MyDepenses>
    </div>
  </div>
</template>

<script>
import NavbarView from "@/views/NavbarView.vue";
import SidebarView from "@/views/SidebarCliView.vue";
import DepenseService from "../../../services/depensesService/DepenseService";
import UpdateDepense from "@/components/Client/depensesOpe/UpdateDepense.vue";
import AddDepense from "@/components/Client/depensesOpe/AddDepense.vue";
import MyDepenses from "@/views/Client/Depense/MesDepensesView.vue";
import { AuthStore } from "../../../store/index.js";

export default {
  created() {
    this.getDepenses();
  },
  setup() {
    const store = AuthStore();
    return { store };
  },
  data() {
    return {
      depenses: [],
      loading: false,
      depensesSelcted: [],
      view: "dash"
    };
  },
  methods: {
    getDepenses() {
      this.loading = true;
      DepenseService.GetLatestDepenses(this.store.user['id']).then((res) => {
        this.loading = false;
        this.depenses = res.data.data;
      });
    },
    updateDepense(depense) {
      this.view = 'update';
      this.depensesSelcted = depense;
    },
    deleteDepense(id) {
      const isConfirmed = window.confirm("Do you really want to delete this depense?");
      
      if (isConfirmed) {
      alert("depense supprimée");
        DepenseService.DeleteDepense(id)
          .then(() => {
            this.getDepenses();
          })
          .catch((error) => {
            console.error(error);
          });
      }
    },

    changerView(data) {
      this.view = data;
    },
    getStatusText(status) {
      switch (status) {
        case '0':
          return 'Waiting';
        case '1':
          return 'Accepted';
        case '2':
          return 'Rejected';
        default:
          return 'Autre état';
      }
    },

    getStatusClass(status) {
      switch (status) {
        case '0':
          return 'waiting';
        case '1':
          return 'accepted';
        case '2':
          return 'rejected';
        default:
          return 'other';
      }
    }
  },
  components: {
    NavbarView,
    SidebarView,
    AddDepense,
    UpdateDepense,
    MyDepenses
  }
};
</script>

<style scoped>
.content-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 20px;
}

.dashboard {
  width: 100%;
  max-width: 800px;
}

.dashboard-header {
  text-align: center;
}

.page-title {
  font-size: 28px;
  margin-bottom: 20px;
  color: #007bff;
}

.depense-card {
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  margin-bottom: 20px;
  overflow: hidden;
  transition: transform 0.3s ease-in-out;
}

.depense-card:hover {
  transform: translateY(-5px);
}

.card-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px 20px;
  background-color: #f8f9fa;
}

.depense-id {
  font-size: 18px;
  color: #007bff;
}

.status-badge {
  padding: 6px 12px;
  border-radius: 12px;
  font-size: 14px;
  font-weight: bold;
}

.waiting {
  background-color: #ffc107;
  color: #212529;
}

.accepted {
  background-color: #28a745;
  color: #fff;
}

.rejected {
  background-color: #dc3545;
  color: #fff;
}

.card-body {
  padding: 20px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.depense-details,
.depense-actions {
  flex: 1;
}

.detail {
  margin-bottom: 10px;
}

.label {
  font-weight: bold;
  margin-right: 5px;
}

.btn {
  padding: 8px 16px;
  cursor: pointer;
  border: none;
  border-radius: 4px;
  transition: background-color 0.3s ease-in-out;
}
/*
.btn-primary {
  background-color: #007bff;
  color: #fff;
}*/

.btn-danger {
  background-color: #dc3545;
  color: #fff;
}
/*
.btn:hover {
  background-color: #0056b3;
}*/
</style>
