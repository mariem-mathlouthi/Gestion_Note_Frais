import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import CategoryView from "../views/Admin/category/CategoryView.vue"
import PaiementView from "../views/Admin/paiements/PaiementsView.vue"
import DeviseView from "../views/Admin/devise/DeviseView.vue"
import DepenseView from "../views/Admin/Depenses/DepenseView.vue"
import UsersView from "../views/Admin/users/UsersView.vue"
import DashboardView from "../views/Client/Dashboard/DashboardView.vue"
import MesDepensesView from "../views/Client/Depense/MesDepensesView.vue"
//import UpdateDepense from "@/components/Client/depensesOpe/UpdateDepense.vue"
import ChangerPasswordViewVue from "@/views/Auth/ResetPassword/ChangerPasswordView.vue";
import forgot_password from "../views/Auth/ResetPassword/ForgotPasswordView.vue"
import ContactView from "../views/ContactView.vue";
import dashView from "../views/Admin/DashView.vue";

const routes = [
  {
    path: "/",
    name: "Home",
    component: HomeView,
  },
  {
    path: "/category",
    name: "CategoryView",
    component: CategoryView,
  },
  {
    path: "/paiements",
    name: "PaiementsView",
    component: PaiementView,
  },
  {
    path: "/dash",
    name: "dashView",
    component: dashView,
  },
   {
    path: "/devises",
    name: "DeviseView",
    component: DeviseView,
  }, 
  {
    path: "/depenses",
    name: "DepenseView",
    component: DepenseView,
  }, 
  {
    path: "/ContactView",
    name: "ContactView",
    component:ContactView,
  }, 
  /*{
    path: "/UpdateDepense/:id",
    name: "UpdateDepense",
    component: UpdateDepense,
  }, */
  {
    path: "/about",
    name: "about",
    component: () =>
      import("../views/AboutView.vue"),
  },
  {
    path: "/users",
    name: "UsersView",
    component: UsersView,
  },
  {
    path: "/Dashboard",
    name: "DashboardView",
    component: DashboardView,
  },
  {
    path: "/mesDepense",
    name: "MesDepensesView",
    component:MesDepensesView,
  },
  {
    path: "/ChangerPasswordViewVue",
    name: "ChangerPasswordViewVue",
    component:ChangerPasswordViewVue,
  },
  {
    path: "/LoginUser",
    name: "LoginUser",
    component: () =>
      import("../views/LoginView.vue"),
  },
  {
    path: "/singUp",
    name: "singUp",
    component: () =>
      import("../views/SignUpView.vue"),
  },
  {
    path: "/forgot_password",
    name: "forgot_password",
    component: forgot_password,
  },
  
  
  /*{
    path: "/navbar",
    name: "navbar",
    component: () =>
      import("../views/NavbarView.vue"),
  },*/
  /*{
    path: "/Sidebar",
    name: "sidebar",
    component: () =>
      import("../views/SidebarView.vue"),
  },*/
  {
    path: "/footer",
    name: "Footer",
    component: () =>
      import(/* webpackChunkName: "contact" */ "../views/FooterView.vue"),
  },
  // {
  //   path: "/sidebar",
  //   name: "Sidebar",
  //   component: () =>
  //     import(/* webpackChunkName: "contact" */ "../views/SidebarView.vue"),
  // },
  {
    path: "/depense",
    name: "Depense",
    component: () =>
      import(/* webpackChunkName: "contact" */ "../views/Admin/Depenses/DepenseView.vue"),
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
