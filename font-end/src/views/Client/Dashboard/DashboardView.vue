<template>
  <div class="page-container">
    <NavbarView></NavbarView>
    <div class="main-container">
      <SidebarView @changerView="changerView"></SidebarView>
      <div class="content-container">
        <div v-if="view === 'dash'">
          <h1 class="dashboard-title"><i class="bi bi-speedometer2"></i> Dashboard</h1>
          <div v-if="loading" class="loading-message">
            <i class="bi bi-hourglass"></i> Loading...
          </div>
          <div v-else>
            <table class="depense-table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Date</th>
                  <th>Category Photo</th>
                  <th>Expense File</th>
                  <th>Amount (Devise)</th>
                </tr>
              </thead>
              <tbody v-if="depenses.length === 0">
                <tr>
                  <td colspan="5" class="no-data-message">
                    <i class="bi bi-info-circle"></i> No Data
                  </td>
                </tr>
              </tbody>
              <tbody v-else>
                <tr v-for="depense in depenses" :key="depense.id">
                  <td>{{ depense.id }}</td>
                  <td>{{ depense.date }}</td>
                  <td>
                    <img :src="'http://localhost:8000' + depense.category.photo" alt="Category Photo" class="category-photo">
                  </td>
                  <td>
                    <a @click="generatePDF(depense)" class="file-link">
                      <i class="bi bi-file-text"></i> View File
                    </a>
                  </td>
                  <td>{{ depense.montant }}{{ depense.devise.abreviation }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div v-else-if="view === 'add'">
          <AddDepense></AddDepense>
        </div>
        <div v-else-if="view === 'update'">
          <UpdateDepense></UpdateDepense>
        </div>
        <div v-else>
          <MyDepenses></MyDepenses>
        </div>
      </div>
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
import UsersService from "../../../services/UsersService/UsersService"; // Importez le service utilisateur
import { AuthStore } from "../../../store/index.js";
import { jsPDF } from "jspdf";
import autoTable from 'jspdf-autotable';

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
    changerView(data) {
      this.view = data;
    },
    generatePDF(depense) {
  const doc = new jsPDF();
  doc.setFontSize(12);
  
  // Title of the PDF
  doc.setTextColor("#007bff");
  doc.setFont("times", "bold");
  doc.text('Dépenses', 105, 15, null, null, 'center');
  doc.setTextColor("#000000");
  doc.setFont("times", "normal");
  doc.text('Liste des dépenses', 105, 25, null, null, 'center');

  // User Information
  const user = this.store.user;
  if (user) {
    doc.setFont("helvetica", "normal");
    doc.setFontSize(10);
    doc.setTextColor("#555555");
    doc.text(`Nom: ${user.name}`, 20, 40);
    doc.text(`Email: ${user.email}`, 20, 50);
  }

  // Expense Table
  const header = ['ID', 'Date', 'Category', 'Amount'];
  const body = this.depenses.map(depense => [depense.id, depense.date, depense.category.description, `${depense.montant} ${depense.devise.abreviation}`]);
  doc.autoTable({
    head: [header],
    body: body,
    startY: 70,
    theme: 'striped',
    styles: {
      textColor: '#000000',
      fontStyle: 'normal',
      overflow: 'linebreak',
      lineWidth: 0.1,
    },
    headerStyles: {
      fillColor: '#f2f2f2',
      textColor: '#000000',
      fontStyle: 'bold',
      lineWidth: 0.1,
    },
    columnStyles: {
      2: { cellWidth: 'auto' },
    },
    margin: { top: 60 },
  });

  // Total Amount
  const totalMontant = this.depenses.reduce((acc, depense) => acc + depense.montant, 0);
  doc.setFont("times", "bold");
  doc.setFontSize(12);
  doc.setTextColor("#007bff");
  doc.text(`Montant Total: ${totalMontant}`, 105, doc.autoTable.previous.finalY + 15, null, null, 'center');

  // Add Image
  const imgData = depense.category.photo; // Make sure depense.category.photo contains image data
  doc.addImage(imgData, 'JPEG', 15, 15, 30, 30);

  doc.save('depenses.pdf');
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

.depense-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

.depense-table th,
.depense-table td {
  border: 1px solid #ddd;
  padding: 12px;
  text-align: left;
}

.depense-table th {
  background-color: #f2f2f2;
}

.loading-message,
.no-data-message {
  text-align: center;
  padding: 20px;
  font-size: 18px;
  color: #555;
}

.category-photo {
  max-width: 50px;
  max-height: 50px;
  border-radius: 8px;
}

.file-link {
  text-decoration: underline;
  color: #007bff;
  cursor: pointer;
}

.dashboard-title {
  font-size: 32px;
  color: #007bff;
  margin-bottom: 20px;
}

/* Sidebar Styles */
SidebarView {
  width: 200px;
  background-color: #333;
  color: white;
  padding: 20px;
}

/* Navbar Styles */
NavbarView {
  background-color: #007bff;
  color: white;
  padding: 10px 20px;
}
</style>

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

.depense-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

.depense-table th,
.depense-table td {
  border: 1px solid #ddd;
  padding: 12px;
  text-align: left;
}

.depense-table th {
  background-color: #f2f2f2;
}

.loading-message,
.no-data-message {
  text-align: center;
  padding: 20px;
  font-size: 18px;
  color: #555;
}

.category-photo {
  max-width: 50px;
  max-height: 50px;
  border-radius: 8px;
}

.file-link {
  text-decoration: underline;
  color: #007bff;
  cursor: pointer;
}

.dashboard-title {
  font-size: 32px;
  color: #007bff;
  margin-bottom: 20px;
}

/* Sidebar Styles */
SidebarView {
  width: 200px;
  background-color: #333;
  color: white;
  padding: 20px;
}

/* Navbar Styles */
NavbarView {
  background-color: #007bff;
  color: white;
  padding: 10px 20px;
}
</style>