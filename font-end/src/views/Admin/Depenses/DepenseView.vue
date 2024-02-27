<template>
  <div class="page-container">
    <NavbarView></NavbarView>
    <div class="main-container">
      <SidebarView></SidebarView>
      <div class="content-container">
        <div>
          <h1>Dépenses</h1>
          <select v-model="status" class="form-control" @click="getDepenses()">
            <option value="0">Waiting</option>
            <option value="1">Accepted</option>
            <option value="2">Reject</option>
          </select>
          <label for="">Search</label>
          <input v-model="montant" placeholder="entrer montant"  @keyup="getDepenses">
          <input type="date" v-model="date" @change="getDepenses">
          <table class="depense-table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Montant</th>
                <th>Description</th>
                <th>Status</th>
                <th>Pays</th>
                <th>Operation</th>
              </tr>
            </thead>
            <tbody v-if="loading">
                  <tr>
                    <td colspan="8" class="text-center">
                      Loading...
                    </td>
                  </tr>
            </tbody>
            <tbody v-else-if="depenses==''">
                  <tr>
                    <td colspan="8" class="text-center">
                      No Data
                    </td>
                  </tr>
            </tbody>
            <tbody v-else>
              <tr v-for="depense in depenses" :key="depense.id">
                <td>{{ depense.id }}</td>
                <td>{{ depense.date }}</td>
                <td>{{ depense.montant }}</td>
                <td>{{ depense.description }}</td>
                <td>{{ depense.status==0 ? "En attente" : depense.status==1 ? 'Accepted' : 'Rejected'  }}</td>
                <td>{{ depense.pays }}</td>
                <td>
                  <button @click="AcceptDepenses(depense.id)" v-if="depense.status!=2 && depense.status!=1" class="btn btn-outline-success"><i class="bi bi-check"></i> </button>
                  <button @click="RejectDepenses(depense.id)" v-if="depense.status!=2 && depense.status!=1" class="btn btn-outline-danger btn-block"><i class="bi bi-trash"></i></button>
                  <button @click="deleteDepense(depense.id)" v-if="depense.status==2 || depense.status==1" class="btn btn-outline-danger btn-block"><i class="bi bi-trash"></i></button>

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
import AddDepense from "@/components/Admin/depensesOpe/AddDepense.vue";
import DepenseService from "../../../services/depensesService/DepenseService";
import NavbarView from "@/views/NavbarView.vue";
import SidebarView from "@/views/SidebarView.vue";
import UpdateDepenseVue from "@/components/Admin/depensesOpe/UpdateDepense.vue";

export default {
  created() {
    this.getDepenses();
  },
  data() {
    return {
      depenses: [],
      type: "affiche",
      depenseSelected: null,
      status:0,
      loading:false,
      montant:"",
date:""
    };
  },
  methods: {
    getDepenses() {
      this.loading=true;
      DepenseService.GetDepenses(this.status,this.montant,this.date).then((res) => {
        this.loading=false;
        this.depenses = res.data.data;
      });
    },
    changeView(viewType) {
      this.type = viewType;
    },
    deleteDepense(id) {
  
      const isConfirmed = window.confirm("Do you really want to delete this depense?");
      
      if (isConfirmed) {
        DepenseService.DeleteDepense(id)
          .then(() => {
            this.getDepenses();
          })
          .catch((error) => {
            console.error(error);
          });
      }
    },
    AcceptDepenses(id) {
  const isConfirmed = window.confirm("Do you really want to accept this expense?");
  if (isConfirmed) {
    DepenseService.AccpetDepenses(id).then(()=> {
      this.getDepenses();
      alert("Expense Accepted");
    });
  }
},

    RejectDepenses(id){
      const isConfirmed = window.confirm("Do you really want to reject this expense?");
      if (isConfirmed) {
      DepenseService.RejectDepenses(id).then(()=>{
        this.getDepenses();
        alert("Expense Rejected");
      });
    }
    },
    updateDepense(depense) {
      this.depenseSelected = depense;
      this.type = "update";
    },
  },
  components: {
    NavbarView,
    SidebarView,
    AddDepense,
    UpdateDepenseVue,
  },
};
</script>

<style scoped>
/* .page-container {
  max-width: 1200px;
  margin: 0 auto;
} */

.main-container {
  display: flex;
}

.content-container {
  flex: 1;
  padding: 20px;
}

.depense-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

.depense-table th,
.depense-table td {
  border: 1px solid #ddd;
  padding: 10px;
  text-align: left;
}
h1{
  text-align: center;
}
.depense-table th {
  background-color: #f2f2f2;
}

/* button {
  margin-right: 5px;
  padding: 8px 12px;
  cursor: pointer;
  background-color: #4caf50;
  color: white;
  border: none;
  border-radius: 4px;
}

button:hover {
  background-color: #45a049;
} */

/* Styles for Sidebar */
SidebarView {
  width: 200px;
  background-color: #333;
  color: white;
  padding: 20px;
}
</style>
